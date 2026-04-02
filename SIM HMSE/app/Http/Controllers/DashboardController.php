<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // ─── Auth ────────────────────────────────────────
    public function loginForm()
    {
        return view('pages.auth.login');
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

        // ─── Dummy auth: terima semua credentials ────
        // TODO: Ganti dengan Auth::attempt() saat backend siap
        return redirect()->route('dashboard')->with('success', 'Login berhasil!');
    }

    public function logout(Request $request)
    {
        // TODO: Auth::logout() saat backend siap
        return redirect()->route('login');
    }

    // ─── Dashboard Overview ──────────────────────────
    public function index()
    {
        return view('pages.dashboard.index');
    }

    // ─── Program Kerja ───────────────────────────────
    public function prokerIndex()
    {
        return view('pages.dashboard.proker.index');
    }

    public function prokerCreate()
    {
        return view('pages.dashboard.proker.create');
    }

    public function prokerShow(string $id)
    {
        return view('pages.dashboard.proker.show', compact('id'));
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
        return view('pages.dashboard.proposal.preview', compact('id'));
    }

    // ─── Keuangan ────────────────────────────────────
    public function financeIndex()
    {
        return view('pages.dashboard.finance.index');
    }

    public function financeInternal()
    {
        // Redirect ke tab internal di finance index
        return view('pages.dashboard.finance.index');
    }

    public function financeProker()
    {
        // Redirect ke tab proker di finance index
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
