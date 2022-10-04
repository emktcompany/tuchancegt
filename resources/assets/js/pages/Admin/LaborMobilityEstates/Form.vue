<template>
  <form @submit.prevent="submit" class="bg-grey-lighter p-4 md:p-12 max-w-xl mx-auto mb-12">
    <estate-form ref="estate" v-model="row.data" />
    <div class="text-right mt-6">
      <button type="submit" class="btn bg-teal text-white">Guardar cambios</button>
    </div>
  </form>
</template>

<script>
import FormPage from '@/components/admin/FormPage.vue';
import EstateForm from '@/components/admin/mobility/EstateForm.vue';

export default {
  components: {
    EstateForm
  },
  extends: FormPage,
  methods: {
    saved({data}) {
      this.$router.push({
        name: 'admin.labor-mobility-estates.edit',
        params: {id: data.id}
      });
    },
    async save() {
      try {
        return await this.$refs.estate.save();
      } catch (e) {
        throw e;
      }
    }
  }
}
</script>
