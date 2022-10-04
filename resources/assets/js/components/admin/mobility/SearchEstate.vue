<template>
  <v-select @input="onSelected" class="form-field" v-model="estate" :options="estates" :filterable="false" :on-search="onSearch" label="name">
    <template slot="option" slot-scope="option">
      <span class="block">{{ option.name }}</span>
    </template>
    <template slot="no-options">
      Digite el nombre o el número de identificación
    </template>
  </v-select>
</template>

<script>
import debounce from 'lodash/debounce';

export default {
  props: {
    value: {
      type: [Object, null],
      default: null
    },
    country: {
      type: [Object, null],
      default: null
    }
  },
  watch: {
    value(estate) {
      this.estate = estate;
    }
  },
  data() {
    return {
      estates: [],
      estate: null
    };
  },
  created() {
    this.estate = this.value ? Object.assign({}, this.value) : null;
  },
  methods: {
    onSelected(estate) {
      this.$emit('input', estate);
    },
    onSearch(term, loading) {
      loading(true);
      this.search(loading, term, this);
    },
    search: debounce((loading, term, vm) => {
      var params = {
        term
      };

      if (vm.country) {
        params.labor_mobility_country_id = vm.country.id;
      }

      vm.$http
        .get('admin/labor-mobility-estates', {params})
        .then((response) => {
          vm.estates = response.data.data;
          // vm.estates.unshift({
          //   id: null,
          //   name: 'Crear nueva'
          // });
          loading(false);
        });
    }, 350)
  }
}
</script>
