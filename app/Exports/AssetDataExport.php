<?php

namespace App\Exports;

use App\Models\Asset;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;

class AssetDataExport implements FromCollection,WithMapping,WithHeadings,WithStyles,WithColumnWidths
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
        $Asset = Asset::with('objdepartement')
        ->with('objcostgroup')
        ->with('objcostcenter')
        ->with('objcustodian')
        ->with('objassetclass');

        if(!empty($this->request->filtersmlocation)){
            $Asset->with(array('objlocation'=>function($query){
                $query->with(array('location_big'=>function($location_big){
                    if(!empty($this->request->filterlocation)){
                        $location_big->select('id','locationcode','locationname')->where('locationcode',$this->request->filterlocation);
                    }else{
                        $location_big->select('id','locationcode','locationname');
                    }

                },'location_sub'=>function($location_sub){
                    if(!empty($this->request->filtersublocation)){
                        $location_sub->select('id','locationcode_sub','locationname_sub')->where('locationcode_sub',$this->request->filtersublocation);
                    }else{
                        $location_sub->select('id','locationcode_sub','locationname_sub');
                    }
                }));
            }))->where('location',$this->request->filtersmlocation);
        }else{
            $Asset->with(array('objlocation'=>function($query){
                $query->with(array('location_big'=>function($location_big){
                    if(!empty($this->request->filterlocation)){
                        $location_big->select('id','locationcode','locationname')->where('locationcode',$this->request->filterlocation);
                    }else{
                        $location_big->select('id','locationcode','locationname');
                    }
                },'location_sub'=>function($location_sub){
                    if(!empty($this->request->filtersublocation)){
                        $location_sub->select('id','locationcode_sub','locationname_sub')->where('locationcode_sub',$this->request->filtersublocation);
                    }else{
                        $location_sub->select('id','locationcode_sub','locationname_sub');
                    }
                }));
            }));
        }
                
        if(!empty($this->request->filterdepartement)){
            $Asset->where('departement',$this->request->filterdepartement);
        }

        if(!empty($this->request->filterassetgroup)){
            $Asset->where('assetgroup',$this->request->filterassetgroup);
        }

        if(!empty($this->request->filtervendor)){
            $Asset->where('vendors',$this->request->filtervendor);
        }

        if(!empty($this->request->filtercostcenter)){
            $Asset->where('costcenter',$this->request->filtercostcenter);
        }

        if(!empty($this->request->filterassettype)){
            $Asset->where('asset_type',$this->request->filterassettype);
        }

        if(!empty($this->request->filter_uploaddate)){
            $Asset->whereDate('created_at',$this->request->filter_uploaddate);
        }

        $Asset = $Asset->get();

        return $Asset;
    }

    public function map($asset): array
    {
        return [
            $asset->tangnumber,
            $asset->assetname,
            (!empty($asset->objassetclass) ? $asset->objassetclass->classdesc : null),
            (!empty($asset->objcustodian) ? $asset->objcustodian->custodianname : null),
            (!empty($asset->objdepartement) ? $asset->objdepartement->departementdesc : null),
            (!empty($asset->objcostgroup) ? $asset->objcostgroup->groupname : null),
            (!empty($asset->objlocation) ? $asset->objlocation->locationname_sm : null),
            (!empty($asset->objcostcenter) ?  $asset->objcostcenter->costcenterdesc : null),
            (!empty($asset->objvendor) ? $asset->objvendor->vendorname : null),
            $asset->models,
            (!empty($asset->objcondition) ? $asset->objcondition->conditiondesc : null),
            $asset->notes,
            $asset->payment,
            $asset->serial,
            (!empty($asset->objaccount) ? $asset->objaccount->accountname : null),
            $asset->datepurchase,
            $asset->dateacq,
            $asset->purchasecost,
            $asset->purchaseacq,
            $asset->lifetimeyear,
            $asset->livetimemonth,
            $asset->comdepreciation,
            $asset->salvage1,
            $asset->bookrate,
            (!empty($asset->objprovider) ? $asset->objprovider->providername : null),
            $asset->nextservice,
            $asset->warranty,
            $asset->servicecontract,
            $asset->tagged,
            $asset->brand,
            $asset->manufacture,
            $asset->ESN,
            $asset->partnumber,
            (!empty($asset->objowner) ? $asset->objowner->description : null),
            (!empty($asset->objassettype) ? $asset->objassettype->description : null),
            $asset->IP,
            (!empty($asset->objassetstatus) ? $asset->objassetstatus->description : null),
            $asset->gps_lat,
            $asset->gps_long,
            $asset->filename,
            $asset->att1,
            $asset->att2,
            $asset->att3
        ];
        
    }

    public function headings(): array
    {
        return [
            'ASSET CODE',
            'ASSET NAME',
            'ASSET CLASS',
            'CUSTODIAN',
            'DEPARTEMENT',
            'COST GROUP',
            'LOCATION',
            'COST CENTER',
            'VENDOR',
            'MODEL',
            'CONDITION',
            'NOTES',
            'PO NUMBER',
            'SN/License Plate',
            'ACCOUNT NUMBER',
            'PURCHASE DATE',
            'ACQ DATE',
            'PURCHASE COST',
            'ACQ COST',
            'YEAR',
            'MONTH',
            'DEPRECIATION METHOD',
            'SALVAGE',
            'DEPR RATE',
            'SERVICE PROVIDER',
            'NEXT SERVICE',
            'WARRANTY',
            'CONTRACT NO',
            'TAGGING',
            'BRAND',
            'MANUFACTURE',
            'ESN',
            'PART NUMBER',
            'OWNERSHIP',
            'TYPE',
            'IP ADDRESS',
            'STATUS',
            'LATITUDE',
            'LONGITUDE',
            'IMAGE PATH',
            'ATT1',
            'ATT2',
            'ATT3'

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
            'P' => 20,            
            'Q' => 20,            
            'R' => 20,            
            'S' => 20,            
            'T' => 20,            
            'U' => 20,            
            'V' => 20,            
            'W' => 20,            
            'X' => 20,            
            'Y' => 20,            
            'Z' => 20,
            'AA' => 20,
            'AB' => 20,            
            'AC' => 20,            
            'AD' => 20,            
            'AE' => 20,            
            'AF' => 20,            
            'AG' => 20,            
            'AH' => 20,            
            'AI' => 20,            
            'AJ' => 20,            
            'AK' => 20,            
            'AL' => 20,            
            'AM' => 20,            
            'AN' => 20,            
            'AO' => 20,            
            'AP' => 20,            
            'AQ' => 20,            
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
            
            $sheet->getStyle('A1:AQ1')->applyFromArray($styleArray);
        
    }
}
