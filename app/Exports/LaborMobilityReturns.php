<?php

namespace App\Exports;

use App\TuChance\Models\LaborMobilityReturn;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class LaborMobilityReturns implements WithMapping,
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
    private $fileName = 'returns.xlsx';

    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * New export instance
     */
    public function __construct(Request $request)
    {
        $this->fileName = 'Retornos_' . date('Y-m-d H:i') . '.xlsx';
        $this->request  = $request;
    }

    /**
     * @inheritdoc
     */
    public function collection()
    {
        $query = with(new LaborMobilityReturn)
            ->latest()
            ->has('country')
            ->with('person.state', 'person.city', 'country', 'estate');

        if ($country = $this->request->get('labor_mobility_country_id')) {
            $query->where('labor_mobility_country_id', $country);
        }

        if ($estate = $this->request->get('labor_mobility_estate_id')) {
            $query->where('labor_mobility_estate_id', $estate);
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
            'País*',
            'Primer Nombre*',
            'Segundo Nombre',
            'Primer Apellido*',
            'Segundo Apellido',
            'Apellido de casada',
            'Sexo',
            'Tipo de identificación',
            'Número de identificación',
            'No. De visa Estadunidense*',
            'Tipo de visa (H-2ª/H-2B)',
            'Oferta Laboral Estadunidense*',
            'Número de pasaporte*',
            'Fecha de Nacimiento',
            'Estado civil*',
            'Número de hijos*',
            'Departamento*',
            'Municipio*',
            'Dirección*',
            'Etnia*',
            'Idioma*',
            'Nivel académico*',
            'Profesión u Oficio*',
            'Teléfono*',
            'Teléfono alternativo',
            'Correo electrónico*',
            'Contacto de emergencia',
            'Contacto de emergencia (teléfono)',
            'Contacto de emergencia (correo electrónico)',
            'Nombre de la empresa o finca *',
            'Estado *',
            'Condado *',
            'Fecha de inicio de contrato*',
            'Fecha finalización de contrato*',
            'Puesto*',
            'Tipo de Contrato*',
            'Número de Contrato*',
            'Mínimo de horas trabajadas semanalmente*',
            'Salario por día',
            'Tipo de trabajo (agrícola o no agrícola)*',
            'Fecha de creación',
        ];
    }

    /**
     * @inheritdoc
     */
    public function map($return): array
    {
        return [
            $return->country->name,
            $return->person->first_name,
            $return->person->middle_name,
            $return->person->last_name,
            $return->person->sur_name,
            $return->person->married_name,
            $return->person->gender ? 'Masculino' : 'Femenino',
            $return->person->id_type,
            $return->person->id_number,
            $return->person->usa_visa,
            $return->person->usa_visa_type,
            $return->person->usa_labor_offer,
            $return->person->passport_number,
            $return->person->birth,
            $return->person->marital_status,
            $return->person->children,
            $return->person->state->name ?? 'n/a',
            $return->person->city->name ?? 'n/a',
            $return->person->address,
            $return->person->ethnicity,
            $return->person->language,
            $return->person->academic_level,
            $return->person->profession,
            $return->person->phone_number,
            $return->person->phone_number_alt,
            $return->person->email,
            $return->person->emergency_contact,
            $return->person->emergency_phone,
            $return->person->emergency_email,
            $return->estate->name,
            $return->estate->state,
            $return->estate->county,
            $return->contract_init ? Date::dateTimeToExcel($return->contract_init) : null,
            $return->contract_end ? Date::dateTimeToExcel($return->contract_end) : null,
            $return->position,
            $return->contract_type,
            $return->contract_number,
            $return->weekly_hours,
            $return->day_wage,
            $return->is_farming ? 'Sí' : 'No',
            Date::dateTimeToExcel($return->created_at),
        ];
    }

    /**
     * @inheritdoc
     */
    public function columnFormats(): array
    {
        return [
            // 'B' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            // 'C' => NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE,
            'AG' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'AH' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'AK' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}
