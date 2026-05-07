@extends('main')
@section('content')
<!-- ==================== FORM category ==================== -->
<div class="page" id="page-form-category">
    <div class="page-header">
        <button class="back-link" onclick="showPage('category')">← Kembali</button>
        <h1 id="form-kat-title">Tambah category</h1>
    </div>
    <div class="form-card" style="max-width:520px">
        <div class="form-group">
            <label>Nama category <span class="req">*</span></label>
            <input type="text" class="form-control" id="fk-nama" placeholder="Ayam">
        </div>
        <div class="form-group">
            <label>Deskripsi (opsional)</label>
            <textarea class="form-control" id="fk-deskripsi" placeholder="Produk berbahan dasar ayam beku..."></textarea>
        </div>
        <div class="form-actions">
            <button class="btn btn-secondary btn-md" onclick="showPage('category')">Batal</button>
            <button class="btn btn-primary btn-md" onclick="simpancategory()">Simpan category</button>
        </div>
    </div>
</div>
@endsection