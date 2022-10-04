<template>
  <div>
    <div class="flex flex-col md:flex-row -mx-4">
      <div class="md:w-1/4 px-4">
        <form-field name="first_name" label="Primer Nombre*">
          <input type="text" name="first_name" v-validate="{required: true}" class="form-field text-sm" @input="onInput" v-model="row.data.first_name">
        </form-field>
      </div>
      <div class="md:w-1/4 px-4">
        <form-field name="middle_name" label="Segundo Nombre">
          <input type="text" name="middle_name" class="form-field text-sm" @input="onInput" v-model="row.data.middle_name">
        </form-field>
      </div>
      <div class="md:w-1/4 px-4">
        <form-field name="last_name" label="Primer Apellido*">
          <input type="text" name="last_name" v-validate="{required: true}" class="form-field text-sm" @input="onInput" v-model="row.data.last_name">
        </form-field>
      </div>
      <div class="md:w-1/4 px-4">
        <form-field name="sur_name" label="Segundo Apellido">
          <input type="text" name="sur_name" class="form-field text-sm" @input="onInput" v-model="row.data.sur_name">
        </form-field>
      </div>
    </div>
    <div class="flex flex-col md:flex-row -mx-4">
      <form-field name="married_name" label="Apellido de casada" class="w-full md:w-1/4 px-4">
        <input type="text" name="married_name" class="form-field text-sm" @input="onInput" v-model="row.data.married_name">
      </form-field>
      <form-field class="w-full md:w-1/4 px-4" name="gender" label="Sexo">
        <choice-input id="gender" @input="onInput" v-model="row.data.gender" name="gender" v-validate="{required: true}" :options="$genders" />
      </form-field>
      <form-field class="w-full md:w-1/4 px-4" name="id_type" label="Tipo de identificación">
        <choice-input @input="onInput" v-model="row.data.id_type" :options="idTypes" name="id_type" id="id_type" label="name" />
      </form-field>
      <form-field class="w-full md:w-1/4 px-4" name="id_number" label="Número de identificación">
        <input autocomplete="off" type="tel" name="id_number" class="form-field text-sm" v-validate="{required: !!row.data.id_type}" @input="onInput" v-model="row.data.id_number">
      </form-field>
    </div>
    <div class="flex flex-col md:flex-row -mx-4" v-if="usa">
      <div class="md:w-1/3 px-4">
        <form-field name="usa_visa" label="No. De visa Estadunidense*">
          <input type="text" name="usa_visa" v-validate="{required: true}" class="form-field text-sm" @input="onInput" v-model="row.data.usa_visa">
        </form-field>
      </div>
      <div class="md:w-1/3 px-4">
        <form-field name="usa_visa_type" label="Tipo de visa (H-2ª/H-2B)">
          <input type="text" name="usa_visa_type" v-validate="{required: true}" class="form-field text-sm" @input="onInput" v-model="row.data.usa_visa_type">
        </form-field>
      </div>
      <div class="md:w-1/3 px-4">
        <form-field name="usa_labor_offer" label="Oferta Laboral Estadunidense*">
          <input type="text" name="usa_labor_offer" v-validate="{required: true}" class="form-field text-sm" @input="onInput" v-model="row.data.usa_labor_offer">
        </form-field>
      </div>
    </div>
    <form-field name="mex_id_number" label="Numero de tarjeta de visitante de trabajador fronterizo (opcional)" v-if="mex">
      <input type="text" name="mex_id_number" class="form-field text-sm" @input="onInput" v-model="row.data.mex_id_number">
    </form-field>
    <div class="flex flex-col md:flex-row -mx-4" v-if="canada">
      <div class="md:w-1/3 px-4">
        <form-field name="can_visa" label="No. De visa Canadiense*">
          <input type="text" name="can_visa" v-validate="{required: true}" class="form-field text-sm" @input="onInput" v-model="row.data.can_visa">
        </form-field>
      </div>
      <div class="md:w-1/3 px-4">
        <form-field name="can_lmia" label="LMIA (Labour Market Impact Assessment)*">
          <input type="text" name="can_lmia" v-validate="{required: true}" class="form-field text-sm" @input="onInput" v-model="row.data.can_lmia">
        </form-field>
      </div>
      <div class="md:w-1/3 px-4">
        <form-field name="can_offer" label="Oferta Laboral canadiense">
          <input type="text" name="can_offer" v-validate="{required: false}" class="form-field text-sm" @input="onInput" v-model="row.data.can_offer">
        </form-field>
      </div>
    </div>
    <form-field name="passport_number" label="Número de pasaporte*" v-if="canada || usa">
      <input autocomplete="off" type="text" name="passport_number" v-validate="{required: true}" class="form-field text-sm" @input="onInput" v-model="row.data.passport_number">
    </form-field>
    <div class="flex flex-col md:flex-row -mx-4">
      <div class="md:w-1/3 px-4">
        <form-field name="birth" label="Fecha de Nacimiento">
          <date-input name="birth" v-validate="{required: true}" class="form-field" @input="onInput" v-model="row.data.birth" :valid="!!!errors.first('birth')" />
        </form-field>
      </div>
      <div class="md:w-1/3 px-4">
        <form-field name="marital_status" label="Estado civil*">
          <input type="text" name="marital_status" v-validate="{required: true}" class="form-field text-sm" @input="onInput" v-model="row.data.marital_status">
        </form-field>
      </div>
      <div class="md:w-1/3 px-4">
        <form-field name="children" label="Número de hijos*">
          <input type="number" name="children" v-validate="{required: true}" class="form-field text-sm" @input="onInput" v-model="row.data.children">
        </form-field>
      </div>
    </div>
    <div class="flex flex-col md:flex-row -mx-4">
      <div class="md:w-1/3 px-4">
        <form-field name="state_id" label="Departamento*">
          <state-select v-validate="{required: true}" @input="onInput" v-model="row.data.state_id" name="state_id" :country-id="3" />
        </form-field>
      </div>
      <div class="md:w-1/3 px-4">
        <form-field name="city_id" label="Municipio*">
          <city-select v-validate="{required: true}" @input="onInput" v-model="row.data.city_id" name="city_id" :state-id="row.data.state_id" />
        </form-field>
      </div>
    </div>
    <div class="flex flex-col md:flex-row -mx-4">
      <div class="md:w-1/3 px-4">
        <form-field name="address" label="Dirección*">
          <input type="text" name="address" v-validate="{required: true}" class="form-field text-sm" @input="onInput" v-model="row.data.address">
        </form-field>
      </div>
      <div class="md:w-1/3 px-4">
        <form-field name="ethnicity" label="Etnia*">
          <ethnicity-select name="ethnicity_id" v-validate="{required:true}" v-model="ethnicity_id" @change="onEthnicitySelected"></ethnicity-select>
        </form-field>
      </div>
      <div class="md:w-1/3 px-4">
        <form-field name="language" label="Idioma*">
          <dialect-select :ethnicity-id="ethnicity_id" name="dialect_id" v-validate="{required:true}" v-model="dialect_id" @change="onDialectSelected"></dialect-select>
        </form-field>
      </div>
    </div>
    <div class="flex flex-col md:flex-row -mx-4">
      <div class="md:w-1/3 px-4">
        <form-field name="academic_level" label="Nivel académico*">
          <input type="text" name="academic_level" v-validate="{required: true}" class="form-field text-sm" @input="onInput" v-model="row.data.academic_level">
        </form-field>
      </div>
      <div class="md:w-1/3 px-4">
        <form-field name="profession" label="Profesión u Oficio*">
          <input type="text" name="profession" v-validate="{required: true}" class="form-field text-sm" @input="onInput" v-model="row.data.profession">
        </form-field>
      </div>
    </div>
    <div class="flex flex-col md:flex-row -mx-4">
      <div class="md:w-1/3 px-4">
        <form-field name="email" label="Correo electrónico*">
          <input type="email" name="email" v-validate="{required: true, email: true}" class="form-field text-sm" @input="onInput" v-model="row.data.email">
        </form-field>
      </div>
      <div class="md:w-1/3 px-4">
        <form-field name="phone_number" label="Teléfono*">
          <input type="tel" name="phone_number" v-validate="{required: true}" class="form-field text-sm" @input="onInput" v-model="row.data.phone_number">
        </form-field>
      </div>
      <div class="md:w-1/3 px-4">
        <form-field name="phone_number_alt" label="Teléfono alternativo">
          <input type="tel" name="phone_number_alt" v-validate="{required: false}" class="form-field text-sm" @input="onInput" v-model="row.data.phone_number_alt">
        </form-field>
      </div>
    </div>
  </div>
