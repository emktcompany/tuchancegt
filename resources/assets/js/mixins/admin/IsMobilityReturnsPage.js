import find from 'lodash/find';

export default {
  data() {
    return {
      mobilityCountry: null
    };
  },
  watch: {
    $mobilityCountries(value, old) {
      this.setCountry(value);
    },
    $route(value, old) {
      this.setCountry();
    }
  },
  created() {
    this.setCountry();
  },
  methods: {
    setCountry(countries = null) {
      var id = Number(this.$route.params.labor_mobility_country_id);

      if (!countries) {
        countries = this.$mobilityCountries;
      }

      this.mobilityCountry = find(countries, {id});
    }
  }
};
