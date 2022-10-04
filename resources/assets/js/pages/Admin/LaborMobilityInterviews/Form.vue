<template lang="html">
  <form @submit.prevent="submit" class="bg-grey-lighter p-4 md:p-12 max-w-xl mx-auto mb-12">
    <h2 class="font-dosis font-bold text-purple mb-4">Datos personales</h2>
    <form-field label="Busca el registro de persona que entrevistarás" name="person">
      <search-people name="person" @input="selectedPerson" v-model="person" v-validate="{required: true}" />
    </form-field>
    <hr class="my-3 border-t border-grey-light">
    <div class="flex -mx-4 flex-wrap flex-col md:flex-row">
      <form-field class="w-full md:w-1/3 px-4" name="gender" label="Género*">
        <choice-input v-model="row.data.gender" name="gender" v-validate="{required: true}" :options="$genders" />
      </form-field>
      <form-field class="w-full md:w-1/3 px-4" name="ethnicity" label="Etnia*">
        <input type="text" name="ethnicity" v-validate="{required: true}" class="form-field" v-model="row.data.ethnicity">
      </form-field>
      <form-field class="w-full md:w-1/3 px-4" name="age" label="Edad*">
        <input type="number" name="age" v-validate="{required: true}" class="form-field" v-model="row.data.age">
      </form-field>
    </div>
    <div class="flex -mx-4 flex-wrap flex-col md:flex-row">
      <form-field class="w-full md:w-1/3 px-4" name="state_id" label="Departamento origen*">
        <state-select name="state_id" v-model="row.data.state_id" :country-id="3" />
      </form-field>
      <form-field class="w-full md:w-1/3 px-4" name="city_id" label="Municipio origen*">
        <city-select name="city_id" v-model="row.data.city_id" :state-id="row.data.state_id" />
      </form-field>
      <form-field class="w-full md:w-1/3 px-4" name="residence" label="Lugar de residencia*">
        <input type="text" name="residence" v-validate="{required: true}" class="form-field" v-model="row.data.residence">
      </form-field>
    </div>
    <h2 class="font-dosis font-bold text-purple mb-4 mt-6">Escolaridad</h2>
    <div class="flex -mx-4 flex-wrap flex-col md:flex-row">
      <form-field class="w-full md:w-1/2 px-4" name="academic_level" label="Ultimo grado aprobado*">
        <input type="text" name="academic_level" v-validate="{required: true}" class="form-field" v-model="row.data.academic_level">
      </form-field>
      <form-field class="w-full md:w-1/2 px-4" name="title" label="Título*">
        <input type="text" name="title" v-validate="{required: true}" class="form-field" v-model="row.data.title">
      </form-field>
    </div>
    <h2 class="font-dosis font-bold text-purple mb-4 mt-6">Datos migratorios</h2>
    <div class="flex -mx-4 flex-wrap flex-col md:flex-row">
      <form-field class="w-full md:w-1/2 px-4" name="activity" label="Actividad o trabajo que realizaba en Guatemala">
        <v-select name="activity" :options="activities" v-validate="{required: true}" class="form-field" v-model="row.data.activity" />
      </form-field>
      <form-field class="w-full md:w-1/2 px-4" name="migration_motive" label="Causas de emigración*">
        <v-select multiple :options="motives" name="migration_motive" v-validate="{required: true}" class="form-field" v-model="row.data.migration_motive" />
      </form-field>
    </div>
    <div class="flex -mx-4 flex-wrap flex-col md:flex-row">
      <div class="w-1/2 px-4 py-2">
        <p class="text-grey-darker mb-2 text-sm">Tiempo que permaneció en el extranjero*</p>
        <div class="flex -mx-4 flex-wrap flex-col md:flex-row">
          <form-field class="w-full py-0 md:w-1/2 px-4 flex items-center" label-class="flex-none mb-0 pr-1 hidden md:block" field-container-class="flex-1" name="stay_years" label="Años">
            <input placeholder="Años" type="number" name="stay_years" v-validate="{required: true}" class="form-field" v-model="row.data.stay_years">
          </form-field>
          <form-field class="w-full py-0 md:w-1/2 px-4 flex items-center" label-class="flex-none mb-0 pr-1 hidden md:block" field-container-class="flex-1" name="stay_months" label="Meses">
            <input placeholder="Meses" type="number" name="stay_months" v-validate="{required: true}" class="form-field" v-model="row.data.stay_months">
          </form-field>
        </div>
      </div>
      <div class="w-full px-4">
        <form-field name="stay_activity" label="En qué actividades trabajo o se ocupó durante su estadía en el extranjero*">
          <v-select multiple name="stay_activity" :options="activities" v-validate="{required: true}" class="form-field" v-model="row.data.stay_activity" />
        </form-field>
      </div>
    </div>
    <div class="flex -mx-4 flex-wrap flex-col md:flex-row">
      <form-field class="px-4 w-full md:w-1/3" name="did_study" label="Realizó algún tipo de estudios:*">
        <radio-group :options="$yesNo" v-validate="{required: true}" name="did_study" v-model="row.data.did_study" />
      </form-field>
      <form-field class="px-4 w-full md:w-2/3" name="did_training" label="Recibió algún tipo de capacitación para el trabajo*:">
        <radio-group :options="$yesNo" v-validate="{required: true}" name="did_training" v-model="row.data.did_training" />
      </form-field>
    </div>
    <form-field name="english_level" label="Nivel del idioma ingles:*">
      <v-select name="english_level" :options="englishLevels" v-validate="{required: true}" class="form-field" v-model="row.data.english_level" />
    </form-field>
    <form-field name="deportation_count" label="Cuántas veces ha sido deportado incluyendo esta:*">
      <input type="number" name="deportation_count" v-validate="{required: true}" class="form-field" v-model="row.data.deportation_count">
    </form-field>
    <form-field name="what_was_left_behind" label="En estados Unidos dejó*">
      <v-select multiple name="what_was_left_behind" :options="relations" v-validate="{required: true}" class="form-field" v-model="row.data.what_was_left_behind" />
    </form-field>
    <h2 class="font-dosis font-bold text-purple mb-4 mt-6">Planes de ahora en adelante:</h2>
    <form-field name="will_try_again" label="Intentará regresar a Estados Unidos*:">
      <radio-group :options="$yesNo" v-validate="{required: true}" name="will_try_again" v-model="row.data.will_try_again" />
    </form-field>
    <form-field name="backhome_ocupation" label="En cuál actividad se ocupará a su retorno a Guatemala*">
      <v-select name="backhome_ocupation" :options="activities" v-validate="{required: true}" class="form-field" v-model="row.data.backhome_ocupation" />
    </form-field>
    <form-field name="will_look_for_job" label="Buscará empleo*:">
      <radio-group :options="$yesNo" v-validate="{required: true}" name="will_look_for_job" v-model="row.data.will_look_for_job" />
    </form-field>
    <form-field name="experienced_in" label="En qué actividades tiene experiencia de trabajo:">
      <v-select multiple name="experienced_in" :options="activities" v-validate="{required: true}" class="form-field" v-model="row.data.experienced_in" />
    </form-field>
    <form-field name="experience_years" label="Cuantos años de experiencia*:">
      <input type="number" name="experience_years" v-validate="{required: true}" class="form-field" v-model="row.data.experience_years">
    </form-field>
    <form-field name="other_skills" label="Otros conocimientos o habilidades que posea:">
      <input type="text" name="other_skills" class="form-field" v-model="row.data.other_skills">
    </form-field>
    <form-field name="wants_job_information" label="Desea información de trabajo, empleo*:">
      <radio-group :options="$yesNo" v-validate="{required: true}" name="wants_job_information" v-model="row.data.wants_job_information" />
    </form-field>
    <h2 class="font-dosis font-bold text-purple mb-4 mt-6">Datos de la persona</h2>
    <div class="flex -mx-4 flex-wrap flex-col md:flex-row">
      <div class="w-full md:w-1/4 px-4 form-group">
        <p class="form-label">Primer Nombre</p>
        <div class="form-field">{{ (person ? person.first_name : null) || 'n/a' }}</div>
      </div>
      <div class="w-full md:w-1/4 px-4 form-group">
        <p class="form-label">Segundo Nombre</p>
        <div class="form-field">{{ (person ? person.middle_name : null) || 'n/a' }}</div>
      </div>
      <div class="w-full md:w-1/4 px-4 form-group">
        <p class="form-label">Primer Apellido</p>
        <div class="form-field">{{ (person ? person.last_name : null) || 'n/a' }}</div>
      </div>
      <div class="w-full md:w-1/4 px-4 form-group">
        <p class="form-label">Segundo Apellido</p>
        <div class="form-field">{{ (person ? person.sur_name : null) || 'n/a' }}</div>
      </div>
      <div class="w-full md:w-1/4 px-4 form-group">
        <p class="form-label">Apellido de Casada</p>
        <div class="form-field">{{ (person ? person.married_name : null) || 'n/a' }}</div>
      </div>
    </div>
    <h2 class="font-dosis font-bold text-purple mb-4 mt-6">Donde puede ser localizado</h2>
    <div class="flex -mx-4 flex-wrap flex-col md:flex-row">
      <form-field class="w-full md:w-1/3 px-4" name="address" label="Dirección">
        <input type="text" name="address" v-validate="{required: !(row.data.email || row.data.phone)}" class="form-field" v-model="row.data.address">
      </form-field>
      <form-field class="w-full md:w-1/3 px-4" name="phone" label="Teléfono">
        <input type="tel" name="phone" v-validate="{required: !(row.data.address || row.data.email), numeric: true}" class="form-field" v-model="row.data.phone">
      </form-field>
      <form-field class="w-full md:w-1/3 px-4" name="email" label="Correo Electrónico">
        <input type="text" name="email" v-validate="{required: !(row.data.address || row.data.phone), email: true}" class="form-field" v-model="row.data.email">
      </form-field>
    </div>
    <form-field name="gt_business_action" label="En caso de que hubiese tenido algún negocio en Guatemala*">
      <v-select name="gt_business_action" :options="actions" v-validate="{required: true}" class="form-field" v-model="row.data.gt_business_action" />
    </form-field>
    <div class="text-right mt-6">
      <button type="submit" class="btn bg-teal text-white">Guardar cambios</button>
    </div>
  </form>