</template>

<script>
import difference from 'lodash/difference';
import keys from 'lodash/keys';

import IsMobilityForm from '@/mixins/admin/IsMobilityForm';
import SavesRow from '@/mixins/admin/SavesRow';
import FocusesOnError from '@/mixins/FocusesOnError';

var row = {
  full_name: '',
  first_name: '',
  middle_name: '',
  last_name: '',
  sur_name: '',
  married_name: '',
  id_number: '',
  usa_visa: '',
  usa_visa_type: '',
  usa_labor_offer: '',
  mex_id_number: '',
  can_visa: '',
  can_lmia: '',
  can_offer: '',
  passport_number: '',
  marital_status: '',
  children: '',
  address: '',
  ethnicity: '',
  language: '',
  academic_level: '',
  profession: '',
  email: '',
  phone_number: '',
  phone_number_alt: ''
};

export default {
  mixins: [IsMobilityForm, FocusesOnError, SavesRow],
  props: {
    country: {
      type: [Object, null],
      default: null
    },
    value: {
      type: [Object, null],
      default: null
    }
  },
  data() {
    return {
      dialect_id: null,
      ethnicity_id: null,
      apiUrl: 'admin/labor-mobility-people/:id?',
      idTypes: ['Cédula', 'Pasaporte', 'Otro'],
      row: {
        data: Object.assign({}, row)
      }
    };
  },
  watch: {
    country(country) {
      this.mobilityCountry = country;
    },
    value(data) {
      this.import(data);
    }
  },
  async created() {
    this.import(this.value);
    this.mobilityCountry = this.country;

  },
  methods: {
    onEthnicitySelected(ethnicity) {
      this.row.data.ethnicity = (ethnicity || {name: ''}).name;
    },
    onDialectSelected(dialect) {
      this.row.data.language = (dialect || {name: ''}).name;
    },
    import(data) {
      if (!(data && !difference(keys(row), keys(data)).length)) {
        data = Object.assign({}, row);
      }

      this.row = Object.assign({}, {data});
      this.onInput();
    },
    sent({data}) {
      // console.log(JSON.stringify(data.data));
      this.import(data.data);
    },
    onInput() {
      this.$emit('input', this.row.data)
    }
  }
}
</script>
