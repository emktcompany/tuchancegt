<template>
  <div>
    <h2 class="font-dosis font-bold text-purple mb-4">Datos Generales</h2>
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
      <form-field name="place_of_birth" label="Lugar de nacimiento*" class="w-full md:w-1/4 px-4">
        <input type="text" name="place_of_birth" class="form-field text-sm" @input="onInput" v-validate="{required: true}" v-model="row.data.place_of_birth">
      </form-field>
      <form-field class="w-full md:w-1/4 px-4" name="date_of_birth" label="Fecha de Nacimiento*">
        <date-input name="date_of_birth" v-validate="{required: true}" class="form-field" @input="onInput" v-model="row.data.date_of_birth" :valid="!!!errors.first('date_of_birth')" />
      </form-field>
      <form-field name="age" label="Edad*" class="w-full md:w-1/4 px-4">
        <input type="tel" v-validate="{required: true}" name="age" class="form-field text-sm" @input="onInput" v-model="row.data.age">
      </form-field>
    </div>

    <div class="flex flex-col md:flex-row -mx-4">
      <form-field class="w-full md:w-1/4 px-4" name="gender" label="Sexo">
        <choice-input id="gender" @input="onInput" v-model="row.data.gender" name="gender" v-validate="{required: true}" :options="$genders" />
      </form-field>
      <form-field class="w-full md:w-1/4 px-4" name="ethnicity_id" label="Grupo étnico*">
        <ethnicity-select name="ethnicity_id" v-model="row.data.ethnicity_id"></ethnicity-select>
      </form-field>
    </div>
    <div class="flex flex-col md:flex-row -mx-4">
      <form-field class="w-full md:w-1/2 px-4" name="id_number" label="Documento de identificación (DPI o partida de nacimiento)*">
        <input autocomplete="off" type="tel" name="id_number" class="form-field text-sm" v-validate="{required: true}" @input="onInput" v-model="row.data.id_number">
      </form-field>
      <form-field class="w-full md:w-1/2 px-4" name="cui_number" label="Número de CUI*">
        <input autocomplete="off" type="tel" name="cui_number" class="form-field text-sm" v-validate="{required: true}" @input="onInput" v-model="row.data.cui_number">
      </form-field>
    </div>

    <h2 class="font-dosis font-bold text-purple mt-8 mb-4">Ubicación</h2>
    <div class="flex flex-col md:flex-row -mx-4">
      <form-field class="w-full md:w-1/3 px-4" name="address" label="Dirección">
        <input autocomplete="off" type="text" name="address" class="form-field text-sm" v-validate="{required: true}" @input="onInput" v-model="row.data.address">
      </form-field>
      <form-field class="w-full md:w-1/3 px-4" name="state_id" label="Departamento*">
        <state-select v-model="row.data.state_id" @change="onStateSelected" name="state_id" :country-id="3" v-validate="{required: true}" />
      </form-field>
      <form-field class="w-full md:w-1/3 px-4" name="city" label="Municipio*">
        <city-select v-model="row.data.city_id" @change="onCitySelected" name="city" :state-id="row.data.state_id" v-validate="{required: true}" />
      </form-field>
    </div>

    <h2 class="font-dosis font-bold text-purple mt-8 mb-4">Contacto</h2>
    <div class="flex flex-col md:flex-row -mx-4">
      <div class="md:w-1/4 px-4">
        <form-field name="email" label="Correo electrónico*">
          <input type="email" name="email" v-validate="{required: true, email: true}" class="form-field text-sm" @input="onInput" v-model="row.data.email">
        </form-field>
      </div>
      <div class="md:w-1/4 px-4">
        <form-field name="phone" label="Teléfono*">
          <input type="tel" name="phone" v-validate="{required: true}" class="form-field text-sm" @input="onInput" v-model="row.data.phone">
        </form-field>
      </div>
      <div class="md:w-1/4 px-4">
        <form-field name="phone_alt" label="Teléfono alternativo">
          <input type="tel" name="phone_alt" v-validate="{required: false}" class="form-field text-sm" @input="onInput" v-model="row.data.phone_alt">
        </form-field>
      </div>
      <div class="md:w-1/4 px-4">
        <form-field name="language_community" label="Comunidad lingüística*">
          <dialect-select :ethnicity-id="row.data.ethnicity_id" name="dialect_id" v-validate="{required:true}" v-model="dialect_id" @change="onDialectSelected"></dialect-select>
        </form-field>
      </div>
    </div>
  </div>
</template>

<script>
import difference from 'lodash/difference';
import keys from 'lodash/keys';

import SavesRow from '@/mixins/admin/SavesRow';
import FocusesOnError from '@/mixins/FocusesOnError';

var row = {
  full_name: '',
  first_name: '',
  middle_name: '',
  last_name: '',
  sur_name: '',
  id_number: '',
  cui_number: '',
  address: '',
  place_of_birth: '',
  age: '',
  language_community: '',
  email: '',
  phone: '',
  phone_alt: ''
};

export default {
  mixins: [FocusesOnError, SavesRow],
  props: {
    value: {
      type: [Object, null],
      default: null
    }
  },
  data() {
    return {
      dialect_id: null,
      apiUrl: 'admin/training-people/:id?',
      ethnicities: [],
      row: {
        data: Object.assign({}, row)
      }
    };
  },
  watch: {
    value(data) {
      this.import(data);
    }
  },
  async created() {
    this.import(this.value);

    var response = await this.$http.get('admin/ethnicities', {params: {all: 1}});
    this.ethnicities = response.data.data;
  },
  methods: {
    onDialectSelected(dialect) {
      this.row.data.language_community = (dialect || {name: ''}).name;
    },
    import(data) {
      if (!(data && !difference(keys(row), keys(data)).length)) {
        data = Object.assign({}, row);
      }

      this.row = Object.assign({}, {data});
      this.onInput();
    },
    sent({data}) {
      this.import(data.data);
    },
    onInput() {
      this.$emit('input', this.row.data)
    },
    onStateSelected(state) {
      if (state) {
        this.row.data.state = state.name;
      } else {
        delete this.row.data.state;
      }

      this.onInput();
    },
    onCitySelected(city) {
      if (city) {
        this.row.data.city = city.name;
      } else {
        delete this.row.data.city;
      }

      this.onInput();
    }
  }
}
</script>
