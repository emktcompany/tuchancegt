<template>
  <v-select @input="onSelected" class="form-field" v-model="person" :options="people" :filterable="false" :on-search="onSearch" label="full_name">
    <template slot="option" slot-scope="option">
      <span class="block">{{ option.full_name }}</span>
      <span class="block">ID: {{ option.id_number }}</span>
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
    }
  },
  data() {
    return {
      people: [],
      person: null
    };
  },
  watch: {
    value(person) {
      this.person = person;
    }
  },
  created() {
    this.person = this.value ? Object.assign({}, this.value) : null;
  },
  methods: {
    onSelected(person) {
      this.$emit('input', person);
    },
    onSearch(term, loading) {
      loading(true);
      this.search(loading, term, this);
    },
    search: debounce((loading, term, vm) => {
      vm.$http
        .get('admin/training-people', {
          params: {
            term
          }
        })
        .then((response) => {
          vm.people = response.data.data;
          // vm.people.unshift({
          //   id: null,
          //   full_name: 'Crear nuevo'
          // });
          loading(false);
        });
    }, 350)
  }
}
</script>
