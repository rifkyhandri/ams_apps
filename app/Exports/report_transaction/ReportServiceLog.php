<?php

namespace App\Exports\report_transaction;

use App\Models\ServiceLog;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
class ReportServiceLog implements FromCollection,WithMapping,WithHeadings,WithColumnWidths,WithStyles
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
        $Service = ServiceLog::with('asset');
        if(!empty($this->request->filterstartservice) && !empty($this->request->filterendservice)){
            $Service->whereBetween('servicedate',[$this->request->filterstartservice,$this->request->filterendservice]);
        }
        $Service = $Service->get();
        return $Service;
  
    }
    public function map($serviceLog): array
    {
        return [
        
            $serviceLog->tangnumber,
            $serviceLog->providercode,
            $serviceLog->notes,
            $serviceLog->servicedate,
            $serviceLog->servicecontract,
            $serviceLog->nextservice,
            $serviceLog->costservice,
         
           
    ];
}

        public function headings(): array
        {
            return [
                'Asset ID',
                'Provider Code',
                'Notes',
                'Service Date',
                'Service Contract',
                'Next Service',
                'Cost Service',
            ];
        }

        // public function columnFormats(): array
        // {
        //     return [
        //         'B' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        //         'C' => NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE,
        //     ];
        // }
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
