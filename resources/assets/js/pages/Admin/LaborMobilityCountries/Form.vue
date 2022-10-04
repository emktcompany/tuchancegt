<template lang="html">
  <form @submit.prevent="submit" class="bg-grey-lighter p-4 md:p-12 max-w-xl mx-auto mb-12">
    <form-field name="remote_id" label="Nombre">
      <country-select @change="onChange" v-model="row.data.remote_id" name="remote_id" />
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
        name: 'admin.labor-mobility-countries.edit',
        params: {id: data.id}
      });
    },
    reset() {
      this.row = {
        data: {
          name: '',
          remote_id: null
        }
      };
    },
    onChange(selected) {
      this.row.data.name = selected.name;
    }
  }
}
</script>
