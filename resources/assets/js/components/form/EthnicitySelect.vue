<template lang="html">
  <v-select class="form-field" label="name" :name="name" @input="onInput" :options="ethnicities" v-model="selected" :placeholder="label">
    <div class="text-left text-sm px-2" slot="no-options">Sin resultados</div>
  </v-select>
</template>

<script>
import find from 'lodash/find';

export default {
  props: {
    name: {
      type: String,
      default: 'ethnicity_id'
    },
    label: {
      type: String,
      default: 'Etnia'
    },
    value: {
      required: false
    }
  },
  data() {
    return {
      selected: null,
      ethnicities: []
    };
  },
  async created() {
    this.reload();
    this.inferSelected();
  },
  watch: {
    value() {
      this.inferSelected();
    }
  },
  methods: {
    inferSelected() {
      if (this.value) {
        this.selected = find(this.ethnicities, {id: this.value}) || null;
      } else {
        this.selected = null;
      }
    },
    async reload() {
      var response     = await this.$http.get('admin/ethnicities', {
        parans: {all: 1}
      });
      this.ethnicities = response.data.data;
      this.inferSelected();
    },
    onInput() {
      this.$emit('input', this.selected ? this.selected.id : null);
      this.$emit('change', this.selected);
    }
  }
}
</script>
