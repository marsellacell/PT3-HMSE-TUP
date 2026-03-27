@extends('layouts.app')

@section('content')

{{-- HERO --}}
<section>
    <h1>Himpunan Mahasiswa Software Engineering</h1>
    <p>Telkom University Purwokerto</p>
</section>

{{-- ABOUT --}}
<section>
    <h2>About Us</h2>
    <p>
        Ini adalah deskripsi singkat tentang HMSE...
    </p>
</section>

{{-- NEWS --}}
<section>
    <h2>News</h2>

    <div>
        <div>
            <h3>Judul Berita</h3>
            <p>Lorem ipsum dolor sit amet...</p>
        </div>

        <div>
            <h3>Judul Berita</h3>
            <p>Lorem ipsum dolor sit amet...</p>
        </div>

        <div>
            <h3>Judul Berita</h3>
            <p>Lorem ipsum dolor sit amet...</p>
        </div>
    </div>

</section>

{{-- GALLERY --}}
<section>
    <h2>Gallery</h2>
    <p>Dokumentasi dan kegiatan kami</p>

    <div>
        <div>
            <p>Gambar 1</p>
        </div>

        <div>
            <p>Gambar 2</p>
        </div>

        <div>
            <p>Gambar 3</p>
        </div>

        <div>
            <p>Gambar 4</p>
        </div>

        <div>
            <p>Gambar 5</p>
        </div>

        <div>
            <p>Gambar 6</p>
        </div>
    </div>
</section>

@endsection
