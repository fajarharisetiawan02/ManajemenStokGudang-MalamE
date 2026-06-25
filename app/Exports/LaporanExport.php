<?php

namespace App\Exports;

use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class LaporanExport implements FromCollection, WithStyles, ShouldAutoSize, WithTitle, WithEvents
{
    protected $dari;
    protected $sampai;
    protected $jenis;
    protected $totalMasuk  = 0;
    protected $totalKeluar = 0;
    protected $stokAkhir   = 0;

    public function __construct($dari, $sampai, $jenis)
    {
        $this->dari   = $dari;
        $this->sampai = $sampai;
        $this->jenis  = $jenis;
    }

    public function title(): string
    {
        return 'Laporan Transaksi';
    }

    public function collection()
    {
        if (!$this->dari || !$this->sampai) {
            return collect();
        }

        $masuk = collect();
        if ($this->jenis === 'semua' || $this->jenis === 'masuk') {
            $masuk = BarangMasuk::with(['barang.brand'])
                ->whereBetween('tanggal', [$this->dari, $this->sampai])
                ->get()
                ->map(function ($item) {
                    $this->totalMasuk += $item->jumlah;
                    return [
                        'tanggal'    => $item->tanggal,
                        'no'         => 'BM-' . str_pad($item->id, 3, '0', STR_PAD_LEFT),
                        'kode'       => $item->barang?->kode ?? '-',
                        'barang'     => $item->barang?->nama_barang ?? '-',
                        'merek_tipe' => trim(($item->barang?->brand?->nama_brand ?? '') . ' ' . ($item->barang?->tipe ?? '')),
                        'jenis'      => 'Masuk',
                        'jumlah'     => $item->jumlah,
                        'keterangan' => 'Pembelian',
                    ];
                });
        }

        $keluar = collect();
        if ($this->jenis === 'semua' || $this->jenis === 'keluar') {
            $keluar = BarangKeluar::with(['barang.brand'])
                ->whereBetween('tanggal', [$this->dari, $this->sampai])
                ->get()
                ->map(function ($item) {
                    $this->totalKeluar += $item->jumlah;
                    return [
                        'tanggal'    => $item->tanggal,
                        'no'         => 'BK-' . str_pad($item->id, 3, '0', STR_PAD_LEFT),
                        'kode'       => $item->barang?->kode ?? '-',
                        'barang'     => $item->barang?->nama_barang ?? '-',
                        'merek_tipe' => trim(($item->barang?->brand?->nama_brand ?? '') . ' ' . ($item->barang?->tipe ?? '')),
                        'jenis'      => 'Keluar',
                        'jumlah'     => $item->jumlah,
                        'keterangan' => 'Penjualan',
                    ];
                });
        }

        $this->stokAkhir = \App\Models\Barang::sum('stok');

        $semua = $masuk->concat($keluar)->sortByDesc('tanggal')->values();

        // Data langsung tanpa heading — heading ditulis manual di AfterSheet
        return $semua->map(fn($item, $i) => [
            $i + 1,
            $item['tanggal'],
            $item['no'],
            $item['kode'],
            $item['barang'],
            $item['merek_tipe'] ?: '-',
            $item['jenis'],
            $item['jumlah'],
            $item['keterangan'],
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet    = $event->sheet->getDelegate();
                $dataLast = $sheet->getHighestRow(); // baris terakhir data (sebelum insert)

                // Sisipkan 7 baris di atas untuk area summary
                $sheet->insertNewRowBefore(1, 7);

                // ===== BARIS 1: JUDUL =====
                $sheet->mergeCells('A1:I1');
                $sheet->setCellValue('A1', 'LAPORAN TRANSAKSI BARANG');
                $sheet->getStyle('A1')->applyFromArray([
                    'font'      => ['bold' => true, 'size' => 14, 'color' => ['rgb' => 'FFFFFF']],
                    'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '1E3A8A']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                ]);
                $sheet->getRowDimension(1)->setRowHeight(32);

                // ===== BARIS 2: INFO PERIODE =====
                $sheet->mergeCells('A2:I2');
                $dari   = $this->dari   ? \Carbon\Carbon::parse($this->dari)->format('d/m/Y')   : '-';
                $sampai = $this->sampai ? \Carbon\Carbon::parse($this->sampai)->format('d/m/Y') : '-';
                $jenis  = match($this->jenis) {
                    'masuk'  => 'Barang Masuk',
                    'keluar' => 'Barang Keluar',
                    default  => 'Semua Transaksi',
                };
                $sheet->setCellValue('A2', "Periode: {$dari} — {$sampai}   |   Jenis: {$jenis}   |   Dicetak: " . now()->format('d/m/Y H:i'));
                $sheet->getStyle('A2')->applyFromArray([
                    'font'      => ['size' => 9, 'color' => ['rgb' => 'FFFFFF']],
                    'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '1E40AF']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                ]);
                $sheet->getRowDimension(2)->setRowHeight(18);

                // ===== BARIS 3: KOSONG =====
                $sheet->getRowDimension(3)->setRowHeight(8);

                // ===== BARIS 4-5: SUMMARY CARDS =====
                // Card Masuk: kolom A-C
                $sheet->mergeCells('A4:C4');
                $sheet->mergeCells('A5:C5');
                $sheet->setCellValue('A4', 'TOTAL BARANG MASUK');
                $sheet->setCellValue('A5', $this->totalMasuk);
                $sheet->getStyle('A4:C5')->applyFromArray([
                    'fill'    => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'DCFCE7']],
                    'borders' => ['outline' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'BBF7D0']]],
                ]);
                $sheet->getStyle('A4')->applyFromArray([
                    'font'      => ['bold' => true, 'size' => 9, 'color' => ['rgb' => '15803D']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                ]);
                $sheet->getStyle('A5')->applyFromArray([
                    'font'      => ['bold' => true, 'size' => 22, 'color' => ['rgb' => '15803D']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                ]);

                // Card Keluar: kolom E-G
                $sheet->mergeCells('E4:G4');
                $sheet->mergeCells('E5:G5');
                $sheet->setCellValue('E4', 'TOTAL BARANG KELUAR');
                $sheet->setCellValue('E5', $this->totalKeluar);
                $sheet->getStyle('E4:G5')->applyFromArray([
                    'fill'    => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'FEE2E2']],
                    'borders' => ['outline' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'FECACA']]],
                ]);
                $sheet->getStyle('E4')->applyFromArray([
                    'font'      => ['bold' => true, 'size' => 9, 'color' => ['rgb' => 'DC2626']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                ]);
                $sheet->getStyle('E5')->applyFromArray([
                    'font'      => ['bold' => true, 'size' => 22, 'color' => ['rgb' => 'DC2626']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                ]);

                // Card Stok Akhir: kolom I
                $sheet->mergeCells('I4:I4');
                $sheet->mergeCells('I5:I5');
                $sheet->setCellValue('I4', 'STOK AKHIR');
                $sheet->setCellValue('I5', $this->stokAkhir);
                $sheet->getStyle('I4:I5')->applyFromArray([
                    'fill'    => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'DBEAFE']],
                    'borders' => ['outline' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'BFDBFE']]],
                ]);
                $sheet->getStyle('I4')->applyFromArray([
                    'font'      => ['bold' => true, 'size' => 9, 'color' => ['rgb' => '1E40AF']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                ]);
                $sheet->getStyle('I5')->applyFromArray([
                    'font'      => ['bold' => true, 'size' => 22, 'color' => ['rgb' => '1E40AF']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                ]);

                $sheet->getRowDimension(4)->setRowHeight(18);
                $sheet->getRowDimension(5)->setRowHeight(32);

                // ===== BARIS 6: KOSONG =====
                $sheet->getRowDimension(6)->setRowHeight(8);

                // ===== BARIS 7: HEADING TABEL (tulis manual) =====
                $headers = ['No', 'Tanggal', 'No Transaksi', 'Kode Part', 'Nama Barang', 'Merek & Tipe', 'Jenis', 'Qty', 'Keterangan'];
                foreach ($headers as $col => $label) {
                    $sheet->setCellValueByColumnAndRow($col + 1, 7, $label);
                }
                $sheet->getStyle('A7:I7')->applyFromArray([
                    'font'      => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                    'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '1E40AF']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                ]);
                $sheet->getRowDimension(7)->setRowHeight(22);

                // ===== DATA BARIS 8 KE BAWAH =====
                $newLast = $sheet->getHighestRow();
                $sheet->getStyle('A7:I' . $newLast)->applyFromArray([
                    'borders' => [
                        'allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'CBD5E1']],
                    ],
                ]);

                for ($row = 8; $row <= $newLast; $row++) {
                    // Zebra stripe
                    if ($row % 2 === 0) {
                        $sheet->getStyle('A' . $row . ':I' . $row)->applyFromArray([
                            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'F8FAFC']],
                        ]);
                    }
                    // Warna kolom Jenis
                    $jenis = $sheet->getCell('G' . $row)->getValue();
                    $sheet->getStyle('G' . $row)->applyFromArray([
                        'font'      => ['bold' => true, 'color' => ['rgb' => $jenis === 'Masuk' ? '15803D' : 'DC2626']],
                        'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                    ]);
                }

                // Rata tengah kolom tertentu
                foreach (['A', 'B', 'C', 'D', 'G', 'H'] as $col) {
                    $sheet->getStyle($col . '7:' . $col . $newLast)
                          ->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                }
            },
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [];
    }
}