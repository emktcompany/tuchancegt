<template lang="html">
  <section>
    <div class="flex items-center">
      <div class="flex-1">
        <h2 class="text-cyan font-dosis font-bold text-3xl">Estadísticas</h2>
      </div>
      <form-field class="md:border-l border-grey px-4 w-full md:w-1/4" name="period" label="Selecciona un rango de fechas">
        <date-range-picker v-model="period" />
      </form-field>
    </div>

    <div class="admin-box">
      <div class="admin-box-title flex flex-wrap justify-between items-center">
        <h2 class="flex-1 text-teal font-dosis font-bold xs:mb-4 leading-none">Registros por fecha</h2>
        <div class="pl-2 w-full sm:w-64 flex-none date-range-picker">
          <form-field name="dimension" class="py-0" label-class="text-xs" label="Ver resultados por:">
            <v-select class="form-field text-xs" :value="dimensions[0]" @input="setDimension" :options="dimensions" />
          </form-field>
        </div>
      </div>
      <div class="admin-box-inner">
        <base-chart :chart-data="datesChart" />
      </div>
    </div>
  </section>
</template>

<script>

export default {
  data() {
    return {
      query: {
        dimension: 'day',
        country_id: null,
        state_id: null,
        city_id: null,
      },
      period: {since: 'first day of last month', until: null},
      dimensions: [
        {label: 'Día', value: 'day'},
        {label: 'Mes', value: 'month'},
        {label: 'Año', value: 'year'},
      ],
      datesChart: null,
      categoriesChart: null
    };
  },
  mounted() {
    this.load();
  },
  watch: {
    period(value, old) {
      if (
        old.since != value.since ||
        old.until != value.until
      ) {
        this.load();
      }
    }
  },
  methods: {
    async load(draw = true) {
      var params = Object.assign({}, this.period, this.query);

      var stats = await this.$http.get('/admin/stats/training', {
        params
      });

      this.datesChart = stats.data.main;
    },
    setDimension(value) {
      if (this.query.dimension != value.value) {
        this.query.dimension = value.value;
        this.load();
      }
    }
  }
}
</script>
