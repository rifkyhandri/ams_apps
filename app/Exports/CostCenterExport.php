<?php

namespace App\Exports;

use App\Models\CostCenter;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
class CostCenterExport implements FromCollection,WithMapping,WithHeadings,WithColumnWidths,WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CostCenter::all();
    }
        public function map($costcenter): array
        {
    
            return [   
                $costcenter->costcentercode,
                $costcenter->costcenterdesc,
                $costcenter->coa,
                $costcenter->created_at,
 
        ];
    }
    public function headings(): array
    {
        return [
            'COST CENTER CODE',
            'DESCRIPTION',
            'COA',
            'TANGGAL DI BUAT',
 
        ];
    }
    public function columnWidths(): array
        {
            return [
                'A' => 20,
                'B' => 20,                   
                'C' => 20,                   
                'D' => 20,                   
            ];
        }
    public function styles(Worksheet $sheet)
        {
           
            $styleArray = [
                'font' => [
                    'size' =>12,
                    'bold' => true,
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                    ],
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
                    'rotation' => 90,
                    'startColor' => [
                        'argb' => '6ddccf',
                    ],
                    'endColor' => [
                        'argb' => 'FFFFFFFF',
                    ],
                ],
            ];   
            $sheet->getStyle('A1:D1')->applyFromArray($styleArray);
    }
}
