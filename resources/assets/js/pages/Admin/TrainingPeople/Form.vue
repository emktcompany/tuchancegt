<template>
  <form @submit.prevent="submit" class="bg-grey-lighter p-4 md:p-12 max-w-xl mx-auto mb-12">
    <person-form ref="person" v-model="row.data" />
    <div class="text-right mt-6">
      <button type="submit" class="btn bg-teal text-white">Guardar cambios</button>
    </div>
  </form>
</template>

<script>
import FormPage from '@/components/admin/FormPage.vue';
import PersonForm from '@/components/admin/training/PersonForm.vue';

export default {
  extends: FormPage,
  components: {
    PersonForm
  },
  methods: {
    saved({data}) {
      this.$router.push({
        name: 'admin.training-people.edit',
        params: {id: data.id}
      });
    },
    async save() {
      try {
        return await this.$refs.person.save();
      } catch (e) {
        throw e;
      }
    }
  }
}
</script>
