<?php

namespace App\Exports;

use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class LaporanExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize, WithTitle
{
    protected $dari;
    protected $sampai;
    protected $jenis;

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

    public function headings(): array
    {
        return ['No', 'Tanggal', 'No Transaksi', 'Kode Part', 'Nama Barang', 'Jenis', 'Qty', 'Keterangan'];
    }

    public function collection()
    {
        // Jika tanggal tidak dipilih, kembalikan kosong
        if (!$this->dari || !$this->sampai) {
            return collect();
        }

        $masuk = collect();
        if ($this->jenis === 'semua' || $this->jenis === 'masuk') {
            $masuk = BarangMasuk::with(['barang', 'supplier'])
                ->whereBetween('tanggal', [$this->dari, $this->sampai])
                ->get()
                ->map(fn($item) => [
                    'tanggal'    => $item->tanggal,
                    'no'         => 'BM-' . str_pad($item->id, 3, '0', STR_PAD_LEFT),
                    'kode'       => $item->barang?->kode ?? '-',
                    'barang'     => $item->barang?->nama_barang ?? '-',
                    'jenis'      => 'Masuk',
                    'jumlah'     => $item->jumlah,
                    'keterangan' => 'Pembelian',
                ]);
        }

        $keluar = collect();
        if ($this->jenis === 'semua' || $this->jenis === 'keluar') {
            $keluar = BarangKeluar::with(['barang'])
                ->whereBetween('tanggal', [$this->dari, $this->sampai])
                ->get()
                ->map(fn($item) => [
                    'tanggal'    => $item->tanggal,
                    'no'         => 'BK-' . str_pad($item->id, 3, '0', STR_PAD_LEFT),
                    'kode'       => $item->barang?->kode ?? '-',
                    'barang'     => $item->barang?->nama_barang ?? '-',
                    'jenis'      => 'Keluar',
                    'jumlah'     => $item->jumlah,
                    'keterangan' => 'Penjualan',
                ]);
        }

        $semua = $masuk->concat($keluar)->sortByDesc('tanggal')->values();

        return $semua->map(fn($item, $i) => [
            $i + 1,
            $item['tanggal'],
            $item['no'],
            $item['kode'],
            $item['barang'],
            $item['jenis'],
            $item['jumlah'],
            $item['keterangan'],
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:H1')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '1E40AF']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);

        $lastRow = $sheet->getHighestRow();
        $sheet->getStyle('A1:H' . $lastRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'CBD5E1'],
                ],
            ],
        ]);

        for ($row = 2; $row <= $lastRow; $row++) {
            if ($row % 2 === 0) {
                $sheet->getStyle('A' . $row . ':H' . $row)->applyFromArray([
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'F8FAFC']],
                ]);
            }
        }

        for ($row = 2; $row <= $lastRow; $row++) {
            $jenis = $sheet->getCell('F' . $row)->getValue();
            if ($jenis === 'Masuk') {
                $sheet->getStyle('F' . $row)->applyFromArray([
                    'font' => ['color' => ['rgb' => '15803D']],
                ]);
            } else {
                $sheet->getStyle('F' . $row)->applyFromArray([
                    'font' => ['color' => ['rgb' => 'DC2626']],
                ]);
            }
        }

        return [];
    }
}