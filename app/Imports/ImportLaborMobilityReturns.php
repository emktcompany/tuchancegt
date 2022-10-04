<?php

namespace App\Imports;

use App\TuChance\Models\LaborMobilityCountry;
use App\TuChance\Models\LaborMobilityEstate;
use App\TuChance\Models\LaborMobilityPerson;
use App\TuChance\Models\LaborMobilityReturn;

class ImportLaborMobilityReturns extends BaseImport
{
    /**
     * @param  array  $row
     * @param  int    $index
     * @return void
     */
    protected function onRow($row, $index)
    {
        $country               = $this->getCountry($row['pais']);
        $labor_mobiliy_country = (new LaborMobilityCountry)
            ->where('remote_id', $country->id)
            ->firstOrFail();

        $person = (new LaborMobilityPerson)->firstOrNew([
            'id_type'   => 'Tipo de identificación',
            'id_number' => 'Número de identificación',
        ]);

        $person->first_name        = $row['primer_nombre'];
        $person->middle_name       = $row['segundo_nombre'];
        $person->last_name         = $row['primer_apellido'];
        $person->sur_name          = $row['segundo_apellido'];
        $person->married_name      = $row['apellido_de_casada'];
        $person->usa_visa          = $row['no_de_visa_estadunidense'];
        $person->usa_visa_type     = $row['tipo_de_visa_h_2ah_2b'];
        $person->usa_labor_offer   = $row['oferta_laboral_estadunidense'];
        $person->passport_number   = $row['numero_de_pasaporte'];
        $person->birth             = $row['fecha_de_nacimiento'];
        $person->marital_status    = $row['estado_civil'];
        $person->children          = $row['numero_de_hijos'];
        $person->ethnicity         = $row['etnia'];
        $person->language          = $row['idioma'];
        $person->academic_level    = $row['nivel_academico'];
        $person->profession        = $row['profesion_u_oficio'];
        $person->email             = $row['correo_electronico'];
        $person->phone_number      = $row['telefono'];
        $person->phone_number_alt  = $row['telefono_alternativo'];
        $person->emergency_contact = $row['contacto_de_emergencia'];
        $person->emergency_phone   = $row['contacto_de_emergencia_telefono'];
        $person->emergency_email   = $row['contacto_de_emergencia_correo_electronico'];
        $person->address           = $row['direccion'];
        $person->gender            = in_array($row['sexo'], [
            'Masculino', 'M', 'Hombre', 1,
        ]);

        $person->state()->associate($this->getState($row['departamento'], $this->getCountry('Guatemala')));
        $person->city()->associate($this->getCity($row['municipio'], $person->state));

        $person->save();

        $estate = (new LaborMobilityEstate)->firstOrNew([
            'name' => $row['nombre_de_la_empresa_o_finca'],
        ]);

        $estate->state  = $row['estado'];
        $estate->county = $row['condado'];

        $estate->save();

        $return = new LaborMobilityReturn;

        $return->state           = $row['estado'];
        $return->county          = $row['condado'];
        $return->contract_init   = $row['fecha_de_inicio_de_contrato'];
        $return->contract_end    = $row['fecha_finalizacion_de_contrato'];
        $return->position        = $row['puesto'];
        $return->contract_type   = $row['tipo_de_contrato'];
        $return->contract_number = $row['numero_de_contrato'];
        $return->weekly_hours    = $row['minimo_de_horas_trabajadas_semanalmente'];
        $return->day_wage        = $row['salario_por_dia'];
        $return->is_farming      = in_array($row['tipo_de_trabajo_agricola_o_no_agricola'], [
            'Sí', 'Si', 'si', 'Sí', 1,
        ]);

        $return->person()->associate($person);
        $return->estate()->associate($estate);
        $return->country()->associate($labor_mobiliy_country);

        $return->save();
    }

}
