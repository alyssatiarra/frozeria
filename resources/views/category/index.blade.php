@extends('main')
@section('content')
<style>
    .pagination-wrapper {
        display: flex;
        align-items: center;
        gap: 6px;
        justify-content: center;
        margin-top: 20px;
    }

    .page-btn,
    .page-number {
        min-width: 38px;
        height: 38px;
        padding: 0 14px;
        border: 1px solid #dcdfe4;
        border-radius: 8px;
        background: white;
        color: #6b7280;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        transition: .2s ease;
    }

    .page-btn:hover,
    .page-number:hover {
        background: #f5f7fa;
    }

    .page-number.active {
        background: #2563eb;
        border-color: #2563eb;
        color: white;
        font-weight: 600;
    }

    .disabled {
        opacity: .5;
        cursor: not-allowed;
        pointer-events: none;
        background: #f8f9fb;
    }
</style>
<!-- ==================== category ==================== -->
<div class="page active">
    <div class="page-header">
        <h1>Daftar Kategori</h1>
    </div>
    <form method="GET" action="{{ route('category.index') }}">
        <div class="toolbar">

            <div class="search-wrap">
                <span class="si">🔍</span>

                <input
                    type="text"
                    name="q"
                    placeholder="Cari Kategori..."
                    value="{{ request('q') }}">
            </div>

            <button type="submit" class="btn btn-primary btn-sm">
                Cari
            </button>

        </div>
    </form>
    <div class="ktable-wrap">
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
                @foreach ($category as $i => $kat)
                <tr>
                    <td>{{ $kat->name_category }}</td>
                    <td>{{ $totalProducts[$i]->products_count }}</td>
                    <td>{{ $kat->created_at->format('d M Y') }}</td>
                    <td>
                        <a class="btn btn-secondary btn-sm" href="{{route('category.edit', $kat->id)}}" id="nav-product">Edit</a>
                        <form action="{{ route('category.destroy', $kat->id) }}" method="POST" style="display:inline;" id="delete{{ $kat->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="showModalHapus({{ $kat->id }}, '{{ addslashes($kat->name_category) }}')">Hapus</button>
                        </form>
                        <!-- <button
                            class="btn btn-danger btn-sm"
                            onclick="showModalHapusKat({{ $kat->id }}, '{{ addslashes($kat->name_category) }}')">
                            Hapus
                        </button> -->
                    </td>
                </tr>
                <div class="modal-overlay" id="modal-hapus-kat{{ $kat->id }}">
                    <div class="modal">
                        <div class="modal-icon">⚠️</div>
                        <h3>Hapus category?</h3>
                        <p>Data category <strong id="modal-kat-nama"></strong> akan dihapus secara permanen. Barang dengan category ini akan ikut terhapus.</p>
                        <div class="modal-actions">
                            <button class="btn btn-secondary btn-md" onclick="closeModalKat({{ $kat->id }})">Batal</button>
                            <button class="btn btn-danger btn-md" onclick="konfirmasiHapusKat({{ $kat->id }})">Ya, Hapus</button>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
        <div style="padding:10px 14px;font-size:.82rem;color:var(--text-light);background:#fafbfc;border-top:1px solid var(--border)" id="kat-count"></div>
    </div>
    <div class="pagination-wrapper">
        @if ($category->onFirstPage())
        <span class="page-btn disabled">Prev</span>
        @else
        <a href="{{ $category->previousPageUrl() }}"
            class="page-btn">
            Prev
        </a>
        @endif

        @foreach ($category->getUrlRange(1, $category->lastPage()) as $page => $url)

        @if ($page == $category->currentPage())
        <span class="page-number active">
            {{ $page }}
        </span>
        @else
        <a href="{{ $url }}"
            class="page-number">
            {{ $page }}
        </a>
        @endif

        @endforeach

        @if ($category->hasMorePages())
        <a href="{{ $category->nextPageUrl() }}"
            class="page-btn">
            Next
        </a>
        @else
        <span class="page-btn disabled">Next</span>
        @endif
    </div>
</div>

<script>
    let hapusKatId = null;

    function showModalHapusKat(id, nama) {
        hapusKatId = id;
        document.getElementById('modal-kat-nama').textContent = nama;
        document.getElementById('modal-hapus-kat' + id).classList.add('open');
    }

    function closeModalKat(hapusKatId) {
        document.getElementById('modal-hapus-kat' + hapusKatId).classList.remove('open');
        hapusKatId = null;
    }

    function showModalHapus(id, nama) {
        event.preventDefault();
        document.getElementById("modal-kat-nama").textContent = nama;
        document.getElementById("modal-hapus-kat" + id).classList.add("open");
    }

    function konfirmasiHapusKat(hapusKatId) {
        document.getElementById('delete' + hapusKatId).submit();
    }
</script>
@endsection