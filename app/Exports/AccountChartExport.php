<?php

namespace App\Exports;

use App\Models\AccountChart;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
class AccountChartExport implements FromCollection,WithMapping,WithHeadings,WithColumnWidths,WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return AccountChart::all();
    }
    public function map($accountchart): array
    {
        
        return [
        
            $accountchart->accountno,
            $accountchart->accountname,
            $accountchart->accountshortname,
            $accountchart->accountgroup,
            $accountchart->oldaccount,
            $accountchart->subgroup,
            $accountchart->type,
            $accountchart->level,
            $accountchart->status,
               
    ];
}
        public function headings(): array
        {
            return [
                'Account No',
                'Account Name',
                'Account Short Name',
                'Account Group',
                'Old Account',
                'Subs Group',
                'Type',
                'Level',
                'Status',
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
            
            $sheet->getStyle('A1:I1')->applyFromArray($styleArray);
    }
}
