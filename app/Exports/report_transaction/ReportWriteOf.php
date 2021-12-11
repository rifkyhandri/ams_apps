<?php

namespace App\Exports\report_transaction;
use App\Models\Asset_transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
class ReportWriteOf implements FromCollection,WithMapping,WithHeadings,WithColumnWidths,WithStyles
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
        $data = Asset_transaction::where('transaction_name','Write Off')->where('approval',1);
        if(!empty($this->request->filterstartdate) && !empty($this->request->filterenddate)){
            $data->whereBetween('transaction_date',[$this->request->filterstartdate,$this->request->filterenddate]);
        }
        $data = $data->get();
        return $data;
    }
    public function map($writeoff): array
    {
        return [
        
            $writeoff->tangnumber,
            $writeoff->approveasset->serial,
            $writeoff->approveasset->notes,
            $writeoff->approveasset->models,
            $writeoff->approveasset->account,
            $writeoff->transaction_date,
            $writeoff->wd_value,

         
               
    ];
}
        public function headings(): array
        {
            return [
                'Asset ID',
                'Serial',
                'Notes',
                'Models',
                'Account',
                'Write of date',
                'Write of Value',
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
