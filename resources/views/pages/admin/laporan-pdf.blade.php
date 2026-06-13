<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi GudangPro</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            color: #1e293b;
            background: #fff;
        }

        /* ===== HEADER ===== */
        .header {
            width: 100%;
            border-bottom: 3px solid #1e40af;
            padding-bottom: 12px;
            margin-bottom: 16px;
        }
        .header table { width: 100%; }
        .header td { vertical-align: middle; }
        .header img { height: 48px; }
        .header .right { text-align: right; }
        .header h1 {
            font-size: 16px;
            font-weight: bold;
            color: #1e40af;
            margin-bottom: 3px;
        }
        .header .meta {
            font-size: 10px;
            color: #64748b;
            line-height: 1.7;
        }

        /* ===== INFO BOX ===== */
        .info-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-left: 4px solid #1e40af;
            border-radius: 4px;
            padding: 8px 14px;
            margin-bottom: 14px;
            font-size: 10px;
            color: #475569;
        }
        .info-box table { width: 100%; }
        .info-box td { padding: 2px 0; }
        .info-box .label { color: #94a3b8; width: 120px; }
        .info-box .value { font-weight: bold; color: #1e293b; }

        /* ===== SUMMARY ===== */
        .summary { width: 100%; margin-bottom: 16px; border-collapse: separate; border-spacing: 6px 0; }
        .summary td { width: 33.33%; padding: 10px 14px; border-radius: 6px; }

        .s-masuk  { background: #f0fdf4; border: 1px solid #bbf7d0; }
        .s-keluar { background: #fef2f2; border: 1px solid #fecaca; }
        .s-stok   { background: #eff6ff; border: 1px solid #bfdbfe; }

        .s-label { font-size: 9px; color: #64748b; margin-bottom: 4px; text-transform: uppercase; letter-spacing: 0.5px; }
        .s-value { font-size: 24px; font-weight: bold; }
        .s-masuk  .s-value { color: #16a34a; }
        .s-keluar .s-value { color: #dc2626; }
        .s-stok   .s-value { color: #2563eb; }
        .s-sub { font-size: 9px; color: #94a3b8; margin-top: 2px; }

        /* ===== TABLE ===== */
        table.data {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
        }
        table.data thead tr {
            background: #1e40af;
            color: #fff;
        }
        table.data thead th {
            padding: 8px 9px;
            text-align: left;
            font-weight: bold;
            letter-spacing: 0.3px;
        }
        table.data thead th.center { text-align: center; }
        table.data thead th.right  { text-align: right; }

        table.data tbody tr:nth-child(even) { background: #f8fafc; }
        table.data tbody tr:nth-child(odd)  { background: #ffffff; }

        table.data tbody td {
            padding: 6px 9px;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: middle;
        }
        table.data tbody td.center { text-align: center; }

        .badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 20px;
            font-size: 9px;
            font-weight: bold;
        }
        .badge-masuk  { background: #dcfce7; color: #15803d; }
        .badge-keluar { background: #fee2e2; color: #dc2626; }

        .qty-masuk  { color: #15803d; font-weight: bold; }
        .qty-keluar { color: #dc2626; font-weight: bold; }

        /* ===== FOOTER ===== */
        .footer {
            margin-top: 18px;
            border-top: 1px solid #e2e8f0;
            padding-top: 8px;
            width: 100%;
        }
        .footer table { width: 100%; }
        .footer td { font-size: 9px; color: #94a3b8; }
        .footer td:last-child { text-align: right; }
        .footer .brand { color: #1e40af; font-weight: bold; }
    </style>
</head>
<body>

    {{-- HEADER --}}
    <div class="header">
        <table>
            <tr>
                <td>
                    <img src="{{ public_path('images/LogoGudangPro.png') }}" alt="GudangPro">
                </td>
                <td class="right">
                    <h1>Laporan Transaksi Barang</h1>
                    <div class="meta">
                        Periode &nbsp;: {{ $periodeLabel }}<br>
                        Jenis &nbsp;&nbsp;&nbsp;: {{ $jenis === 'semua' ? 'Semua Transaksi' : ($jenis === 'masuk' ? 'Barang Masuk' : 'Barang Keluar') }}<br>
                        Dicetak : {{ now()->setTimezone('Asia/Jakarta')->format('d/m/Y H:i') }}
                    </div>
                </td>
            </tr>
        </table>
    </div>

    {{-- SUMMARY --}}
    <table class="summary">
        <tr>
            <td class="s-masuk">
                <div class="s-label">Total Barang Masuk</div>
                <div class="s-value">{{ number_format($totalMasuk) }}</div>
                <div class="s-sub">Periode yang dipilih</div>
            </td>
            <td class="s-keluar">
                <div class="s-label">Total Barang Keluar</div>
                <div class="s-value">{{ number_format($totalKeluar) }}</div>
                <div class="s-sub">Periode yang dipilih</div>
            </td>
            <td class="s-stok">
                <div class="s-label">Stok Akhir</div>
                <div class="s-value">{{ number_format($stokAkhir) }}</div>
                <div class="s-sub">Total stok tersedia</div>
            </td>
        </tr>
    </table>

    {{-- DATA TABLE --}}
    <table class="data">
        <thead>
            <tr>
                <th class="center" style="width:28px">No</th>
                <th style="width:65px">Tanggal</th>
                <th style="width:65px; white-space:nowrap">No Transaksi</th>
                <th style="width:65px">Kode Part</th>
                <th>Nama Barang</th>
                <th class="center" style="width:55px">Jenis</th>
                <th class="center" style="width:38px">Qty</th>
                <th style="width:80px">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($laporan as $i => $item)
            <tr>
                <td class="center">{{ $i + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                <td>{{ $item->no }}</td>
                <td>{{ $item->kode ?? '-' }}</td>
                <td>{{ $item->barang }}</td>
                <td class="center">
                    <span class="badge {{ $item->jenis === 'Masuk' ? 'badge-masuk' : 'badge-keluar' }}">
                        {{ $item->jenis }}
                    </span>
                </td>
                <td class="center {{ $item->jenis === 'Masuk' ? 'qty-masuk' : 'qty-keluar' }}">
                    {{ $item->jenis === 'Masuk' ? '+' : '-' }}{{ $item->jumlah }}
                </td>
                <td>{{ $item->keterangan }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align:center; padding:20px; color:#94a3b8;">
                    Tidak ada data untuk periode ini
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- FOOTER --}}
    <div class="footer">
        <table>
            <tr>
                <td><span class="brand">GudangPro</span> — Kelola Stok Gudang Lebih Mudah & Cepat</td>
                <td>Total {{ $laporan->count() }} transaksi &nbsp;|&nbsp; Dicetak: {{ now()->setTimezone('Asia/Jakarta')->format('d/m/Y H:i') }}</td>
            </tr>
        </table>
    </div>

</body>
</html>