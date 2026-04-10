<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\ProposalApproval;
use App\Services\ProposalGeneratorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProposalController extends Controller
{
    protected ProposalGeneratorService $proposalService;

    public function __construct(ProposalGeneratorService $proposalService)
    {
        $this->proposalService = $proposalService;
        $this->middleware('auth');
    }

    /**
     * Show list of proposals
     */
    public function index()
    {
        $proposals = auth()->user()->proposals()->paginate(15);
        return view('proposals.index', compact('proposals'));
    }

    /**
     * Show form to create new proposal
     */
    public function create()
    {
        return view('proposals.create', [
            'riskLevels' => ['low' => 'Resiko Rendah', 'high' => 'Resiko Tinggi'],
        ]);
    }

    /**
     * Store new proposal
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'background' => 'required|string',
            'objective' => 'required|string',
            'risk_level' => 'required|in:low,high',
            'risk_description' => 'required|string',
            'budget' => 'required|numeric|min:0',
            'timeline' => 'required|string|max:255',
        ]);

        // Create proposal
        $proposal = auth()->user()->proposals()->create($validated);

        // Create approval records for all required approvers
        $approvers = $this->proposalService->getRequiredApprovers($proposal->risk_level);
        foreach ($approvers as $approver) {
            ProposalApproval::create([
                'proposal_id' => $proposal->id,
                'approver_id' => null, // Will be set when submitting for approval
                'approver_role' => $approver['role'],
                'approval_order' => $approver['order'],
                'status' => 'pending',
            ]);
        }

        return redirect()->route('proposals.show', $proposal)
            ->with('success', 'Proposal berhasil dibuat. Lanjutkan dengan melengkapi dan submit.');
    }

    /**
     * Show single proposal details
     */
    public function show(Proposal $proposal)
    {
        $this->authorize('view', $proposal);

        return view('proposals.show', [
            'proposal' => $proposal,
            'approvals' => $proposal->approvals()->get(),
            'isFullyApproved' => $proposal->isFullyApproved(),
            'nextApprover' => $proposal->getNextApproverRole(),
        ]);
    }

    /**
     * Show form to edit proposal
     */
    public function edit(Proposal $proposal)
    {
        $this->authorize('update', $proposal);

        // Only allow editing if still in draft
        if ($proposal->status !== 'draft') {
            return redirect()->route('proposals.show', $proposal)
                ->with('error', 'Hanya proposal dalam status draft yang dapat diedit.');
        }

        return view('proposals.edit', [
            'proposal' => $proposal,
            'riskLevels' => ['low' => 'Resiko Rendah', 'high' => 'Resiko Tinggi'],
        ]);
    }

    /**
     * Update proposal
     */
    public function update(Request $request, Proposal $proposal)
    {
        $this->authorize('update', $proposal);

        if ($proposal->status !== 'draft') {
            return back()->with('error', 'Hanya proposal dalam status draft yang dapat diubah.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'background' => 'required|string',
            'objective' => 'required|string',
            'risk_level' => 'required|in:low,high',
            'risk_description' => 'required|string',
            'budget' => 'required|numeric|min:0',
            'timeline' => 'required|string|max:255',
        ]);

        $proposal->update($validated);

        return redirect()->route('proposals.show', $proposal)
            ->with('success', 'Proposal berhasil diperbarui.');
    }

    /**
     * Generate PDF preview
     */
    public function generatePdf(Proposal $proposal)
    {
        $this->authorize('view', $proposal);

        try {
            $filePath = $this->proposalService->generatePdf($proposal);
            return response()->download(Storage::path($filePath));
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal generate PDF: ' . $e->getMessage());
        }
    }

    /**
     * Submit proposal for approval
     */
    public function submit(Request $request, Proposal $proposal)
    {
        $this->authorize('update', $proposal);

        if ($proposal->status !== 'draft') {
            return back()->with('error', 'Hanya proposal draft yang dapat disubmit.');
        }

        $proposal->update(['status' => 'submitted']);

        // Generate initial PDF
        try {
            $this->proposalService->generatePdf($proposal);
        } catch (\Exception $e) {
            \Log::error('PDF generation failed: ' . $e->getMessage());
        }

        return redirect()->route('proposals.show', $proposal)
            ->with('success', 'Proposal berhasil disubmit untuk persetujuan.');
    }

    /**
     * Approve proposal (for approvers)
     */
    public function approve(Request $request, ProposalApproval $approval)
    {
        $proposal = $approval->proposal;
        $this->authorize('view', $proposal);

        // Check if user has authority to approve
        if (auth()->user()->id !== $approval->approver_id && auth()->user()->id !== null) {
            // In production, check roles/permissions here
        }

        $validated = $request->validate([
            'signature_data' => 'nullable|string',
            'notes' => 'nullable|string|max:1000',
        ]);

        $approval->approve($validated['signature_data'] ?? null, $validated['notes'] ?? null);

        // Check if all approvals are done
        if ($proposal->isFullyApproved()) {
            $proposal->update(['status' => 'approved']);
            // Generate final PDF with all signatures
            try {
                $this->proposalService->generateFinalPdf($proposal);
            } catch (\Exception $e) {
                \Log::error('Final PDF generation failed: ' . $e->getMessage());
            }
        }

        return back()->with('success', 'Proposal berhasil disetujui.');
    }

    /**
     * Reject proposal
     */
    public function reject(Request $request, ProposalApproval $approval)
    {
        $proposal = $approval->proposal;
        $this->authorize('view', $proposal);

        $validated = $request->validate([
            'reason' => 'required|string|max:1000',
        ]);

        $approval->reject($validated['reason']);
        $proposal->update([
            'status' => 'rejected',
            'rejection_reason' => $validated['reason'],
        ]);

        return back()->with('success', 'Proposal berhasil ditolak.');
    }

    /**
     * Download PDF
     */
    public function downloadPdf(Proposal $proposal)
    {
        $this->authorize('view', $proposal);

        if (!$proposal->file_path || !Storage::exists($proposal->file_path)) {
            return back()->with('error', 'File PDF tidak ditemukan.');
        }

        return Storage::download($proposal->file_path, 'proposal_' . $proposal->id . '.pdf');
    }

    /**
     * Delete proposal
     */
    public function destroy(Proposal $proposal)
    {
        $this->authorize('delete', $proposal);

        if ($proposal->status !== 'draft') {
            return back()->with('error', 'Hanya proposal draft yang dapat dihapus.');
        }

        $proposal->delete();

        return redirect()->route('proposals.index')
            ->with('success', 'Proposal berhasil dihapus.');
    }

    /**
     * Generate and download filled proposal from template
     */
    public function generateFilledDocument(Proposal $proposal)
    {
        $this->authorize('view', $proposal);

        try {
            $templateService = new \App\Services\ProposalTemplateFillerService();
            
            // Generate filled document
            $filePath = $templateService->generateFilledProposal($proposal, $proposal->risk_level);
            
            // Return download
            $filename = 'proposal_' . $proposal->id . '_' . date('Ymd');
            return response()->download($filePath, $filename . '.docx');
            
        } catch (\Exception $e) {
            return back()->with('error', 'Error generating document: ' . $e->getMessage());
        }
    }

    /**
     * Preview filled proposal before download
     */
    public function previewFilledDocument(Proposal $proposal)
    {
        $this->authorize('view', $proposal);

        try {
            $templateService = new \App\Services\ProposalTemplateFillerService();
            
            // Get template info
            $riskLevel = $proposal->risk_level === 'low' ? 'Rendah' : 'Tinggi';
            $proposalData = [
                'title' => $proposal->title,
                'background' => $proposal->background,
                'objective' => $proposal->objective,
                'risk_level' => $riskLevel,
                'budget' => number_format($proposal->budget, 0, ',', '.'),
                'timeline' => $proposal->timeline,
                'created_at' => $proposal->created_at->format('d/m/Y'),
            ];
            
            return view('proposals.preview-filled', [
                'proposal' => $proposal,
                'proposalData' => $proposalData,
            ]);
            
        } catch (\Exception $e) {
            return back()->with('error', 'Error previewing document: ' . $e->getMessage());
        }
    }

    /**
     * Download template DOCX berdasarkan risk level
     */
    public function downloadTemplate(string $riskLevel)
    {
        $filename = $riskLevel === 'high' 
            ? 'template-proposal-tinggi.docx'
            : 'template-proposal-rendah.docx';

        $filePath = 'templates/proposals/' . $filename;

        if (!Storage::exists($filePath)) {
            return back()->with('error', 'File template tidak ditemukan.');
        }

        return Storage::download($filePath, $filename);
    }
}

