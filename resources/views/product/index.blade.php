    @extends('main')
    @section('content')
    <!-- ==================== DASHBOARD ==================== -->
    <div class="page active" id="page-dashboard">
        <div class="stat-row">
            <div class="stat-card">
                <div class="stat-label">Total Barang</div>
                <div class="stat-value" id="stat-total">0</div>
            </div>
            <div class="stat-card green">
                <div class="stat-label">Total Kategori</div>
                <div class="stat-value" id="stat-kategori">0</div>
            </div>
            <div class="stat-card warn">
                <div class="stat-label">Stok Menipis</div>
                <div class="stat-value" id="stat-menipis">0</div>
            </div>
            <div class="stat-card danger">
                <div class="stat-label">Stok Habis</div>
                <div class="stat-value" id="stat-habis">0</div>
            </div>
        </div>

        <div class="toolbar">
            <div class="search-wrap">
                <span class="si">🔍</span>
                <input type="text" id="search-input" placeholder="Cari nama barang..." onkeydown="if(event.key==='Enter') doSearch()">
            </div>
            <button class="btn btn-primary btn-sm" onclick="doSearch()">Cari</button>
            <select id="filter-kat" onchange="doSearch()">
                <option value="">Semua kategori</option>
                @foreach($category as $kat)
                <option value="{{ $kat->id }}">{{ $kat->name_category }}</option>
                @endforeach
            </select>
        </div>

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
                <tbody id="tbl-barang"></tbody>
            </table>
            <div class="pagination-row">
                <span id="pg-info"></span>
                <div class="page-btns" id="pg-btns"></div>
            </div>
        </div>
    </div>
    @endsection