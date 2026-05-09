@extends('main')
@section('content')
<style>
    .text-error {
        color: #e74c3c;
        font-size: 0.875em;
        margin-top: 4px;
    }
</style>
<form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="page active" id="page-form-barang">
        <div class="page-header">
            <a class="back-link {{ Request::is('product') ? 'active' : '' }}" href="{{route('product.index')}}" id="nav-product">← Kembali</a>
            <h1 id="form-barang-title">Edit Barang</h1>
        </div>
        <div class="form-card">
            <div class="photo-section-label">Foto barang</div>
            <div class="photo-upload-zone" id="photo-zone">

                <img
                    class="photo-preview"
                    id="photo-preview"
                    src="{{ $product->image ? asset('storage/' . $product->image) : '' }}"
                    alt="Preview Foto"
                    style="{{ $product->image ? 'display:block;' : 'display:none;' }}" />

                <div
                    id="photo-placeholder"
                    style="{{ $product->image ? 'display:none;' : 'display:block;' }}">
                    <div class="puz-icon">🖼️</div>
                    <p>Klik untuk memilih foto, atau seret file ke sini</p>
                    <small>Format: JPG, PNG — Maks. 2 MB</small>
                </div>

                <input
                    type="file"
                    id="foto-input"
                    accept="image/*"
                    name="image"
                    onchange="previewFoto(this)"
                    hidden />

                <button
                    type="button"
                    class="btn btn-outline btn-sm"
                    style="margin-top: 12px"
                    onclick="document.getElementById('foto-input').click()">
                    {{ $product->image ? 'Ganti Foto' : 'Pilih Foto' }}
                </button>

            </div>

            <div style="margin-top: 24px">
                <div class="form-group">
                    <label>Nama barang <span class="req">*</span></label>
                    <input
                        type="text"
                        class="form-control"
                        id="f-product_name"
                        name="product_name"
                        value="{{ $product->product_name }}"
                        placeholder="Ayam nugget crispy" />
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Kategori <span class="req">*</span></label>
                        <select class="form-control" id="f-category_id" name="category_id"
                            <option value="">Pilih kategori</option>

                            @foreach($category as $kat)
                            <option value="{{ $kat->id }}" {{ $product->category_id == $kat->id ? 'selected' : '' }}>
                                {{ $kat->name_category }}
                            </option>
                            @endforeach
                        </select>
                        <small class="text-error">@error('category_id') {{ $message }} @enderror</small>
                    </div>
                    <div class="form-group">
                        <label>Satuan <span class="req">*</span></label>
                        <input
                            type="text"
                            class="form-control"
                            id="f-unit"
                            value="{{ $product->unit }}"
                            name="unit"
                            placeholder="pcs" />
                        <small class="text-error">@error('unit') {{ $message }} @enderror</small>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Jumlah stok <span class="req">*</span></label>
                        <input
                            type="number"
                            class="form-control"
                            id="f-stock"
                            value="{{ $product->stock }}"
                            placeholder="120"
                            name="stock"
                            min="0" />
                        <small class="text-error">@error('stock') {{ $message }} @enderror</small>
                    </div>
                    <div class="form-group">
                        <label>Stok minimum <span class="req">*</span></label>
                        <input
                            type="number"
                            class="form-control"
                            id="f-stock_min"
                            placeholder="20"
                            value="{{ $product->stock_min }}"
                            min="0"
                            name="stock_min" />
                        <small class="text-error">@error('stock_min') {{ $message }} @enderror</small>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Harga jual (Rp) <span class="req">*</span></label>
                        <input
                            type="number"
                            class="form-control"
                            id="f-selling_price"
                            placeholder="35000"
                            value="{{ $product->selling_price }}"
                            name="selling_price"
                            min="0" />
                        <small class="text-error">@error('selling_price') {{ $message }} @enderror</small>
                    </div>
                    <div class="form-group">
                        <label>Harga beli (Rp) <span class="req">*</span></label>
                        <input
                            type="number"
                            class="form-control"
                            id="f-buy_price"
                            placeholder="28000"
                            value="{{ $product->buy_price }}"
                            name="buy_price"
                            min="0" />
                        <small class="text-error">@error('buy_price') {{ $message }} @enderror</small>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Berat / ukuran</label>
                        <input
                            type="text"
                            class="form-control"
                            id="f-weight"
                            placeholder="500 gram"
                            value="{{ $product->weight }}"
                            name="weight" />
                        <small class="text-error">@error('weight') {{ $message }} @enderror</small>
                    </div>
                    <div class="form-group">
                        <label>Lokasi simpan</label>
                        <input
                            type="text"
                            class="form-control"
                            id="f-storage_location"
                            placeholder="Rak A-3"
                            value="{{ $product->storage_location }}"
                            name="storage_location" />
                        <small class="text-error">@error('storage_location') {{ $message }} @enderror</small>
                    </div>
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea
                        class="form-control"
                        id="f-description"
                        placeholder="Keterangan produk..."
                        name="description">{{ $product->description }}</textarea>
                    <small class="text-error">@error('description') {{ $message }} @enderror</small>
                </div>

                <div class="form-actions">
                    <a class="btn btn-secondary btn-md {{ Request::is('product') ? 'active' : '' }}" href="{{ route('product.index') }}" id="nav-product">Batal</a>
                    <button class="btn btn-primary btn-md" type="submit">Simpan Produk</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    function previewFoto(input) {
        if (!input.files || !input.files[0]) return;
        const file = input.files[0];
        if (file.size > 2 * 1024 * 1024) {
            alert("Ukuran foto maksimal 2 MB");
            return;
        }
        const reader = new FileReader();
        reader.onload = (e) => {
            fotoDataUrl = e.target.result;
            const prev = document.getElementById("photo-preview");
            prev.src = fotoDataUrl;
            prev.style.display = "block";
            document.getElementById("photo-placeholder").style.display = "none";
        };
        reader.readAsDataURL(file);
    }
</script>
@endsection