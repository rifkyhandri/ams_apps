<?php

namespace App\Exports;

use App\Models\Location;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
class LocationExport implements FromCollection,WithMapping,WithHeadings,WithColumnWidths,WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Location::all();
    }
    public function map($location): array
    {
        return [
           
            $location->locationcode,
            $location->locationname,
            $location->country, 
        ];
    }
    public function headings(): array
    {
        return [
            'LOCATION CODE',
            'CITY',
            'COUNTRY', 
        ];
    }
    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 20,                                      
            'C' => 20,                                      
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
        $sheet->getStyle('A1:C1')->applyFromArray($styleArray);
}
}
