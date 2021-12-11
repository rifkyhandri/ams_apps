<?php

namespace App\Exports\report_summary;

use App\Models\Asset;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;

class ReportCommercial implements FromCollection,WithMapping,WithHeadings,WithStyles,WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
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
        
        $data = Asset::select('assetgroup',DB::RAW('SUM(purchaseacq) as FA'))
                        ->with('objcostgroup')
                        ->groupBy('assetgroup');


         if(!empty($this->request->filtercostgroup)){
            $data->whereIn('assetgroup',$this->request->filtercostgroup);
        }

        $data = $data->get();

        return $data;
    }
    
    public function map($summary): array
    {
       
        return [
        
            (!empty($summary->objcostgroup) ? $summary->objcostgroup->groupname : null),
            $summary->FA,
            $summary->FA,
        ];
    }

    public function headings(): array
    {
        return [
            'Cost Group',
            'FA Prev',
            'FA Current',
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
