<?php

namespace App\Exports;

use App\Models\Pengembalian;
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

class PengembalianExport implements FromCollection, WithHeadings, WithStyles, WithEvents, WithTitle
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
        $query = Pengembalian::with(['user', 'approvedBy', 'barang'])
            ->orderBy('created_at', 'desc')
            ->when($this->start && $this->end, function($query) {
                return $query->whereBetween('tanggal_pengembalian', [$this->start, $this->end]);
            });

        return $query->get()->map(function ($item, $index) {
            return [
                'No' => $index + 1,
                'ID' => $item->id,
                'Nama User' => optional($item->user)->name ?? '-',
                'Nama Barang' => optional($item->barang)->nama_barang ?? '-',
                'Jumlah' => $item->jumlah ?? 0,
                'Tanggal Pengembalian' => optional($item->tanggal_pengembalian)->format('d-m-Y H:i:s') ?? '-',
                'Status' => $item->status ?? '-',
                'Keterangan' => $item->keterangan ?? '-',
            ];
        });
    }

    public function headings(): array
    {
        return ['No', 'ID', 'Nama User', 'Nama Barang', 'Jumlah', 'Tanggal Pengembalian', 'Status', 'Keterangan'];
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

                $judul = 'Laporan Pengembalian';
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
        return 'Laporan Pengembalian';
    }
}