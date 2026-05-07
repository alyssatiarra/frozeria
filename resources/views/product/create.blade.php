@extends('main')
@section('content')
<form action="{{ route('product.store') }}" method="POST">
    @csrf
    <div class="page active" id="page-form-barang">
        <div class="page-header">
            <a class="back-link {{ Request::is('product') ? 'active' : '' }}" href="{{route('product.index')}}" id="nav-product">← Kembali</a>
            <h1 id="form-barang-title">Tambah Barang Baru</h1>
        </div>
        <div class="form-card">
            <div class="photo-section-label">Foto barang</div>
            <div class="photo-upload-zone" id="photo-zone">
                <img class="photo-preview" id="photo-preview" src="" alt="" />
                <div id="photo-placeholder">
                    <div class="puz-icon">🖼️</div>
                    <p>Klik untuk memilih foto, atau seret file ke sini</p>
                    <small>Format: JPG, PNG — Maks. 2 MB</small><br />
                    <button
                        class="btn btn-outline btn-sm"
                        style="margin-top: 10px; position: relative; z-index: 2"
                        onclick="event.stopPropagation()">
                        Pilih Foto
                    </button>
                </div>
                <input
                    type="file"
                    id="foto-input"
                    accept="image/*"
                    onchange="previewFoto(this)" />
            </div>

            <div style="margin-top: 24px">
                <div class="form-group">
                    <label>Nama barang <span class="req">*</span></label>
                    <input
                        type="text"
                        class="form-control"
                        id="f-nama"
                        placeholder="Ayam nugget crispy" />
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Kategori <span class="req">*</span></label>
                        <select class="form-control" id="f-kategori"></select>
                    </div>
                    <div class="form-group">
                        <label>Satuan <span class="req">*</span></label>
                        <input
                            type="text"
                            class="form-control"
                            id="f-satuan"
                            placeholder="pcs" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Jumlah stok <span class="req">*</span></label>
                        <input
                            type="number"
                            class="form-control"
                            id="f-stok"
                            placeholder="120"
                            min="0" />
                    </div>
                    <div class="form-group">
                        <label>Stok minimum</label>
                        <input
                            type="number"
                            class="form-control"
                            id="f-stok-min"
                            placeholder="20"
                            min="0" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Harga jual (Rp)</label>
                        <input
                            type="number"
                            class="form-control"
                            id="f-harga-jual"
                            placeholder="35000"
                            min="0" />
                    </div>
                    <div class="form-group">
                        <label>Harga beli (Rp)</label>
                        <input
                            type="number"
                            class="form-control"
                            id="f-harga-beli"
                            placeholder="28000"
                            min="0" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Berat / ukuran</label>
                        <input
                            type="text"
                            class="form-control"
                            id="f-berat"
                            placeholder="500 gram" />
                    </div>
                    <div class="form-group">
                        <label>Lokasi simpan</label>
                        <input
                            type="text"
                            class="form-control"
                            id="f-lokasi"
                            placeholder="Rak A-3" />
                    </div>
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea
                        class="form-control"
                        id="f-deskripsi"
                        placeholder="Keterangan produk..."></textarea>
                </div>
            </div>

            <div class="form-actions">
                <button
                    class="btn btn-secondary btn-md"
                    onclick="showPage('dashboard')">
                    Batal
                </button>
                <button class="btn btn-primary btn-md" onclick="simpanBarang()">
                    Simpan Barang
                </button>
            </div>
        </div>
    </div>
</form>
@endsection