<template lang="html">
  <form @submit.prevent="submit" class="bg-grey-lighter p-4 md:p-12 max-w-xl mx-auto mb-12">
    <form-field name="name" label="Nombre">
      <input type="text" name="name" v-validate="{required: true}" class="form-field text-sm" v-model="row.data.name">
    </form-field>
    <form-field name="code" label="Código">
      <input type="text" name="code" v-validate="{required: true}" class="form-field text-sm" v-model="row.data.code">
    </form-field>
    <form-field name="ethnicity_id" label="Código">
      <ethnicity-select name="ethnicity_id" v-model="row.data.ethnicity_id"></ethnicity-select>
    </form-field>
    <div class="text-right mt-6">
      <button type="submit" class="btn bg-teal text-white">Guardar cambios</button>
    </div>
  </form>
</template>

<script>
import FormPage from '@/components/admin/FormPage.vue';

export default {
  extends: FormPage,
  methods: {
    saved({data}) {
      this.$router.push({
        name: 'admin.dialects.edit',
        params: {id: data.id}
      });
    },
    reset() {
      this.row = {
        data: {
          ethnicity_id: null,
          code: '',
          name: ''
        }
      };
    }
  }
}
</script>
