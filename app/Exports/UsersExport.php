<?php

namespace App\Exports;

use App\Registro;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Facades\DB;

class UsersExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Registro::select('registros.id','numero_control','numero_memorandum','numero_caja','numero_expediente',
        'numero_control_archivo','nombre_expediente','clave_clasificacion','cdd.seccion_serie as descripcion_clave','fecha_informacion',
        'valdoc_administrativo','cdd.vigdoc_vigenciacompleta','cdd.vigdoc_archivotramite','cdd.vigdoc_archivoconcentracion','historico_baja',
        'observaciones','autoriza_transferencia','quien_envia','quien_recibe',DB::raw('DATE_FORMAT(fecha_recibe,"%d/%m/%Y") as fecha_recibe'),'unidad_remitente',
        'destino','destino_rack','destino_cuadrante','destino_nivel','archivo_expediente','uc.name as usuario_crea',DB::raw('DATE_FORMAT(registros.created_at,"%d/%m/%Y") as createdat'),
        DB::raw('TIME(registros.created_at) as hora_alta'),'ua.name as usuario_actualiza',DB::raw('DATE_FORMAT(registros.updated_at,"%d/%m/%Y") as updatedat'),
        DB::raw('TIME(registros.updated_at) as hora_actualiza'),'ud.name as usuario_elimina',DB::raw('DATE_FORMAT(registros.deleted_at,"%d/%m/%Y") as deletedat'),DB::raw('TIME(registros.deleted_at) as hora_elimina')) 
        ->leftjoin('users as uc','registros.usuario_crea','=','uc.id')
        ->leftjoin('users as ua','registros.usuario_actualiza','=','ua.id')
        ->leftjoin('users as ud','registros.usuario_elimina','=','ud.id')
        ->leftjoin('catalogo_disposicion_documentals as cdd','registros.clave_clasificacion','=','cdd.clave')
        ->get();
    }

    public function headings(): array
    {
        return [
            '#',
            'No de Control',
            'Memorandum',
            'No de Caja',
            'No de Expediente',
            'No de Contról de Archivo',
            'Nombre del Expediente',
            'Clave de Clasificación',
            'Descripción clave',
            'Fechas Extremas',
            'Valor Documental',
            'Vigencia Completa',
            'Archivo de Trámite',
            'Archivo de Concentración',
            'Baja',
            'Observaciones',
            'Autoriza transferencia',
            'Entrega Documentación',
            'Recibe Documentación',
            'Fecha de Recepción',
            'Unidad Remitente',
            'Destino',
            'Rack',
            'Cuadrante',
            'Nivel',
            'Archivo de Expediente',
            'Usuario Alta',
            'Fecha Alta',
            'Hora Alta',
            'Usuario Modifica',
            'Fecha Modifica',
            'Hora Modifica',
            'Usuario Elimina',
            'Fecha Elimina',
            'Hora Elimina'
        ];
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {     
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                /**
                * @return array
                */        
                $styleArray = [
                    'font' => [
                        'size' => 12,
                        'bold' => true,
                        'color' => [
                            'argb' => 'FFFFFFFF',
                        ],
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '00000000'],
                        ],
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => [
                            'argb' => 'FF696969',
                        ],
                    ],                    
                ];
                $cellRange = 'A1:AI1'; // All headers
                // $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
                $event->sheet->getDelegate()->getStyle($cellRange)->applyFromArray($styleArray);
            },
        ];
    }    
}
