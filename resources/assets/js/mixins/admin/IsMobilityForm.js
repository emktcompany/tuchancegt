import find from 'lodash/find';

export default {
  data() {
    return {
      mobilityCountry: null
    };
  },
  computed: {
    usa() {
      return this.mobilityCountry && this.mobilityCountry.name == 'Estados Unidos';
    },
    canada() {
      return this.mobilityCountry && (this.mobilityCountry.name == 'Canada' || this.mobilityCountry.name == 'Canadá');
    },
    mex() {
      return this.mobilityCountry && this.mobilityCountry.name == 'México';
    },
    stateLabel() {
      return this.canada ? 'Provincia o territorio *' : 'Estado *';
    },
    cityLabel() {
      return this.canada ? 'Ciudad *' : 'Ciudad y Municipio *';
    }
  }
}
