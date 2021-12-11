<?php

namespace App\Exports;

use App\Models\Provider;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
class ServiceProviderExport implements FromCollection,WithMapping,WithHeadings,WithColumnWidths,WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Provider::all();
    }
    public function map($provider): array
    {
      
        
        return [
        
            $provider->providercode,
            $provider->providername,
            $provider->contact,
            $provider->address,
            $provider->OpeningDate,
            $provider->city,
            $provider->postal,
            $provider->phone,
            $provider->fax,
            $provider->created_at,
        
            
        
    ];
}
public function headings(): array
{
    return [
        'Provider Code',
        'Provider Name',
        'Contact',
        'Address',
        'Opening Date',
        'City',
        'Postal',
        'Phone',
        'fax',
        'created_at',
       
       
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
    $sheet->getStyle('A1:J1')->applyFromArray($styleArray);
}
}
