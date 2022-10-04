<template lang="html">
  <v-select class="form-field" label="name" :name="name" @input="onInput" :options="dialects" v-model="selected" :placeholder="placeholder">
    <div class="text-left text-sm px-2" slot="no-options">{{noOptions}}</div>
  </v-select>
</template>

<script>
import find from 'lodash/find';

export default {
  props: {
    name: {
      type: String,
      default: 'dialect_id'
    },
    placeholder: {
      type: String,
      default: 'Dialecto'
    },
    ethnicityId: {
      type: [Number, null],
      default: null
    },
    value: {
      required: false
    }
  },
  data() {
    return {
      selected: null,
      dialects: []
    };
  },
  created() {
    this.reload();
  },
  watch: {
    value() {
      this.inferSelected();
    },
    dialects() {
      this.inferSelected();
    },
    ethnicityId() {
      this.reload();
    }
  },
  computed: {
    noOptions() {
      return !this.ethnicityId ? 'Selecciona un departamento' : 'No encontramos ese municipio';
    }
  },
  methods: {
    inferSelected() {
      if (this.value) {
        this.selected = find(this.dialects, {id: this.value}) || null;
      } else {
        this.selected = null;
      }
    },
    async reload() {
      var response = await this.$http.get('admin/dialects', {
        params: {
          all: 1,
          ethnicity_id: this.ethnicityId
        }
      });
      this.dialects  = response.data.data;
      this.inferSelected();
    },
    onInput() {
      this.$emit('input', this.selected ? this.selected.id : null);
      this.$emit('change', this.selected);
    }
  }
}
</script>
