<?php

namespace App\Exports;

use App\TuChance\Models\TrainingRecord;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class TrainingRecords implements
    WithMapping,
    WithColumnFormatting,
    WithHeadings,
    FromCollection,
    Responsable
{
    use Exportable;

    /**
    * It's required to define the fileName within
    * the export class when making use of Responsable.
    */
    private $fileName = 'training.xlsx';

    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * New export instance
     */
    public function __construct(Request $request)
    {
        $this->fileName = 'Capacitaciones_' . date('Y-m-d H:i') . '.xlsx';
        $this->request  = $request;
    }

    /**
     * @inheritdoc
     */
    public function collection()
    {
        $query = with(new TrainingRecord)->latest();

        if ($country = $this->request->get('workshop_id')) {
            $query->where('workshop_id', $country);
        }

        if ($estate = $this->request->get('person_id')) {
            $query->where('person_id', $estate);
        }

        if ($begin_at = $this->request->get('from')) {
            $query->whereDate(
                'created_at',
                '>=',
                date('Y-m-d', strtotime($begin_at))
            );
        }

        if ($finish_at = $this->request->get('to')) {
            $query->whereDate(
                'created_at',
                '<=',
                date('Y-m-d', strtotime($finish_at))
            );
        }

        return $query->get();
    }

    /**
     * @inheritdoc
     */
    public function headings(): array
    {
        return [
            'Primer nombre*',
            'Segundo nombre*',
            'Primer apellido*',
            'Segundo apellido*',
            'Lugar de nacimiento*',
            'Fecha de Nacimiento*',
            'Edad*',
            'Genero*',
            'Grupo étnico*',
            'Documento de identificación (DPI o partida de nacimiento)*',
            'Número de CUI*',
            'Dirección de domicilio*',
            'Departamento*',
            'Municipio*',
            'Número de telefono1*',
            'Número de teléfono 2',
            'Correo electrónico*',
            'Comunidad lingüística*',
            'Nombre de la persona de contacto*',
            'Número de teléfono*',
            'Primer nombre* (Responsable)',
            'Segundo nombre* (Responsable)',
            'Primer apellido* (Responsable)',
            'Segundo apellido* (Responsable)',
            'Parentesco*(papa, mama, abuelos, tío(a), otro) (Responsable)',
            'Edad (Responsable)',
            'Documento de identificación (DPI o partida de nacimiento)* (Responsable)',
            'Número de CUI*, (Responsable)',
            'Lugar de trabajo*, (Responsable)',
            'Teléfono de trabajo o personal*, (Responsable)',
            'Correo electrónico. (Responsable)',
            'Sabe leer y escribir*(si o no), ',
            'Jornada que estudia (matutina, vespertina, fin de semana)*',
            'Horario que estudia',
            'Taller al que aplica',
        ];
    }

    /**
     * @inheritdoc
     */
    public function map($record): array
    {
        return [
            $record->person->first_name,
            $record->person->middle_name,
            $record->person->last_name,
            $record->person->sur_name,
            $record->person->place_of_birth,
            $record->person->date_of_birth->format('Y-m-d'),
            $record->person->age,
            $record->person->gender,
            $record->person->ethnicity->name,
            $record->person->id_number,
            $record->person->cui_number,
            $record->person->adress,
            $record->person->state->name,
            $record->person->city->name,
            $record->person->phone,
            $record->person->phone_alt,
            $record->person->email,
            $record->person->language_community,
            $record->contact_name,
            $record->contact_phone,
            $record->parent_first_name,
            $record->parent_middle_name,
            $record->parent_last_name,
            $record->parent_sur_name,
            $record->parent_kinship,
            $record->parent_age,
            $record->parent_id_number,
            $record->parent_cui_number,
            $record->parent_workplace,
            $record->parent_phone,
            $record->parent_email,
            $record->can_read,
            $record->study_sessions,
            $record->study_schedule,
            $record->workshop->name,
            Date::dateTimeToExcel($record->created_at),
        ];
    }

    /**
     * @inheritdoc
     */
    public function columnFormats(): array
    {
        return [
            'AJ' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}
