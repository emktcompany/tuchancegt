export default {
  data() {
    return {
      countryId: null,
      stateId: null
    };
  },
  methods: {
    onStateSelected(state) {
      if (state) {
        this.row.data.state = state.name;
      } else {
        delete this.row.data.state;
      }
    },
    onCitySelected(city) {
      if (city) {
        this.row.data.city = city.name;
      } else {
        delete this.row.data.city;
      }
    },
    onCountySelected(county) {
      if (county) {
        this.row.data.county = county.name;
      } else {
        delete this.row.data.county;
      }
    },
    onCountrySelected(country) {
      if (country) {
        this.row.data.labor_mobility_country_id = country.id;
      } else {
        delete this.row.data.county;
      }
    },
    onProvinceSelected(county) {
      if (county) {
        this.row.data.county = county.name;
      } else {
        delete this.row.data.county;
      }
    }
  }
}
