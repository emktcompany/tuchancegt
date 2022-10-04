<template lang="html">
  <div>
    <form @submit.prevent="submit" class="bg-grey-lighter p-4 md:p-12 max-w-xl mx-auto mb-12">
      <h2 class="font-dosis font-bold text-purple mb-4">Registro de la persona</h2>
      <form-field label="Busca un registro de persona o crea uno nuevo" name="person">
        <search-people v-model="person" />
      </form-field>
      <hr class="my-3 border-t border-grey-light">
      <person-form class="mt-6" ref="person" v-model="person" />
      <hr class="my-3 border-t border-grey-light">
      <h2 class="font-dosis font-bold text-purple mt-8 mb-4">Contacto de emergencia</h2>
      <div class="flex flex-col md:flex-row -mx-4">
        <div class="md:w-1/2 px-4">
          <form-field name="contact_name" label="Nombre de la persona de contacto*">
            <input type="text" name="contact_name" v-validate="{required: true}" class="form-field text-sm" v-model="row.data.contact_name">
          </form-field>
        </div>
        <div class="md:w-1/2 px-4">
          <form-field name="contact_phone" label="Número de teléfono*">
            <input type="tel" name="contact_phone" class="form-field text-sm" v-model="row.data.contact_phone">
          </form-field>
        </div>
      </div>
      <template v-if="person && person.age && Number(person.age) < 18">
        <h2 class="font-dosis font-bold text-purple mt-8 mb-4">Datos de la persona responsable</h2>
        <div class="flex flex-col md:flex-row -mx-4">
          <div class="md:w-1/4 px-4">
            <form-field name="parent_first_name" label="Primer Nombre*">
              <input type="text" name="parent_first_name" v-validate="{required: true}" class="form-field text-sm" v-model="row.data.parent_first_name">
            </form-field>
          </div>
          <div class="md:w-1/4 px-4">
            <form-field name="parent_middle_name" label="Segundo Nombre">
              <input type="text" name="parent_middle_name" class="form-field text-sm" v-model="row.data.parent_middle_name">
            </form-field>
          </div>
          <div class="md:w-1/4 px-4">
            <form-field name="parent_last_name" label="Primer Apellido*">
              <input type="text" name="parent_last_name" v-validate="{required: true}" class="form-field text-sm" v-model="row.data.parent_last_name">
            </form-field>
          </div>
          <div class="md:w-1/4 px-4">
            <form-field name="parent_sur_name" label="Segundo Apellido">
              <input type="text" name="parent_sur_name" class="form-field text-sm" v-model="row.data.parent_sur_name">
            </form-field>
          </div>
        </div>
        <div class="flex flex-col md:flex-row -mx-4">
          <div class="md:w-1/4 px-4">
            <form-field name="parent_kinship" label="Parentesco*">
              <choice-input v-model="row.data.parent_kinship" :options="kinships" name="parent_kinship" id="parent_kinship" label="name" />
            </form-field>
          </div>
          <div class="md:w-1/4 px-4">
            <form-field name="parent_age" label="Edad">
              <input type="tel" name="parent_age" class="form-field text-sm" v-model="row.data.parent_age">
            </form-field>
          </div>
        </div>
        <div class="flex flex-col md:flex-row -mx-4">
          <div class="md:w-1/2 px-4">
            <form-field name="parent_id_number" label="Documento de identificación (DPI o partida de nacimiento)*">
              <input type="text" name="parent_id_number" v-validate="{required: true}" class="form-field text-sm" v-model="row.data.parent_id_number">
            </form-field>
          </div>
          <div class="md:w-1/2 px-4">
            <form-field name="parent_cui_number" label="Número de CUI*">
              <input type="text" name="parent_cui_number" class="form-field text-sm" v-model="row.data.parent_cui_number">
            </form-field>
          </div>
        </div>
        <div class="flex flex-col md:flex-row -mx-4">
          <div class="md:w-1/3 px-4">
            <form-field name="parent_workplace" label="Lugar de trabajo*">
              <input type="text" name="parent_workplace" v-validate="{required: true}" class="form-field text-sm" v-model="row.data.parent_workplace">
            </form-field>
          </div>
          <div class="md:w-1/3 px-4">
            <form-field name="parent_phone" label="Teléfono de trabajo o personal*">
              <input type="tel" name="parent_phone" class="form-field text-sm" v-validate="{required: true}" v-model="row.data.parent_phone">
            </form-field>
          </div>
          <div class="md:w-1/3 px-4">
            <form-field name="parent_email" label="Correo electrónico.*">
              <input type="email" name="parent_email" v-validate="{required: true}" class="form-field text-sm" v-model="row.data.parent_email">
            </form-field>
          </div>
        </div>
      </template>

      <form-field name="can_read" label="Sabe leer y escribir*">
        <choice-input v-validate="{required: true}" v-model="row.data.can_read" :options="$yesNo" name="can_read" id="can_read" />
      </form-field>

      <div class="flex flex-col md:flex-row -mx-4" v-if="row.data.can_read">
        <div class="md:w-1/3 px-4">
          <form-field name="study_sessions" label="Jornada que estudia*">
            <choice-input v-validate="{required: true}" v-model="row.data.study_sessions" :options="shifts" name="study_sessions" id="study_sessions" label="name" />
          </form-field>
        </div>
        <div class="md:w-1/3 px-4">
          <form-field name="study_schedule" label="Horario que estudia*">
            <input type="text" name="study_schedule" v-validate="{required: true}" class="form-field text-sm" v-model="row.data.study_schedule">
          </form-field>
        </div>
      </div>

      <form-field name="workshop_id" label="Taller al que aplica*">
        <choice-input id="workshop_id" v-model="row.data.workshop_id" name="workshop_id" v-validate="{required: true}" :options="workshops" label-key="name" value-key="id" />
      </form-field>

      <div class="text-right mt-6">
        <button type="submit" class="btn bg-teal text-white">Guardar cambios</button>
      </div>
    </form>
  </div>
