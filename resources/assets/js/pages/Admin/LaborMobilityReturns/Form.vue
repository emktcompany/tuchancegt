<template lang="html">
  <div>
    <form @submit.prevent="submit" class="bg-grey-lighter p-4 md:p-12 max-w-xl mx-auto mb-12">
      <h2 class="font-dosis font-bold text-purple mb-4">Datos personales</h2>
      <form-field label="Busca un registro de persona o crea uno nuevo" name="person">
        <search-people v-model="person" />
      </form-field>
      <hr class="my-3 border-t border-grey-light">
      <person-form class="mt-6" ref="person" v-model="person" :country="mobilityCountry" />
      <h2 class="font-dosis font-bold text-purple mb-4 mt-6">Datos de la empresa</h2>
      <form-field label="Busca un registro de empresa o crea una nueva" name="estate">
        <search-estate v-model="estate" :country="mobilityCountry" />
      </form-field>
      <hr class="my-3 border-t border-grey-light">
      <estate-form class="mt-6" ref="estate" v-model="estate" :country="mobilityCountry" />
      <div class="flex flex-col md:flex-row -mx-4">
        <div class="md:w-1/2 px-4">
          <form-field name="contract_init" label="Fecha de inicio de contrato*">
            <date-input name="contract_init" v-validate="{required: true}" class="form-field" v-model="row.data.contract_init" :valid="!!!errors.first('contract_init')" />
          </form-field>
        </div>
        <div class="md:w-1/2 px-4">
          <form-field name="contract_end" label="Fecha finalización de contrato*">
            <date-input name="contract_end" v-validate="{required: true}" class="form-field" v-model="row.data.contract_end" :valid="!!!errors.first('contract_end')" />
          </form-field>
        </div>
      </div>
      <div class="flex flex-col md:flex-row -mx-4">
        <form-field class="md:w-1/3 px-4" name="position" label="Puesto*">
          <input type="text" name="position" v-validate="{required: true}" class="form-field text-sm" v-model="row.data.position">
        </form-field>
        <form-field class="md:w-1/3 px-4" name="contract_type" label="Tipo de Contrato*">
          <input type="text" name="contract_type" v-validate="{required: true}" class="form-field text-sm" v-model="row.data.contract_type">
        </form-field>
        <form-field class="md:w-1/3 px-4" name="contract_number" label="Número de Contrato*">
          <input type="text" name="contract_number" v-validate="{required: true}" class="form-field text-sm" v-model="row.data.contract_number">
        </form-field>
      </div>
      <div class="flex flex-col md:flex-row -mx-4" v-if="!mex">
        <form-field class="md:w-1/2 px-4" name="weekly_hours" label="Mínimo de horas trabajadas semanalmente*">
          <input type="number" name="weekly_hours" v-validate="{required: false}" class="form-field text-sm" v-model="row.data.weekly_hours">
        </form-field>
        <form-field class="md:w-1/4 px-4" name="day_wage" label="Salario por día">
          <input type="number" name="day_wage" v-validate="{required: false}" class="form-field text-sm" v-model="row.data.day_wage">
        </form-field>
        <form-field class="md:w-1/4 px-4" name="is_farming" label="Tipo de trabajo (agrícola o no agrícola)*">
          <radio-group v-model="row.data.is_farming" name="is_farming" v-validate="{required: true}" :options="$yesNo" />
        </form-field>
      </div>
      <div class="text-right mt-6">
        <button type="submit" class="btn bg-teal text-white">Guardar cambios</button>
      </div>
    </form>
  </div>
</template>

<script>
import filter from 'lodash/filter';
import isUndefined from 'lodash/isUndefined';

import IsMobilityForm from '@/mixins/admin/IsMobilityForm';
import IsReturnsPage from '@/mixins/admin/IsMobilityReturnsPage';

import FormPage from '@/components/admin/FormPage.vue';

import SearchPeople from '@/components/admin/mobility/SearchPeople.vue';
import SearchEstate from '@/components/admin/mobility/SearchEstate.vue';
import PersonForm from '@/components/admin/mobility/PersonForm.vue';
import EstateForm from '@/components/admin/mobility/EstateForm.vue';

export default {
  extends: FormPage,
  mixins: [IsMobilityForm, IsReturnsPage],
  components: {
    EstateForm,
    PersonForm,
    SearchEstate,
    SearchPeople
  },
  data() {
    return {
      person: null,
      estate: null
    };
  },
  watch: {
    'row.data.person'(person) {
      if (!isUndefined(person)) {
        this.person = person;
      }
    },
    'row.data.estate'(estate) {
      if (!isUndefined(estate)) {
        this.estate = estate;
      }
    }
  },
  created() {
    if (this.row.data.estate) {
      this.estate = this.row.data.estate;
    }

    if (this.row.data.person) {
      this.person = this.row.data.person;
    }
  },
  methods: {
    saved({data}) {
      this.$router.push({
        name: 'admin.labor-mobility-returns.edit',
        params: {
          id: data.id,
          labor_mobility_country_id: this.mobilityCountry.id
        }
      });
    },
    reset() {
      this.row = {
        data: {
          position: '',
          contract_type: '',
          contract_number: '',
          weekly_hours: '',
          day_wage: '',
        }
      }
    },
    async save() {
      var valid = await Promise.all([
        this.$refs.person.$validator.validate(),
        this.$refs.estate.$validator.validate(),
        this.$validator.validate()
      ]);

      if (filter(valid).length != 3) {
        throw Error('invalid');
      }

      try {
        var person = (await this.$refs.person.save()).data.data;
        var estate = (await this.$refs.estate.save()).data.data;

        this.row.data.labor_mobility_person_id  = person.id;
        this.row.data.labor_mobility_estate_id  = estate.id;
        this.row.data.labor_mobility_country_id = this.mobilityCountry.id;

        this.row.data.state    = estate.state;
        this.row.data.county   = estate.county;
        this.row.data.province = estate.province;
        this.row.data.city     = estate.city;

        return await this.send();
      } catch (e) {
        throw e;
      }
    }
  }
}
</script>
