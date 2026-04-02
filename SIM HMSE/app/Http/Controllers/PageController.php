<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class PageController extends Controller
{
    public function home()
    {
        // Nanti diganti dengan query dari database
        $news    = collect();
        $gallery = collect();

        return view('pages.home', compact('news', 'gallery'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function newsIndex(Request $request)
    {
        $search = $request->get('search');

        // ── Placeholder kosong (kompatibel dengan template paginator) ──
        // Nanti ganti bagian ini dengan query Eloquent:
        //
        // $news = \App\Models\News::query()
        //     ->when($search, fn($q) => $q->where('title', 'like', "%{$search}%")
        //                                  ->orWhere('content', 'like', "%{$search}%"))
        //     ->latest()
        //     ->paginate(9);

        $news = new LengthAwarePaginator(
            items:       new Collection(),
            total:       0,
            perPage:     9,
            currentPage: 1,
            options:     ['path' => $request->url(), 'query' => $request->query()],
        );

        return view('pages.news.index', compact('news'));
    }

    public function newsShow(string $slug)
    {
        // Nanti ganti dengan query Eloquent:
        // $item = \App\Models\News::where('slug', $slug)->firstOrFail();

        return view('pages.news.show', ['slug' => $slug]);
    }
}
