<?php

namespace App\Exports;

use App\Models\Custodian;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
class CustodianExport implements FromCollection,WithHeadings,WithMapping,WithStyles,WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Custodian::all();
    }
    public function map($custodian): array
    {
       
        return [
           
            $custodian->custodiancode,
            $custodian->custodianname,
            $custodian->contact,
            $custodian->address,
            $custodian->OpeningDate,
            $custodian->phone,
            $custodian->city,
            $custodian->postal,
            $custodian->fax,
            $custodian->telex,
            $custodian->email,
            $custodian->usertype,
            $custodian->company,
            $custodian->status,

            
           
        ];
    }
    public function headings(): array
    {
        return [
            'custodiancode',
            'custodianname',
            'contact',
            'address',
            'OpeningDate',
            'phone',
            'city',
            'postal',
            'fax',
            'telex',
            'email',
            'usertype',
            'company',    
            'status',
    
           
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
