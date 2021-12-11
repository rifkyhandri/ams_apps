<?php

namespace App\Exports;

use App\Models\Vendor;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
class VendorExport implements FromCollection,WithMapping,WithHeadings,WithStyles,WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Vendor::all();
    }
    public function map($vendor): array
    {
        return [
           
            $vendor->vendorcode,
            $vendor->vendorname,
            $vendor->account,
            $vendor->address,
            $vendor->city,
            $vendor->postal,
            $vendor->phone,
            $vendor->fax,
            $vendor->status,
            $vendor->pic,
            $vendor->pic_phone,
            $vendor->pic_email,
          
          
        ];
    }
    public function headings(): array
    {
        return [
            'vendor_code',
            'vendor_name',
            'account',
            'address',
            'city',
            'postal',
            'phone',
            'fax',
            'status',
            'pic',
            'pic_phone',
            'pic_email',
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
        $sheet->getStyle('A1:L1')->applyFromArray($styleArray);
    }
}
