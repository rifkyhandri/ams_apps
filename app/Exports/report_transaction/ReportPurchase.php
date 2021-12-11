<?php

namespace App\Exports\report_transaction;

use App\Models\Asset;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
class ReportPurchase implements FromCollection,WithMapping,WithHeadings,WithColumnWidths,WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $request;
    public function __construct($request)
    {
        $this->request = $request;
    }
    public function collection()
    {

        $asset = Asset::with('objassetstatus');
        if(!empty($this->request->filterstartdate) && !empty($this->request->filterenddate)){
            $asset->whereBetween('datepurchase',[$this->request->filterstartdate,$this->request->filterenddate]);
        }
        
        $asset = $asset->get();
        return $asset;
      
        
    }
    public function map($purchase): array
    {
        return [
        
            $purchase->tangnumber,
            $purchase->serial,
            $purchase->notes,
            $purchase->models,
            $purchase->datepurchase,
            $purchase->purchasecost,
           
    ];
}
        public function headings(): array
        {
            return [
                'Asset Code',
                'Serial',
                'Notes',
                'Models',
                'Date Purchase',
                'Cost',
             
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
            
            $sheet->getStyle('A1:F1')->applyFromArray($styleArray);
        
    }
}
