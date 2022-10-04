<template>
  <div>
    <form-field name="labor_mobility_country_id" label="País" v-if="!country">
      <v-select class="form-field" @input="onCountrySelected" label="name" v-model="mobilityCountry" v-validate="{required: true}" name="labor_mobility_country_id" :options="$mobilityCountries" />
    </form-field>
    <form-field name="name" label="Nombre de la empresa o finca *">
      <input type="text" name="name" v-validate="{required: true}" class="form-field" v-model="row.data.name">
    </form-field>
    <form-field name="state" :label="stateLabel">
      <state-select v-model="row.data.state_id" @change="onStateSelected" name="state_id" :country-id="mobilityCountry ? mobilityCountry.remote_id : null" :placeholder="stateLabel" v-validate="{required: true}" />
    </form-field>
    <form-field name="city" v-if="canada" :label="cityLabel">
      <city-select v-model="row.data.city_id" @change="onCitySelected" name="city" :state-id="row.data.state_id" :placeholder="cityLabel" v-validate="{required: true}" />
    </form-field>
    <form-field name="province" v-if="mex" label="Provincia *">
      <city-select v-model="row.data.city_id" @change="onProvinceSelected" name="province" :state-id="row.data.state_id" :placeholder="cityLabel" v-validate="{required: true}" />
    </form-field>
    <form-field name="county" v-if="usa" label="Condado *">
      <city-select v-model="row.data.city_id" @change="onCountySelected" name="county" :state-id="row.data.state_id" :placeholder="cityLabel" v-validate="{required: true}" />
    </form-field>
  </div>
</template>

<script>
import difference from 'lodash/difference';
import keys from 'lodash/keys';
import find from 'lodash/find';

import IsMobilityForm from '@/mixins/admin/IsMobilityForm';
import SavesRow from '@/mixins/admin/SavesRow';
import FocusesOnError from '@/mixins/FocusesOnError';

var row = {
  name: ''
};

export default {
  mixins: [FocusesOnError, IsMobilityForm, SavesRow],
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
      apiUrl: 'admin/labor-mobility-estates/:id?',
      row: {
        data: {
          name: ''
        }
      }
    };
  },
  watch: {
    country(country) {
      this.row.data.labor_mobility_country_id = country.id;
      // this.mobilityCountry = country;
    },
    value(data) {
      this.import(data);
    },
    $mobilityCountries(value, old) {
      this.mobilityCountry = find(value, {
        id: this.row.data.labor_mobility_country_id
      });
    },
    'row.data.labor_mobility_country_id'(value, old) {
      this.mobilityCountry = find(this.$mobilityCountries, {
        id: value
      });
    }
  },
  created() {
    this.import(this.value);
  },
  methods: {
    import(data) {
      if (!(data && !difference(keys(row), keys(data)).length)) {
        data = Object.assign({}, row);
      }

      this.row = Object.assign({}, {data});

      if (this.country) {
        this.row.data.labor_mobility_country_id = this.country.id;
      }

      this.onInput();
    },
    sent({data}) {
      // console.log(JSON.stringify(data.data));
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
    },
    onCountySelected(county) {
      if (county) {
        this.row.data.county = county.name;
      } else {
        delete this.row.data.county;
      }

      this.onInput();
    },
    onCountrySelected(country) {
      if (country) {
        this.row.data.labor_mobility_country_id = country.id;
      } else {
        delete this.row.data.county;
      }

      this.onInput();
    },
    onProvinceSelected(county) {
      if (county) {
        this.row.data.county = county.name;
      } else {
        delete this.row.data.county;
      }

      this.onInput();
    }
  }
}
</script>
