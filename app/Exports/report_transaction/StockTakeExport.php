<?php

namespace App\Exports\report_transaction;

use App\Models\Asset_transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
class StockTakeExport implements FromCollection,WithMapping,WithHeadings,WithColumnWidths,WithStyles
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

        $data = Asset_transaction::where('transaction_name','Stock Take')->where('approval',1);
        if(!empty($this->request->filterstartdate) && !empty($this->request->filterenddate)){
            $data->whereBetween('transaction_date',[$this->request->filterstartdate,$this->request->filterenddate]);
        }
        if(!empty($this->request->filtertagnumber)){
            $data->where('tangnumber',$this->request->filtertagnumber);
        }
        if(!empty($this->request->filterstatus)){
            $data->where('change_stock_opname',$this->request->filterstatus);
        }
        $data = $data->get();
        return $data;
      
        
    }
    public function map($stock): array
    {
        return [
        
            $stock->tangnumber,
            $stock->approveasset->serial,
            $stock->approveasset->assetname,
            $stock->approveasset->objdepartement->departementdesc,
            $stock->approveasset->objlocation->locationname_sm,
            $stock->transaction_date,
            $stock->approver,
            $stock->change_stock_opname,
            $stock->approvecondition->conditiondesc


           
    ];
}
        public function headings(): array
        {
            return [
                'Asset Code',
                'Serial',
                'Asset Name',
                'Departement',
                'Location Name',
                'Transaction Date',
                'Approver',
                'Change Stock Opname',
                'Condition',
             
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
