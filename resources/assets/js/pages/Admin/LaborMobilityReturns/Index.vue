<template lang="html">
  <div class="py-8">
    <index-view :params="{labor_mobility_country_id}" ref="index" :url="url" title="Movilidad Laboral - Retornos">
      <div class="flex-1 flex xs:flex-wrap no-underline text-grey-darker items-center p-4" slot="item" slot-scope="item">
        <div class="xs:w-full sm:flex-1 xs:pb-2">
          <p class="text-red font-bold font-dosis">
            {{item.row.state}}
          </p>
        </div>
        <div class="flex-none w-24 xs:w-1/2 sm:text-center">
          <span class="font-dosis text-xs">{{ item.row.created_at | date }}</span>
        </div>
      </div>

      <template slot="item-actions" slot-scope="item">
        <router-link :to="{name: 'admin.labor-mobility-returns.edit', params: { id: item.row.id }}" class="outline-none focus:outline-none p-2 appearance-none flex items-center" v-tooltip.top-center="'Editar'"><svg-icon src="~@svg/icons/regular/edit.svg" class="block fill-current w-4 h-4" /></router-link>
      </template>

      <template slot="actions">
        <router-link :to="{name: 'admin.labor-mobility-returns.create'}" class="btn bg-teal uppercase text-white">Agregar</router-link>
      </template>
    </index-view>
  </div>
</template>

<script>
import find from 'lodash/find';
import IsReturnsPage from '@/mixins/admin/IsMobilityReturnsPage';

export default {
  mixins: [IsReturnsPage],
  data() {
    return {
      url: '/admin/labor-mobility-returns/:id?'
    };
  },
  computed: {
    labor_mobility_country_id() {
      return this.$route.params.labor_mobility_country_id;
    }
  }
}
</script>
