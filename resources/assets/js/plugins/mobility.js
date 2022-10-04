export default {
  install(Vue) {
    Vue.mixin({
      computed: {
        $mobilityCountries() {
          if (!this.$root.mobilityCountries.length) {
            this.$root.loadMobilityCountries();
          }

          return this.$root.mobilityCountries;
        }
      }
    });
  }
}

export let HasMobilityCountries = {
  data() {
    return {
      mobilityCountries: [],
      loadingMobilityCountries: false
    };
  },
  methods: {
    async loadMobilityCountries() {
      if (this.loadingMobilityCountries) {
        return;
      }

      this.loadingMobilityCountries = true;

      var response = await this.$http
        .get('admin/labor-mobility-countries?all=true');

      this.mobilityCountries = response.data.data;
    }
  }
};
