<?php

namespace App\Exports;

use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Events\AfterSheet;

class PeminjamanExport implements FromCollection, WithHeadings, WithStyles, WithEvents, WithTitle
{
    protected $start;
    protected $end;

    public function __construct($start = null, $end = null)
    {
        $this->start = $start;
        $this->end = $end;
    }

    public function collection()
    {
        $query = Peminjaman::with(['barang', 'user', 'approvedByUser'])
            ->when($this->start && $this->end, function($query) {
                return $query->whereBetween('tanggal_pinjam', [$this->start, $this->end]);
            });

        return $query->get()->map(function ($item, $index) {
            return [
                'No' => $index + 1,
                'ID' => $item->id,
                'Nama Barang' => optional($item->barang)->nama_barang ?? '-',
                'Nama Peminjam' => optional($item->user)->name ?? '-',
                'Tanggal Pinjam' => optional($item->tanggal_pinjam)->format('d-m-Y') ?? '-',
                'Tanggal Kembali' => optional($item->tanggal_kembali)->format('d-m-Y') ?? '-',
                'Status' => $item->status ?? '-',
                'Disetujui Oleh' => optional($item->approvedByUser)->name ?? '-',
            ];
        });
    }

    public function headings(): array
    {
        return ['No', 'ID', 'Nama Barang', 'Nama Peminjam', 'Tanggal Pinjam', 'Tanggal Kembali', 'Status', 'Disetujui Oleh'];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
            'A1:H1' => [
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'B6D7A8'],
                ],
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();

                foreach (range('A', $highestColumn) as $column) {
                    $sheet->getColumnDimension($column)->setAutoSize(true);
                }

                $sheet->getStyle("A1:{$highestColumn}{$highestRow}")
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(Border::BORDER_THIN);

                $sheet->getStyle("A2:{$highestColumn}{$highestRow}")
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $judul = 'Laporan Peminjaman';
                if ($this->start && $this->end) {
                    $judul .= " (".$this->start." - ".$this->end.")";
                }

                $sheet->insertNewRowBefore(1, 1);
                $sheet->mergeCells("A1:{$highestColumn}1");
                $sheet->setCellValue("A1", $judul);
                
                $sheet->getStyle("A1")->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 16,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                ]);
            },
        ];
    }

    public function title(): string
    {
        return 'Laporan Peminjaman';
    }
}