</template>

<script>
import filter from 'lodash/filter';
import isUndefined from 'lodash/isUndefined';

import FormPage from '@/components/admin/FormPage.vue';

import SearchPeople from '@/components/admin/training/SearchPeople.vue';
import PersonForm from '@/components/admin/training/PersonForm.vue';

export default {
  extends: FormPage,
  components: {
    PersonForm,
    SearchPeople
  },
  data() {
    return {
      person: null,
      workshops: [],
      kinships: [
        'Papá', 'Mamá', 'Abuelo(a)', 'Tío(a)', 'Otro'
      ],
      shifts: [
        'Matutina', 'Vespertina', 'Fin de semana'
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
  async created() {
    if (this.row.data.person) {
      this.person = this.row.data.person;
    }

    var response = await this.$http.get('admin/training-workshops', {params: {all: 1}});
    this.workshops = response.data.data;
  },
  methods: {
    saved({data}) {
      this.$router.push({
        name: 'admin.training-records.edit',
        params: {
          id: data.id
        }
      });
    },
    reset() {
      this.row = {
        data: {
          contact_name: '',
          contact_phone: '',
          parent_first_name: '',
          parent_middle_name: '',
          parent_last_name: '',
          parent_sur_name: '',
          parent_kinship: '',
          parent_age: '',
          parent_id_number: '',
          parent_cui_number: '',
          parent_workplace: '',
          parent_phone: '',
          parent_email: '',
          study_sessions: '',
          study_schedule: '',
        }
      }
    },
    async save() {
      var valid = await Promise.all([
        this.$refs.person.$validator.validate(),
        this.$validator.validate()
      ]);

      if (filter(valid).length != 2) {
        throw Error('invalid');
      }

      try {
        var person = (await this.$refs.person.save()).data.data;

        this.row.data.person_id  = person.id;

        return await this.send();
      } catch (e) {
        throw e;
      }
    }
  }
}
</script>
