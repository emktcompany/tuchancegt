import {objectToFormData} from '@/lib/formData';
import {compile} from 'path-to-regexp';

export default {
  data() {
    return {
      row: {data: {}},
      apiUrl: null
    };
  },
  methods: {
    url(data) {
      var  url = compile(this.apiUrl ? this.apiUrl : this.$route.meta.apiUrl);
      return url(data);
    },
    async send() {
      var form_data = objectToFormData(this.row.data);
      var endpoint;

      if (this.row.data.id) {
        form_data.append('_method', 'put');
        endpoint = this.url(this.row.data);
      } else {
        endpoint = this.url();
      }

      try {
        var response = await this.$http.post(endpoint, form_data);
        this.sent(response);
        return response;
      } catch (e) {
        throw e;
      }
    },
    async validate() {
      var valid = await this.$validator.validate();

      if (valid) {
        return await this.send();
      }

      throw Error('invalid');
    },
    async save() {
      return await this.validate();
    },
    sent(response) {}
  }
}
