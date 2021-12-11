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

class ReportDetailCom implements FromCollection,WithMapping,WithHeadings,WithStyles,WithColumnWidths
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
        
        $data = Asset::select(
                            '*','asset_id as id',
                            DB::RAW("YEAR(CURDATE()) - YEAR(dateacq) - (DATE_FORMAT(CURDATE(), '%m%d') < DATE_FORMAT(dateacq, '%m%d')) as useful"),
                            DB::RAW("DATE_ADD(dateacq,INTERVAL lifetimeyear YEAR) as duedate"),
                            )
                        ->with('objcostgroup')
                        ->with(array('objlocation'=>function($query){
                            $query->with(array('location_big'=>function($location_big){
                                $location_big->select('id','locationname');
                            },'location_sub'=>function($location_sub){
                                $location_sub->select('id','locationname_sub');
                            }));
                        }));

         if(!empty($this->request->filtercostgroup)){
            $data->whereIn('assetgroup',$this->request->filtercostgroup);
        }

        if(!empty($this->request->filterstartdate) && !empty($this->request->filterenddate)){
            $data->whereBetween('dateacq',[$this->request->filterstartdate,$this->request->filterenddate]);
        }

        $data = $data->get();

        return $data;
    }
    
    public function map($summary): array
    {
       
        return [
        
            (!empty($summary->objcostgroup) ? $summary->objcostgroup->groupname : null),
            $summary->tangnumber,
            (!empty($summary->objlocation) ? $summary->objlocation->locationname_sm : null),
            $summary->assetname,
            $summary->acqdate,
            $summary->purchaseacq,
            $summary->purchaseacq,
            0,
            0,
            0,
            $summary->purchaseacq,
            $summary->purchaseacq,
            $summary->duedate,
            $summary->useful,
            $summary->lifetimeyear,
        ];
    }

    public function headings(): array
    {
        return [
            'Cost Group',
            'Asset Code',
            'Location',
            'Description',
            'Acq Date',
            'Acq Cost',
            'Total Cost',
            'Month Deprec',
            'Accum Deprec',
            'Total Deprec',
            'Book Value',
            'Total Value',
            'Due Date',
            'Useful Life',
            'Age of Asset',
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
            'O' => 20,            
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
        
        $sheet->getStyle('A1:O1')->applyFromArray($styleArray);
    
    }
}
