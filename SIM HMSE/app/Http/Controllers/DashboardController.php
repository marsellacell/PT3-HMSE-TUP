<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // ─── Auth ────────────────────────────────────────
    public function loginSelect()
    {
        return view('pages.auth.login-select');
    }

    public function loginForm(string $role)
    {
        return view('pages.auth.login', compact('role'));
    }

    public function loginSubmit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
        ]);

        // Dummy auth: terima semua credentials.
        return redirect()->route('dashboard')->with('success', 'Login berhasil!');
    }

    public function logout(Request $request)
    {
        return redirect()->route('login');
    }

    // ─── Dashboard Overview ──────────────────────────
    public function index()
    {
        return view('pages.dashboard.index');
    }

    // ─── Kalender ────────────────────────────────────
    public function calendar()
    {
        return view('pages.dashboard.calendar');
    }

    // ─── Proposal ────────────────────────────────────
    public function proposalIndex()
    {
        return view('pages.dashboard.proposal.index');
    }

    public function proposalCreate()
    {
        return view('pages.dashboard.proposal.create');
    }

    public function proposalShow(string $id)
    {
        return view('pages.dashboard.proposal.show', compact('id'));
    }

    public function proposalPreview(string $id)
    {
        if ($id === 'new') {
            return response()->json([
                'error' => 'Tidak bisa preview proposal yang belum disimpan. Silakan save proposal terlebih dahulu.',
                'action' => 'create'
            ], 400);
        }

        try {
            $proposal = \App\Models\Proposal::findOrFail($id);

            $templateDir = storage_path('app/templates/proposals');
            if (!is_dir($templateDir)) {
                return response()->json([
                    'error' => 'Folder template tidak ada di storage/app/templates/proposals/',
                    'path' => $templateDir
                ], 500);
            }

            $files = scandir($templateDir);
            $docxFiles = array_filter($files, fn ($f) => strpos($f, '.docx') !== false);

            if (empty($docxFiles)) {
                return response()->json([
                    'error' => 'Tidak ada file template DOCX di folder storage/app/templates/proposals/',
                    'found_files' => $files
                ], 500);
            }

            $templateService = new \App\Services\ProposalTemplateFillerService();
            $filledDocPath = $templateService->generateFilledProposal($proposal);

            if (!file_exists($filledDocPath)) {
                return response()->json([
                    'error' => 'Gagal generate dokumen',
                    'path_attempted' => $filledDocPath
                ], 500);
            }

            return response()->download($filledDocPath, $proposal->title . '.docx', [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
            ]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Proposal dengan ID "' . $id . '" tidak ditemukan',
                'id' => $id
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => config('app.debug') ? $e->getTrace() : []
            ], 500);
        }
    }

    // ─── Keuangan ────────────────────────────────────
    public function financeIndex()
    {
        return view('pages.dashboard.finance.index');
    }

    public function financeInternal()
    {
        return view('pages.dashboard.finance.index');
    }

    public function financeProker()
    {
        return view('pages.dashboard.finance.index');
    }

    // ─── SOTK / Keanggotaan ─────────────────────────
    public function sotkIndex()
    {
        return view('pages.dashboard.sotk.index');
    }

    public function sotkCreate()
    {
        return view('pages.dashboard.sotk.create');
    }

    // ─── Events ──────────────────────────────────────
    public function eventsIndex()
    {
        return view('pages.dashboard.events.index');
    }

    // ─── Dokumentasi ─────────────────────────────────
    public function documentsIndex()
    {
        return view('pages.dashboard.documents.index');
    }

    // ─── Pengaturan ──────────────────────────────────
    public function settings()
    {
        return view('pages.dashboard.settings');
    }
}
