<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\CostGroup;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
class CostGroupExport implements FromCollection,WithMapping,WithHeadings,WithColumnWidths,WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CostGroup::all();
    }
    public function map($costgrup): array
    {
       
     
        return [
           
            $costgrup->groupcode,
            $costgrup->groupname,
            $costgrup->bookvalrate,
            $costgrup->life,
            $costgrup->Building,
            $costgrup->Ledger1,
            $costgrup->Ledger2,
            $costgrup->Ledger3,
            $costgrup->Ledger4,
            $costgrup->Ledger5,
            $costgrup->Ledger6,
            $costgrup->Ledger7,
            $costgrup->taxdepreciation,
            $costgrup->bookdeptrate,
        
            
           
        ];
    }
    public function headings(): array
    {
        return [
            'groupcode',
            'groupname',
            'bookvalrate',
            'life',
            'Building',
            'Ledger1',
            'Ledger2',
            'Ledger3',
            'Ledger4',
            'Ledger5',
            'Ledger6',
            'Ledger7',
            'taxdepreciation',
            'bookdeptrate',
           
           
        ];
    }
    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 20,                   
            'C' => 20,                   
            'D' => 20,                   
            'E' => 20,                   
            'F' => 20,                   
            'G' => 20,                   
            'H' => 20,                   
            'I' => 20,                   
            'J' => 20,                   
            'K' => 20,                   
            'L' => 20,                   
            'M' => 20,                   
            'N' => 20,                   
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
        $sheet->getStyle('A1:N1')->applyFromArray($styleArray);
}
}
