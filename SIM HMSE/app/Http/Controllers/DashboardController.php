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
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'password.min'      => 'Password minimal 6 karakter.',
        ]);

        $credentials = $request->only('email', 'password');
        $remember    = $request->boolean('remember');

        if (\Illuminate\Support\Facades\Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('success', 'Login berhasil! Selamat datang, ' . auth()->user()->name . '.');
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => 'Email atau password salah. Periksa kembali kredensial kamu.']);
    }


    public function logout(Request $request)
    {
        \Illuminate\Support\Facades\Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
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
        $proposals = \App\Models\Proposal::latest()->get();
        return view('pages.dashboard.proposal.index', compact('proposals'));
    }

    public function proposalCreate()
    {
        return view('pages.dashboard.proposal.create');
    }

    public function proposalShow(string $id)
    {
        $proposal = \App\Models\Proposal::findOrFail($id);

        // Hitung berapa langkah TTD yang sudah selesai berdasarkan status
        $signedCount = match($proposal->status) {
            'draft'     => 0,
            'reviewing' => 2, // Ketua Panitia + Sekretaris sudah TTD
            'pending'   => 3, // + Ketua HMSE sudah TTD
            'approved'  => 5, // Semua sudah TTD
            'rejected'  => 0,
            default     => 0,
        };

        return view('pages.dashboard.proposal.show', compact('proposal', 'signedCount'));
    }


    public function proposalPreview(string $id)
    {
        try {
            $proposal = \App\Models\Proposal::findOrFail($id);
            return view('pages.dashboard.proposal.preview', compact('proposal'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            abort(404, 'Proposal tidak ditemukan');
        }
    }

    // ─── Keuangan ────────────────────────────────────
    public function financeIndex()
    {
        $proposals = \App\Models\Proposal::whereNotNull('proker')->latest()->get();
        // Ambil semua transaksi urut berdasarkan tanggal, lalu id
        $transactions = \App\Models\Transaction::with(['proposal', 'user'])
                            ->orderBy('date', 'asc')
                            ->orderBy('id', 'asc')
                            ->get();

        return view('pages.dashboard.finance.index', compact('proposals', 'transactions'));
    }

    public function storeTransaction(Request $request)
    {
        $request->validate([
            'date'        => 'required|date',
            'type'        => 'required|in:pemasukan,pengeluaran',
            'description' => 'required|string|max:255',
            'amount'      => 'required|numeric|min:0',
            'method'      => 'required|in:Transfer,Cash,E-Wallet',
            'proof_file'  => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048', // bukti transaksi wajib
            'proposal_id' => 'nullable|exists:proposals,id'
        ]);

        $proofPath = $request->file('proof_file')->store('finance_proofs', 'public');

        \App\Models\Transaction::create([
            'date'        => $request->date,
            'type'        => $request->type,
            'description' => $request->description,
            'amount'      => $request->amount,
            'method'      => $request->method,
            'proof_path'  => $proofPath,
            'proposal_id' => $request->proposal_id,
            'user_id'     => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Transaksi berhasil ditambahkan!');
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
