<?php

namespace App\Imports;

use App\TuChance\Models\Ethnicity;
use App\TuChance\Models\TrainingPerson;
use App\TuChance\Models\TrainingRecord;
use App\TuChance\Models\TrainingWorkshop;

class ImportTrainingRecords extends BaseImport
{
    /**
     * @param  array  $row
     * @param  int    $index
     * @return void
     */
    protected function onRow($row, $index)
    {
        $workshop = (new TrainingWorkshop)->firstOrCreate([
            'name' => $row['taller_al_que_aplica'],
        ]);

        $person = (new TrainingPerson)->firstOrNew([
            'id_number' => $row['documento_de_identificacion_dpi_o_partida_de_nacimiento'],
        ]);

        $person->first_name         = $row["primer_nombre"];
        $person->middle_name        = $row["segundo_nombre"];
        $person->last_name          = $row["primer_apellido"];
        $person->sur_name           = $row["segundo_apellido"];
        $person->place_of_birth     = $row["lugar_de_nacimiento"];
        $person->date_of_birth      = $row["fecha_de_nacimiento"];
        $person->age                = $row["edad"];
        $person->gender             = $row["genero"];
        $person->cui_number         = $row["numero_de_cui"];
        $person->address            = $row["direccion_de_domicilio"];
        $person->phone              = $row["numero_de_telefono1"];
        $person->phone_alt          = $row["numero_de_telefono_2"];
        $person->email              = $row["correo_electronico"];
        $person->language_community = $row["comunidad_linguistica"];

        $person->state()->associate($this->getState(
            $row['departamento'],
            $this->getCountry('Guatemala')
        ));
        $person->city()->associate($this->getCity(
            $row['municipio'],
            $person->state
        ));

        $ethnicity = (new Ethnicity)
            ->where('name', $row['grupo_etnico'])
            ->firstOrFail();

        $person->ethnicity()->associate($ethnicity);

        $person->save();

        $record = new TrainingRecord;

        $record->contact_name       = $row["nombre_de_la_persona_de_contacto"];
        $record->contact_phone      = $row["numero_de_telefono"];
        $record->parent_first_name  = $row["primer_nombre_responsable"];
        $record->parent_middle_name = $row["segundo_nombre_responsable"];
        $record->parent_last_name   = $row["primer_apellido_responsable"];
        $record->parent_sur_name    = $row["segundo_apellido_responsable"];
        $record->parent_kinship     = $row["parentescopapa_mama_abuelos_tioa_otro_responsable"];
        $record->parent_age         = $row["edad_responsable"];
        $record->parent_id_number   = $row["documento_de_identificacion_dpi_o_partida_de_nacimiento_responsable"];
        $record->parent_cui_number  = $row["numero_de_cui_responsable"];
        $record->parent_workplace   = $row["lugar_de_trabajo_responsable"];
        $record->parent_phone       = $row["telefono_de_trabajo_o_personal_responsable"];
        $record->parent_email       = $row["correo_electronico_responsable"];
        $record->can_read           = $row["sabe_leer_y_escribirsi_o_no"];
        $record->study_sessions     = $row["jornada_que_estudia_matutina_vespertina_fin_de_semana"];
        $record->study_schedule     = $row["horario_que_estudia"];

        $record->person()->associate($person);
        $record->workshop()->associate($workshop);

        $record->save();
    }
}
