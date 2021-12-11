<?php

namespace App\Exports\report_transaction;

use App\Models\Asset_transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
class ReportTransferLocation implements FromCollection,WithMapping,WithHeadings,WithStyles,WithColumnWidths
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
        $data = Asset_transaction::where('transaction_name','Relocation request')->where('approval',1);
        if(!empty($this->request->filterstartdate) && !empty($this->request->filterenddate)){
            $data->whereBetween('transaction_date',[$this->request->filterstartdate,$this->request->filterenddate]);
        }
        $data = $data->get();
        return $data;
    }
    public function map($transferLocation): array
    {
        return [
        
            $transferLocation->tangnumber,
            $transferLocation->approveasset->serial,
            $transferLocation->approveasset->notes,
            $transferLocation->approveasset->models,
            $transferLocation->approvelocation->location_sub->locationname_sub,
            $transferLocation->approvecostcenter->costcenterdesc,
            $transferLocation->approvecustodian->custodianname,
         
               
    ];
}
        public function headings(): array
        {
            return [
                'Asset ID',
                'Serial',
                'Notes',
                'Models',
                'Location',
                'Cost Center',
                'Custodian',
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
            
            $sheet->getStyle('A1:G1')->applyFromArray($styleArray);
        
    }
}
