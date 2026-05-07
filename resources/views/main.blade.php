<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frozeria Stok — Sistem Manajemen Frozen Food</title>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #f0f4f8;
            --surface: #ffffff;
            --surface2: #e8edf3;
            --nav: #0d1b2a;
            --nav-text: #c8d8e8;
            --accent: #0066ff;
            --accent2: #00c9a7;
            --danger: #ff3b3b;
            --warning: #ff8c00;
            --text: #0d1b2a;
            --text-light: #6b7c93;
            --border: #d4dde8;
            --shadow: 0 2px 12px rgba(13, 27, 42, 0.08);
            --radius: 10px;
            --font-head: 'Syne', sans-serif;
            --font-body: 'DM Sans', sans-serif;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: var(--font-body);
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
        }

        /* NAV */
        nav {
            background: var(--nav);
            padding: 0 24px;
            display: flex;
            align-items: center;
            gap: 0;
            height: 52px;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 16px rgba(0, 0, 0, 0.18);
        }

        .nav-brand {
            font-family: var(--font-head);
            font-weight: 800;
            font-size: 1.15rem;
            color: #fff;
            letter-spacing: -0.5px;
            margin-right: 4px;
        }

        .nav-sub {
            font-size: 0.75rem;
            color: #5588cc;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-right: 28px;
        }

        .nav-link {
            color: var(--nav-text);
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 500;
            padding: 0 14px;
            height: 52px;
            display: flex;
            align-items: center;
            cursor: pointer;
            border-bottom: 3px solid transparent;
            transition: all .2s;
        }

        .nav-link:hover {
            color: #fff;
            border-color: #3388ff;
        }

        .nav-link.active {
            color: #fff;
            border-color: var(--accent);
        }

        .nav-spacer {
            flex: 1;
        }

        .btn-nav {
            background: var(--accent);
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 7px;
            font-family: var(--font-body);
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all .2s;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .btn-nav:hover {
            background: #0052cc;
            transform: translateY(-1px);
        }

        /* PAGES */
        .page {
            display: none;
            padding: 28px 24px;
            max-width: 1100px;
            margin: 0 auto;
        }

        .page.active {
            display: block;
        }

        /* CARDS ROW */
        .stat-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: var(--surface);
            border-radius: var(--radius);
            padding: 20px 20px 16px;
            box-shadow: var(--shadow);
            border-left: 4px solid var(--accent);
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 60px;
            height: 100%;
            background: linear-gradient(135deg, transparent 40%, rgba(0, 102, 255, 0.04));
        }

        .stat-card.warn {
            border-color: var(--warning);
        }

        .stat-card.danger {
            border-color: var(--danger);
        }

        .stat-card.green {
            border-color: var(--accent2);
        }

        .stat-label {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 6px;
        }

        .stat-value {
            font-family: var(--font-head);
            font-size: 2rem;
            font-weight: 800;
            color: var(--text);
        }

        /* TOOLBAR */
        .toolbar {
            display: flex;
            gap: 10px;
            margin-bottom: 18px;
            align-items: center;
        }

        .search-wrap {
            position: relative;
            flex: 1;
        }

        .search-wrap input {
            width: 100%;
            padding: 9px 14px 9px 38px;
            border: 1.5px solid var(--border);
            border-radius: 8px;
            font-family: var(--font-body);
            font-size: 0.9rem;
            background: var(--surface);
            color: var(--text);
            outline: none;
            transition: border-color .2s;
        }

        .search-wrap input:focus {
            border-color: var(--accent);
        }

        .search-wrap .si {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
            font-size: 1rem;
        }

        select {
            padding: 9px 32px 9px 12px;
            border: 1.5px solid var(--border);
            border-radius: 8px;
            background: var(--surface);
            font-family: var(--font-body);
            font-size: 0.88rem;
            color: var(--text);
            outline: none;
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%236b7c93' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 10px center;
        }

        select:focus {
            border-color: var(--accent);
        }

        /* TABLE */
        .table-wrap {
            background: var(--surface);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead tr {
            background: #f7f9fb;
            border-bottom: 2px solid var(--border);
        }

        th {
            padding: 11px 14px;
            text-align: left;
            font-size: 0.78rem;
            font-weight: 700;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }

        td {
            padding: 12px 14px;
            font-size: 0.9rem;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        tbody tr:hover {
            background: #f7faff;
        }

        .item-name {
            font-weight: 600;
            color: var(--accent);
            cursor: pointer;
        }

        .item-name:hover {
            text-decoration: underline;
        }

        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            background: #e8f0fe;
            color: #0052cc;
        }

        .stok-low {
            color: var(--warning);
            font-weight: 600;
        }

        .stok-zero {
            color: var(--danger);
            font-weight: 700;
        }

        /* BUTTONS */
        .btn {
            border: none;
            cursor: pointer;
            font-family: var(--font-body);
            border-radius: 6px;
            font-weight: 600;
            transition: all .18s;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .btn-sm {
            padding: 5px 12px;
            font-size: 0.8rem;
        }

        .btn-md {
            padding: 9px 18px;
            font-size: 0.9rem;
        }

        .btn-primary {
            background: var(--accent);
            color: #fff;
        }

        .btn-primary:hover {
            background: #0052cc;
        }

        .btn-secondary {
            background: var(--surface2);
            color: var(--text);
        }

        .btn-secondary:hover {
            background: #d0dae6;
        }

        .btn-success {
            background: var(--accent2);
            color: #fff;
        }

        .btn-success:hover {
            background: #00a88d;
        }

        .btn-danger {
            background: #fff0f0;
            color: var(--danger);
            border: 1px solid #ffc8c8;
        }

        .btn-danger:hover {
            background: var(--danger);
            color: #fff;
        }

        .btn-outline {
            background: transparent;
            border: 1.5px solid var(--border);
            color: var(--text-light);
        }

        .btn-outline:hover {
            border-color: var(--accent);
            color: var(--accent);
        }

        .btn-group {
            display: flex;
            gap: 6px;
        }

        /* PAGINATION */
        .pagination-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 14px;
            font-size: 0.82rem;
            color: var(--text-light);
            border-top: 1px solid var(--border);
            background: #fafbfc;
        }

        .page-btns {
            display: flex;
            gap: 4px;
        }

        .page-btn {
            min-width: 30px;
            height: 30px;
            border: 1.5px solid var(--border);
            background: var(--surface);
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text-light);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all .15s;
        }

        .page-btn:hover,
        .page-btn.active {
            background: var(--accent);
            color: #fff;
            border-color: var(--accent);
        }

        .page-btn:disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        /* PAGE HEADER */
        .page-header {
            display: flex;
            align-items: center;
            margin-bottom: 24px;
            gap: 12px;
        }

        .page-header h1 {
            font-family: var(--font-head);
            font-size: 1.4rem;
            font-weight: 700;
        }

        .page-header .spacer {
            flex: 1;
        }

        .back-link {
            color: var(--text-light);
            font-size: 0.88rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 4px;
            text-decoration: none;
            font-weight: 500;
            transition: color .2s;
            border: none;
            background: none;
            font-family: var(--font-body);
        }

        .back-link:hover {
            color: var(--accent);
        }

        /* DETAIL PAGE */
        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-top: 16px;
        }

        .detail-field {
            background: var(--bg);
            border-radius: 8px;
            padding: 12px 16px;
        }

        .detail-field label {
            font-size: 0.73rem;
            font-weight: 600;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: 0.8px;
            display: block;
            margin-bottom: 4px;
        }

        .detail-field p {
            font-size: 0.95rem;
            font-weight: 500;
        }

        .detail-field.full {
            grid-column: span 2;
        }

        .detail-hero {
            background: var(--surface);
            border-radius: var(--radius);
            padding: 24px;
            box-shadow: var(--shadow);
        }

        .detail-photo {
            width: 90px;
            height: 90px;
            border-radius: 10px;
            background: var(--surface2);
            border: 2px dashed var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-light);
            font-size: 2rem;
            overflow: hidden;
        }

        .detail-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
        }

        .detail-top {
            display: flex;
            gap: 18px;
            align-items: flex-start;
        }

        .detail-top-info h2 {
            font-family: var(--font-head);
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 6px;
        }

        /* FORM */
        .form-card {
            background: var(--surface);
            border-radius: var(--radius);
            padding: 28px;
            box-shadow: var(--shadow);
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .form-group label {
            display: block;
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 6px;
        }

        .form-group label span.req {
            color: var(--danger);
        }

        .form-control {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid var(--border);
            border-radius: 8px;
            font-family: var(--font-body);
            font-size: 0.92rem;
            color: var(--text);
            outline: none;
            background: var(--surface);
            transition: border-color .2s;
        }

        .form-control:focus {
            border-color: var(--accent);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 80px;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 24px;
        }

        /* PHOTO UPLOAD */
        .photo-upload-zone {
            border: 2px dashed var(--border);
            border-radius: 10px;
            padding: 32px 20px;
            text-align: center;
            cursor: pointer;
            transition: border-color .2s, background .2s;
            background: #fafbfc;
            position: relative;
        }

        .photo-upload-zone:hover {
            border-color: var(--accent);
            background: #f0f7ff;
        }

        .photo-upload-zone .puz-icon {
            font-size: 2rem;
            color: var(--border);
            margin-bottom: 8px;
        }

        .photo-upload-zone p {
            font-size: 0.85rem;
            color: var(--text-light);
            margin-bottom: 8px;
        }

        .photo-upload-zone small {
            font-size: 0.75rem;
            color: #a0adb8;
        }

        .photo-upload-zone input[type=file] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
        }

        .photo-preview {
            width: 100px;
            height: 100px;
            border-radius: 8px;
            object-fit: cover;
            display: none;
            margin: 0 auto 8px;
        }

        .photo-section-label {
            font-size: 0.78rem;
            font-weight: 700;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 8px;
        }

        /* MODAL */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(13, 27, 42, 0.45);
            z-index: 500;
            align-items: center;
            justify-content: center;
            animation: fadeIn .15s ease;
        }

        .modal-overlay.open {
            display: flex;
        }

        .modal {
            background: var(--surface);
            border-radius: 14px;
            padding: 32px;
            width: 380px;
            max-width: 90vw;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
            animation: slideUp .2s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0
            }

            to {
                opacity: 1
            }
        }

        @keyframes slideUp {
            from {
                transform: translateY(20px);
                opacity: 0
            }

            to {
                transform: translateY(0);
                opacity: 1
            }
        }

        .modal-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: #fff3e0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            margin-bottom: 16px;
        }

        .modal h3 {
            font-family: var(--font-head);
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .modal p {
            font-size: 0.9rem;
            color: var(--text-light);
            line-height: 1.5;
            margin-bottom: 24px;
        }

        .modal p strong {
            color: var(--text);
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        /* KATEGORI TABLE */
        .ktable-wrap {
            background: var(--surface);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        /* HELP PAGE */
        .help-section {
            background: var(--surface);
            border-radius: var(--radius);
            padding: 24px;
            margin-bottom: 16px;
            box-shadow: var(--shadow);
        }

        .help-section h3 {
            font-family: var(--font-head);
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 14px;
            color: var(--accent);
        }

        .help-step {
            display: flex;
            gap: 12px;
            margin-bottom: 12px;
        }

        .help-step .num {
            min-width: 26px;
            height: 26px;
            background: var(--accent);
            color: #fff;
            border-radius: 6px;
            font-size: 0.78rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .help-step p {
            font-size: 0.9rem;
            line-height: 1.5;
            padding-top: 2px;
        }

        .help-note {
            background: #f0f7ff;
            border-left: 4px solid var(--accent);
            border-radius: 6px;
            padding: 12px 16px;
            font-size: 0.88rem;
            color: #0052cc;
        }

        .developer-card {
            background: var(--nav);
            color: #c8d8e8;
            border-radius: var(--radius);
            padding: 24px;
            margin-top: 16px;
        }

        .developer-card h3 {
            font-family: var(--font-head);
            color: #fff;
            font-size: 1rem;
            margin-bottom: 14px;
        }

        .dev-row {
            display: flex;
            gap: 8px;
            margin-bottom: 8px;
            font-size: 0.88rem;
        }

        .dev-row span:first-child {
            color: #5588cc;
            min-width: 90px;
            font-weight: 600;
        }

        /* EMPTY STATE */
        .empty-state {
            text-align: center;
            padding: 48px 20px;
            color: var(--text-light);
        }

        .empty-state .es-icon {
            font-size: 2.5rem;
            margin-bottom: 12px;
            opacity: .4;
        }

        .empty-state p {
            font-size: 0.9rem;
        }

        @media (max-width: 700px) {
            .stat-row {
                grid-template-columns: 1fr 1fr;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .detail-grid {
                grid-template-columns: 1fr;
            }

            .detail-field.full {
                grid-column: span 1;
            }
        }
    </style>
</head>

<body>
    @include('nav')
    @yield('content')
</body>

</html>