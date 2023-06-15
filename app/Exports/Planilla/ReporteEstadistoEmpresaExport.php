<?php

namespace App\Exports\Planilla;

use App\Models\Admin\DepMun;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Files\LocalTemporaryFile;

class ReporteEstadistoEmpresaExport implements WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $empresa;
    public $path;

    public function __construct($empresa,$path)
    {
        $this->empresa = $empresa;
        $this->path = $path;

    }
    public function registerEvents(): array
    {
        return [
            BeforeWriting::class => function(BeforeWriting $event) {
                $event->writer->reopen(new  LocalTemporaryFile(storage_path('/app'.$this->path)), Excel::XLSX);
                $event->writer->getSheetByIndex(0);
                $event->writer->getSheetByIndex(0)->export($event->getConcernable()); // call the export on the first sheet
                return $event->getWriter()->getSheetByIndex(0);
            },
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->setCellValue('B9', $this->empresa->emp_NIT);
                $event->sheet->setCellValue('B10', $this->empresa->emp_nombre);
                $event->sheet->setCellValue('B11', $this->empresa->Pais->pai_descripcion);
                $event->sheet->setCellValue('B12', '');
                $event->sheet->setCellValue('B13', $this->empresa->emp_numeroIGSS);

                $event->sheet->setCellValue('B16', $this->empresa->emp_colonia);
                $event->sheet->setCellValue('D16', $this->empresa->emp_zona);

                $event->sheet->setCellValue('B17', $this->empresa->emp_calle);
                $event->sheet->setCellValue('D17', $this->empresa->emp_avenida);

                $event->sheet->setCellValue('B18', $this->empresa->emp_telefono);
                $event->sheet->setCellValue('D18', $this->empresa->emp_nomenclatura);

                $event->sheet->setCellValue('B19', $this->empresa->emp_sitioWeb);
                $event->sheet->setCellValue('D19', $this->empresa->emp_email);

                $event->sheet->setCellValue('B20', $this->empresa->emp_sindicato?'SI':'NO');

                $event->sheet->setCellValue('B23',$this->empresa->Pais->pai_descripcion);

                $event->sheet->setCellValue('B24', (new DepMun())->getDepto($this->empresa->emp_municipio));
                $event->sheet->setCellValue('D24', (new DepMun())->getDepto($this->empresa->emp_municipio));

                $event->sheet->setCellValue('B27', Carbon::parse($this->empresa->emp_inicio)->format('d/m/Y'));
                $event->sheet->setCellValue('B38',  $this->empresa->emp_descripcion);
                $event->sheet->setCellValue('B58', now()->format('Y'));

            },

        ];
    }

}
