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
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

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
            $masuk = BarangMasuk::with(['barang.brand', 'supplier'])
                ->whereBetween('tanggal', [$this->dari, $this->sampai])
                ->get()
                ->map(function ($item) {
                    $this->totalMasuk += $item->jumlah;
                    return [
                        'tanggal_sort' => $item->tanggal,
                        'tanggal'      => \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y'),
                        'no'           => 'GPM-' . \Carbon\Carbon::parse($item->tanggal)->format('ymd') . '-' . str_pad($item->id, 3, '0', STR_PAD_LEFT),
                        'kode'         => $item->barang?->kode ?? '-',
                        'barang'       => $item->barang?->nama_barang ?? '-',
                        'merek_tipe'   => trim(($item->barang?->brand?->nama_brand ?? '') . ' ' . ($item->barang?->tipe ?? '')),
                        'jenis'        => 'Masuk',
                        'jumlah'       => $item->jumlah,
                        'keterangan'   => $item->supplier?->nama_supplier ?? '-',
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
                        'tanggal_sort' => $item->tanggal,
                        'tanggal'      => \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y'),
                        'no'           => 'GPK-' . \Carbon\Carbon::parse($item->tanggal)->format('ymd') . '-' . str_pad($item->id, 3, '0', STR_PAD_LEFT),
                        'kode'         => $item->barang?->kode ?? '-',
                        'barang'       => $item->barang?->nama_barang ?? '-',
                        'merek_tipe'   => trim(($item->barang?->brand?->nama_brand ?? '') . ' ' . ($item->barang?->tipe ?? '')),
                        'jenis'        => 'Keluar',
                        'jumlah'       => $item->jumlah,
                        'keterangan'   => $item->tujuan ?? '-',
                    ];
                });
        }

        $this->stokAkhir = \App\Models\Barang::sum('stok');

        $semua = $masuk->concat($keluar)->sortByDesc('tanggal_sort')->values();

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
                $sheet = $event->sheet->getDelegate();

                // Sisipkan 10 baris di atas (header jadi 4 baris)
                $sheet->insertNewRowBefore(1, 10);

                // ===== BARIS 1-4: HEADER (logo kiri, judul+info kanan) =====
                // Seluruh area header background putih
                $sheet->getStyle('A1:I4')->applyFromArray([
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'FFFFFF']],
                ]);

                // Area logo: A1:C4
                $sheet->mergeCells('A1:C4');
                $sheet->getStyle('A1:C4')->applyFromArray([
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'FFFFFF']],
                ]);

                // Area judul: D1:I1
                $sheet->mergeCells('D1:I1');
                $sheet->setCellValue('D1', 'Laporan Transaksi Barang');
                $sheet->getStyle('D1')->applyFromArray([
                    'font'      => ['bold' => true, 'size' => 13, 'color' => ['rgb' => '1E3A8A']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_RIGHT, 'vertical' => Alignment::VERTICAL_CENTER],
                ]);

                // Info periode, jenis, dicetak — D2, D3, D4 (masing-masing baris sendiri)
                $dari   = $this->dari   ? \Carbon\Carbon::parse($this->dari)->format('d/m/Y')   : '-';
                $sampai = $this->sampai ? \Carbon\Carbon::parse($this->sampai)->format('d/m/Y') : '-';
                $jenis  = match($this->jenis) {
                    'masuk'  => 'Barang Masuk',
                    'keluar' => 'Barang Keluar',
                    default  => 'Semua Transaksi',
                };

                $sheet->mergeCells('D2:I2');
                $sheet->setCellValue('D2', "Periode  :  {$dari} — {$sampai}");
                $sheet->getStyle('D2')->applyFromArray([
                    'font'      => ['size' => 9, 'color' => ['rgb' => '64748B']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_RIGHT, 'vertical' => Alignment::VERTICAL_CENTER],
                ]);

                $sheet->mergeCells('D3:I3');
                $sheet->setCellValue('D3', "Jenis     :  {$jenis}");
                $sheet->getStyle('D3')->applyFromArray([
                    'font'      => ['size' => 9, 'color' => ['rgb' => '64748B']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_RIGHT, 'vertical' => Alignment::VERTICAL_CENTER],
                ]);

                $sheet->mergeCells('D4:I4');
                $sheet->setCellValue('D4', "Dicetak  :  " . now()->setTimezone('Asia/Jakarta')->format('d/m/Y H:i'));
                $sheet->getStyle('D4')->applyFromArray([
                    'font'      => ['size' => 9, 'color' => ['rgb' => '64748B']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_RIGHT, 'vertical' => Alignment::VERTICAL_CENTER],
                ]);

                $sheet->getRowDimension(1)->setRowHeight(22);
                $sheet->getRowDimension(2)->setRowHeight(14);
                $sheet->getRowDimension(3)->setRowHeight(14);
                $sheet->getRowDimension(4)->setRowHeight(14);

                // Logo GudangPro
                $logoPath = public_path('images/LogoGudangPro.png');
                if (file_exists($logoPath)) {
                    $drawing = new Drawing();
                    $drawing->setName('GudangPro');
                    $drawing->setDescription('Logo GudangPro');
                    $drawing->setPath($logoPath);
                    $drawing->setHeight(50);
                    $drawing->setCoordinates('A1');
                    $drawing->setOffsetX(6);
                    $drawing->setOffsetY(4);
                    $drawing->setWorksheet($sheet);
                }

                // ===== BARIS 5: GARIS BIRU BAWAH HEADER =====
                $sheet->mergeCells('A5:I5');
                $sheet->getStyle('A5:I5')->applyFromArray([
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '1E40AF']],
                ]);
                $sheet->getRowDimension(5)->setRowHeight(4);

                // ===== BARIS 6: KOSONG =====
                $sheet->getRowDimension(6)->setRowHeight(8);

                // ===== BARIS 7-8: SUMMARY CARDS =====
                // Card Masuk: A-C
                $sheet->mergeCells('A7:C7');
                $sheet->mergeCells('A8:C8');
                $sheet->setCellValue('A7', 'TOTAL BARANG MASUK');
                $sheet->setCellValue('A8', $this->totalMasuk);
                $sheet->getStyle('A7:C8')->applyFromArray([
                    'fill'    => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'DCFCE7']],
                    'borders' => ['outline' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'BBF7D0']]],
                ]);
                $sheet->getStyle('A7')->applyFromArray([
                    'font'      => ['bold' => true, 'size' => 9, 'color' => ['rgb' => '15803D']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                ]);
                $sheet->getStyle('A8')->applyFromArray([
                    'font'      => ['bold' => true, 'size' => 22, 'color' => ['rgb' => '15803D']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                ]);

                // Card Keluar: D-F
                $sheet->mergeCells('D7:F7');
                $sheet->mergeCells('D8:F8');
                $sheet->setCellValue('D7', 'TOTAL BARANG KELUAR');
                $sheet->setCellValue('D8', $this->totalKeluar);
                $sheet->getStyle('D7:F8')->applyFromArray([
                    'fill'    => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'FEE2E2']],
                    'borders' => ['outline' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'FECACA']]],
                ]);
                $sheet->getStyle('D7')->applyFromArray([
                    'font'      => ['bold' => true, 'size' => 9, 'color' => ['rgb' => 'DC2626']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                ]);
                $sheet->getStyle('D8')->applyFromArray([
                    'font'      => ['bold' => true, 'size' => 22, 'color' => ['rgb' => 'DC2626']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                ]);

                // Card Stok Akhir: G-I
                $sheet->mergeCells('G7:I7');
                $sheet->mergeCells('G8:I8');
                $sheet->setCellValue('G7', 'STOK AKHIR');
                $sheet->setCellValue('G8', $this->stokAkhir);
                $sheet->getStyle('G7:I8')->applyFromArray([
                    'fill'    => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'DBEAFE']],
                    'borders' => ['outline' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'BFDBFE']]],
                ]);
                $sheet->getStyle('G7')->applyFromArray([
                    'font'      => ['bold' => true, 'size' => 9, 'color' => ['rgb' => '1E40AF']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                ]);
                $sheet->getStyle('G8')->applyFromArray([
                    'font'      => ['bold' => true, 'size' => 22, 'color' => ['rgb' => '1E40AF']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                ]);

                $sheet->getRowDimension(7)->setRowHeight(18);
                $sheet->getRowDimension(8)->setRowHeight(32);

                // ===== BARIS 9: KOSONG =====
                $sheet->getRowDimension(9)->setRowHeight(8);

                // ===== BARIS 10: HEADING TABEL =====
                // Heading dipindah ke baris 9 karena header sekarang 4 baris (1-3 + garis biru)
                // Tapi kita insert 8 baris, jadi data mulai dari baris 10
                // Heading manual di baris 9
                $headers = ['No', 'Tanggal', 'No Transaksi', 'Kode Part', 'Nama Barang', 'Merek & Tipe', 'Jenis', 'Qty', 'Supplier / Tujuan'];
                foreach ($headers as $col => $label) {
                    $sheet->setCellValueByColumnAndRow($col + 1, 10, $label);
                }
                $sheet->getStyle('A10:I10')->applyFromArray([
                    'font'      => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                    'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '1E40AF']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                ]);
                $sheet->getRowDimension(10)->setRowHeight(22);

                // ===== DATA BARIS 11 KE BAWAH =====
                $newLast = $sheet->getHighestRow();
                $sheet->getStyle('A10:I' . $newLast)->applyFromArray([
                    'borders' => [
                        'allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'CBD5E1']],
                    ],
                ]);

                for ($row = 11; $row <= $newLast; $row++) {
                    if ($row % 2 === 0) {
                        $sheet->getStyle('A' . $row . ':I' . $row)->applyFromArray([
                            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'F8FAFC']],
                        ]);
                    }
                    $jenisVal = $sheet->getCell('G' . $row)->getValue();
                    $sheet->getStyle('G' . $row)->applyFromArray([
                        'font'      => ['bold' => true, 'color' => ['rgb' => $jenisVal === 'Masuk' ? '15803D' : 'DC2626']],
                        'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                    ]);
                }

                foreach (['A', 'B', 'C', 'D', 'G', 'H'] as $col) {
                    $sheet->getStyle($col . '9:' . $col . $newLast)
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