</template>

<script>
import isUndefined from 'lodash/isUndefined';
import IsMobilityForm from '@/mixins/admin/IsMobilityForm';
import FormPage from '@/components/admin/FormPage.vue';
import SearchPeople from '@/components/admin/mobility/SearchPeople.vue';

export default {
  components: {
    SearchPeople
  },
  extends: FormPage,
  mixins: [IsMobilityForm],
  data() {
    return {
      person: null,
      activities: [
        'Agricultura', 'Comercio', 'Servicios', 'Enseñanza', 'Trasporte', 'Administración pública', 'Industria', 'Construcción', 'Profesional', 'Electricidad', 'Agua', 'Gas', 'Otra', 'Ninguna'
      ],
      motives: [
        'Falta de oportunidades laborales', 'Pobreza', 'Cultura', 'Tener mayores ingresos', 'Familiares', 'Otras'
      ],
      englishLevels: [
        'Básico', 'Intermedio', 'Avanzado'
      ],
      relations: [
        'Familia', 'Amigos', 'Negocio'
      ],
      actions: [
        'Lo retomaría', 'Piensa establecer negocio propio',
        'Tiene pensado inicial algún negocio (que tipo de negocio)',
        'Otra idea de lo que hará o podrá hacer',
        'Necesitará algún tipo de apoyo', 'Asesoría empresarial',
        'Asistencia técnica', 'Capacitación', 'Financiamiento',
        'Trámites administrativos'
      ]
    };
  },
  watch: {
    'row.data.person'(person) {
      if (!isUndefined(person)) {
        this.person = person;
      }
    }
  },
  created() {
    if (this.row.data.person) {
      this.person = this.row.data.person;
    }
  },
  methods: {
    saved({data}) {
      this.$router.push({
        name: 'admin.labor-mobility-interviews.edit',
        params: {id: data.id}
      });
    },
    reset() {
      this.row = {
       data:{
          labor_mobility_person_id: null,
          gender: 0,
          ethnicity: '',
          state_id: null,
          city_id: null,
          residence: '',
          address: '',
          phone: '',
          email: '',
          age: null,
          academic_level: '',
          title: '',
          activity: '',
          migration_motive: [],
          stay_years: null,
          stay_months: null,
          stay_activity: [],
          did_study: null,
          did_training: null,
          english_level:  '',
          what_was_left_behind: [],
          will_try_again: null,
          backhome_ocupation: '',
          will_look_for_job: null,
          experienced_in: [],
          deportation_count: null,
          experience_years: null,
          wants_job_information: null,
          gt_business_action: ''
       }
    };
    },
    selectedPerson(person) {
      if (person) {
        this.row.data.labor_mobility_person_id = person.id;
      }
    }
  }
}
</script>
