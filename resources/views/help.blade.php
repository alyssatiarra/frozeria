@extends('main')
@section('content')
<!-- ==================== BANTUAN ==================== -->
<div class="page active">
    <div class="page-header">
        <h1>Panduan Penggunaan Sistem</h1>
    </div>
    <div class="help-section">
        <h3>📦 Cara menambah barang baru</h3>
        <div class="help-step">
            <div class="num">1</div>
            <p>
                Buka halaman <strong>Dashboard</strong>, klik tombol
                <strong>+ Tambah Barang</strong> di kanan atas.
            </p>
        </div>
        <div class="help-step">
            <div class="num">2</div>
            <p>
                Unggah foto barang (opsional), lalu isi formulir: nama, kategori,
                satuan, jumlah stok, harga, dan lainnya.
            </p>
        </div>
        <div class="help-step">
            <div class="num">3</div>
            <p>
                Klik <strong>Simpan Barang</strong>. Barang akan muncul di daftar
                dashboard.
            </p>
        </div>
    </div>
    <div class="help-section">
        <h3>🔄 Cara update stok barang masuk</h3>
        <div class="help-step">
            <div class="num">1</div>
            <p>
                Temukan barang di dashboard menggunakan kolom pencarian atau filter
                kategori.
            </p>
        </div>
        <div class="help-step">
            <div class="num">2</div>
            <p>Klik tombol <strong>Edit</strong> pada baris barang tersebut.</p>
        </div>
        <div class="help-step">
            <div class="num">3</div>
            <p>
                Ubah nilai <strong>Jumlah stok</strong> sesuai kondisi saat ini,
                lalu klik <strong>Simpan Barang</strong>.
            </p>
        </div>
    </div>
    <div class="help-section">
        <h3>🗂️ Cara mengelola kategori</h3>
        <div class="help-step">
            <div class="num">1</div>
            <p>Buka halaman <strong>Kategori</strong> dari navigasi atas.</p>
        </div>
        <div class="help-step">
            <div class="num">2</div>
            <p>Tambah, edit, atau hapus kategori sesuai kebutuhan toko.</p>
        </div>
        <div class="help-step">
            <div class="num">3</div>
            <p>
                Menghapus kategori tidak akan menghapus barang - barang akan menjadi tidak berkategori.
            </p>
        </div>
    </div>
    <div class="help-section">
        <div class="help-note">
            ℹ️ Satuan barang diisi bebas sesuai kebutuhan — misalnya:
            <strong>pcs</strong>, <strong>pack</strong>, <strong>box</strong>,
            <strong>kg</strong>, <strong>liter</strong>, dan lain-lain.
        </div>
    </div>
    <div class="developer-card">
        <h3>👤 Informasi</h3>
        <div class="dev-row"><span>Nama</span><span>— Alyssa Tiarra Boediargo</span></div>
        <div class="dev-row"><span>NIM</span><span>— 2241760052</span></div>
        <div class="dev-row"><span>Kelas</span><span>— SIB 4B</span></div>
        <div class="dev-row">
            <span>Alamat</span><span>— Jl. Ikan Sepat II/15, Blimbing, Malang</span>
        </div>
        <div class="dev-row">
            <span>Telepon</span><span>— 083105521185</span>
        </div>
        <div class="dev-row"><span>Email</span><span>— tiarraalyssa@gmail.com</span></div>
    </div>
</div>
@endsection