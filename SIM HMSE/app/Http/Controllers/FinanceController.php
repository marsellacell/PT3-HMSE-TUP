<?php

namespace App\Http\Controllers;

use App\Models\FinanceInternal;
use App\Models\FinanceProker;
use Illuminate\Http\Request;
use App\Exports\FinanceExport;
use Maatwebsite\Excel\Facades\Excel;

class FinanceController extends Controller
{
    public function index()
    {
        $transaksiInternal = \App\Models\FinanceInternal::orderBy('transaction_date', 'asc')
                            ->orderBy('created_at', 'asc') // Urutan kedua jika tanggalnya sama
                            ->get();
        $internalIn = FinanceInternal::where('type', 'income')->sum('amount');
        $internalOut = FinanceInternal::where('type', 'outcome')->sum('amount');
        $saldoInternal = $internalIn - $internalOut;

        $prokerIn = FinanceProker::where('type', 'income')->sum('amount');
        $prokerOut = FinanceProker::where('type', 'outcome')->sum('amount');
        $totalAnggaranProker = $prokerIn; 

        return view('pages.dashboard.finance.index', [
            'totalPemasukan' => $internalIn + $prokerIn,
            'totalPengeluaran' => $internalOut + $prokerOut,
            'saldoKas' => $saldoInternal,
            'anggaranProker' => $totalAnggaranProker,
            'transaksiInternal' => $transaksiInternal,
        ]);
    }

    public function create()
    {
        $transactionTypes = [
            'income' => 'Pemasukan (Income)',
            'outcome' => 'Pengeluaran (Outcome)'
        ];
    
        return view('pages.dashboard.finance.create', compact('transactionTypes')); 
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'transaction_date' => 'required|date',
            'title' => 'required|string|max:255',
            'type' => 'required|in:income,outcome',
            'amount' => 'required|numeric|min:0',
            'method' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'attachment' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('attachments', 'public');
        }

        \App\Models\FinanceInternal::create([
            'transaction_date' => $validated['transaction_date'],
            'title' => $validated['title'],
            'type' => $validated['type'],
            'amount' => $validated['amount'],
            'method' => $validated['method'],
            'description' => $validated['description'],
            'attachment' => $attachmentPath,
            'created_by' => auth()->id() ?? 1, // Gunakan ID user yang login
        ]);

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('attachments', 'public');
            \App\Models\FinanceInternal::latest()->first()->update(['attachment' => $attachmentPath]);
        }

        return redirect()->route('dashboard.finance.index')->with('success', 'Transaksi berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $transaction = FinanceInternal::findOrFail($id);
        $transactionTypes = [
            'income' => 'Pemasukan (Income)',
            'outcome' => 'Pengeluaran (Outcome)'
        ];

        return view('pages.dashboard.finance.edit', compact('transaction', 'transactionTypes'));
    }

    public function update(Request $request, $id)
    {
        $transaction = FinanceInternal::findOrFail($id);

        $validated = $request->validate([
            'transaction_date' => 'required|date',
            'title' => 'required|string|max:255',
            'type' => 'required|in:income,outcome',
            'amount' => 'required|numeric|min:0',
            'method' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'attachment' => 'nullable|image|mimes:jpeg,png,jpg|max:5120'
        ], [
            'title.required' => 'Judul transaksi wajib diisi.',
            'type.required' => 'Tipe transaksi wajib dipilih.',
            'type.in' => 'Tipe transaksi harus berupa "income" atau "outcome".',
            'amount.required' => 'Jumlah transaksi wajib diisi.',
            'amount.numeric' => 'Jumlah transaksi harus berupa angka.',
            'amount.min' => 'Jumlah transaksi tidak boleh negatif.',
            'attachment.image' => 'File lampiran harus berupa gambar.',
            'attachment.mimes' => 'File lampiran harus berformat JPEG, PNG, atau JPG.',
            'attachment.max' => 'Ukuran file lampiran tidak boleh lebih dari 5 MB.',
        ]);

        if ($request->hasFile('attachment')) {
            if ($transaction->attachment) {
                \Storage::disk('public')->delete($transaction->attachment);
            }
            $validated['attachment'] = $request->file('attachment')->store('attachments', 'public');
        }

        $transaction->update($validated);

        return redirect()->route('dashboard.finance.index', ['tab' => 'internal'])
                        ->with('success', 'Transaksi berhasil diperbarui!');
    }
    
    public function destroy(Request $request, $id)
    {
        $finance = FinanceInternal::findOrFail($id);

        if ($finance->attachment) {
        \Storage::disk('public')->delete($finance->attachment);
        }

        $finance->delete();

        return redirect()->route('dashboard.finance.index', ['tab' => $request->query('tab', 'internal')])
                        ->with('success', 'Transaksi berhasil dihapus!');    
    }

    public function export() 
    {
        return Excel::download(new FinanceExport, 'Laporan_Keuangan_HMSE_'.now()->format('Y-m-d').'.xlsx');
    }
}