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
    <!-- ==================== DASHBOARD ==================== -->
    <div class="page active" id="page-dashboard">
        <div class="stat-row">
            <div class="stat-card">
                <div class="stat-label">Total Barang</div>
                <div class="stat-value" id="stat-total">{{ $totalProducts }}</div>
            </div>
            <div class="stat-card green">
                <div class="stat-label">Total Kategori</div>
                <div class="stat-value" id="stat-kategori">{{ $totalCategory }}</div>
            </div>
            <div class="stat-card warn">
                <div class="stat-label">Stok Menipis</div>
                <div class="stat-value" id="stat-menipis">{{ $stockMinCount }}</div>
            </div>
            <div class="stat-card danger">
                <div class="stat-label">Stok Habis</div>
                <div class="stat-value" id="stat-habis">{{ $emptyStockCount }}</div>
            </div>
        </div>

        <form method="GET" action="{{ route('product.index') }}">
            <div class="toolbar">

                <div class="search-wrap">
                    <span class="si">🔍</span>

                    <input
                        type="text"
                        name="q"
                        placeholder="Cari nama barang..."
                        value="{{ request('q') }}">
                </div>

                <select name="category_id">
                    <option value="">Semua kategori</option>

                    @foreach($category as $kat)
                    <option
                        value="{{ $kat->id }}"
                        {{ request('category_id') == $kat->id ? 'selected' : '' }}>
                        {{ $kat->name_category }}
                    </option>
                    @endforeach
                </select>

                <button type="submit" class="btn btn-primary btn-sm">
                    Cari
                </button>

            </div>
        </form>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Nama barang</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Satuan</th>
                        <th>Harga Jual</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="tbl-product">
                    @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->category->name_category ?? 'N/A' }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->unit }}</td>
                        <td>Rp {{ number_format($product->selling_price, 0, ',', '.') }}</td>
                        <td>
                            <a class="btn btn-secondary btn-sm" href="{{route('product.show', $product->id)}}" id="nav-product">Detail</a>
                            <a class="btn btn-secondary btn-sm" href="{{route('product.edit', $product->id)}}" id="nav-product">Edit</a>
                            <form id="delete{{$product->id}}" action="{{ route('product.destroy', $product->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="showModalHapus({{ $product->id }}, '{{ addslashes($product->product_name) }}')">Hapus</button>
                            </form>
                            <!-- <button
                            class="btn btn-danger btn-sm"
                            onclick="showModalHapusKat({{ $kat->id }}, '{{ addslashes($kat->name_category) }}')">
                            Hapus
                        </button> -->
                        </td>
                    </tr>
                    <div class="modal-overlay" id="modal-hapus{{ $product->id }}">
                        <div class="modal">
                            <div class="modal-icon">⚠️</div>
                            <h3>Hapus product?</h3>
                            <p>Data product <strong id="modal-nama"></strong> akan dihapus secara permanen.</p>
                            <div class="modal-actions">
                                <button class="btn btn-secondary btn-md" onclick="closeModal({{ $product->id }})">Batal</button>
                                <button class="btn btn-danger btn-md" onclick="konfirmasiHapus({{ $product->id }})">Ya, Hapus</button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination-wrapper">
            {{-- Previous --}}
            @if ($products->onFirstPage())
            <span class="page-btn disabled">Prev</span>
            @else
            <a href="{{ $products->previousPageUrl() }}"
                class="page-btn">
                Prev
            </a>
            @endif

            {{-- Nomor halaman --}}
            @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)

            @if ($page == $products->currentPage())
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

            {{-- Next --}}
            @if ($products->hasMorePages())
            <a href="{{ $products->nextPageUrl() }}"
                class="page-btn">
                Next
            </a>
            @else
            <span class="page-btn disabled">Next</span>
            @endif
        </div>
    </div>
    <script>
        function closeModal(hapusId) {
            document.getElementById('modal-hapus' + hapusId).classList.remove('open');
        }

        function showModalHapus(id, nama) {
            event.preventDefault();
            document.getElementById("modal-nama").textContent = nama;
            document.getElementById("modal-hapus" + id).classList.add("open");
        }

        function konfirmasiHapus(hapusId) {
            document.getElementById('delete' + hapusId).submit();
        }
    </script>
    @endsection