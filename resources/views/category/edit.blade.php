@extends('main')
@section('content')
<form action="{{ route('category.update', $category->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="page active" id="page-form-category">
        <div class="page-header">
            <button class="back-link" onclick="showPage('category')">← Kembali</button>
            <h1 id="form-kat-title">Edit category</h1>
        </div>
        <div class="form-card" style="max-width:520px">
            <div class="form-group">
                <label>Nama category <span class="req">*</span></label>
                <input type="text" class="form-control" id="fk-nama" name="name_category" value="{{$category->name_category}}" required>
            </div>
            <div class="form-group">
                <label>Deskripsi (opsional)</label>
                <textarea class="form-control" id="fk-deskripsi" name="description">{{$category->description}}</textarea>
            </div>
            <div class="form-actions">
                <a class="btn btn-secondary btn-md {{ Request::is('category') ? 'active' : '' }}" href="{{ route('category.index') }}" id="nav-category">Batal</a>
                <button class="btn btn-primary btn-md" type="submit">Simpan category</button>
            </div>
        </div>
    </div>
</form>
@endsection