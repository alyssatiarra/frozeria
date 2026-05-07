@extends('main')
@section('content')
<!-- ==================== category ==================== -->
<div class="page active">
    <div class="page-header">
        <h1>Daftar Kategori</h1>
    </div>
    <div class="ktable-wrap">
        <div style="padding:12px 14px; border-bottom:1px solid var(--border);">
            <input type="text" class="form-control" id="kat-search" placeholder="Cari Kategori..." oninput="rendercategory()" style="max-width:360px;padding:8px 12px">
        </div>
        <table>
            <thead>
                <tr>
                    <th>Nama Kategori</th>
                    <th>Jumlah Barang</th>
                    <th>Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="tbl-category">
                @foreach ($category as $kat)
                <tr>
                    <td>{{ $kat->name_category }}</td>
                    <td>{{ $kat->description }}</td>
                    <td>{{ $kat->created_at->format('d M Y') }}</td>
                    <td>
                        <a class="btn btn-secondary btn-sm" href="{{route('category.edit', $kat->id)}}" id="nav-product">Edit</a>
                        <form action="{{ route('category.destroy', $kat->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">Hapus</button>
                        </form>
                        <!-- <button
                            class="btn btn-danger btn-sm"
                            onclick="showModalHapusKat({{ $kat->id }}, '{{ addslashes($kat->name_category) }}')">
                            Hapus
                        </button> -->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div style="padding:10px 14px;font-size:.82rem;color:var(--text-light);background:#fafbfc;border-top:1px solid var(--border)" id="kat-count"></div>
    </div>
</div>


<!-- MODAL HAPUS category -->
<div class="modal-overlay" id="modal-hapus-kat">
    <div class="modal">
        <div class="modal-icon">⚠️</div>
        <h3>Hapus category?</h3>
        <p>Data category <strong id="modal-kat-nama"></strong> akan dihapus secara permanen. Barang dengan category ini tidak akan ikut terhapus.</p>
        <div class="modal-actions">
            <button class="btn btn-secondary btn-md" onclick="closeModalKat()">Batal</button>
            <button class="btn btn-danger btn-md" onclick="konfirmasiHapusKat()">Ya, Hapus</button>
        </div>
    </div>
</div>

<script>
    let hapusKatId = null;

    function showModalHapusKat(id, nama) {
        hapusKatId = id;
        document.getElementById('modal-kat-nama').textContent = nama;
        document.getElementById('modal-hapus-kat').classList.add('open');
    }

    function closeModalKat() {
        document.getElementById('modal-hapus-kat').classList.remove('open');
        hapusKatId = null;
    }

    function konfirmasiHapusKat() {
        if (!hapusKatId) return;
        document.getElementById('form-hapus-' + hapusKatId).submit();
    }

    document.getElementById('modal-hapus-kat').addEventListener('click', function(e) {
        if (e.target === this) closeModalKat();
    });
</script>
@endsection