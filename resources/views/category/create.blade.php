@extends('main')
@section('content')
<!-- ==================== FORM category ==================== -->
<form action="{{ route('category.store') }}" method="POST">
    @csrf
    <div class="page active">
        <div class="page-header">
            <a class="menu-item back-link {{ Request::is('category') ? 'active' : '' }}" href="{{ route('category.index') }}" id="nav-category">← Kembali</a>
            <h1 id="form-kat-title">Tambah category</h1>
        </div>
        <div class="form-card" style="max-width:520px">
            <div class="form-group">
                <label>Nama category <span class="req">*</span></label>
                <input type="text" class="form-control" id="fk-nama" name="name_category" placeholder="Ayam" required>
            </div>
            <div class="form-group">
                <label>Deskripsi (opsional)</label>
                <textarea class="form-control" id="fk-deskripsi" name="description" placeholder="Produk berbahan dasar ayam beku..."></textarea>
            </div>
            <div class="form-actions">
                <a class="btn btn-secondary btn-md {{ Request::is('category') ? 'active' : '' }}" href="{{ route('category.index') }}" id="nav-category">Batal</a>
                <button class="btn btn-primary btn-md" type="submit">Simpan category</button>
            </div>
        </div>
    </div>
</form>
@endsection