<?php

namespace App\Exports;

use App\Models\Ownership;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
class OwnershipExport implements FromCollection,WithMapping,WithHeadings,WithColumnWidths,WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Ownership::all();
    }
    public function map($ownership): array
    {
        return [
        
            $ownership->id_ownership,
            $ownership->description,
         
    ];
}
public function headings(): array
{
    return [
        'ID Ownership',
        'Description',
    ];
}
public function columnWidths(): array
{
    return [
        'A' => 20,
        'B' => 20,                                      
                                 
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
    $sheet->getStyle('A1:B1')->applyFromArray($styleArray);
}
}
