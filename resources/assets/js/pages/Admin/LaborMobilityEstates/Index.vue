<template lang="html">
  <div class="py-8">
    <index-view ref="index" :url="url" title="Movilidad Laboral - Empresas">
      <div class="flex-1 flex xs:flex-wrap no-underline text-grey-darker items-center p-4" slot="item" slot-scope="item">
        <div class="xs:w-full sm:flex-1 xs:pb-2">
          <p class="text-red font-bold font-dosis">
            {{item.row.name}}
          </p>
        </div>
        <div class="flex-none w-24 xs:w-1/2 sm:text-center">
          <span class="font-dosis text-xs">{{ item.row.created_at | date }}</span>
        </div>
      </div>

      <template slot="item-actions" slot-scope="item">
        <router-link :to="{name: 'admin.labor-mobility-estates.edit', params: { id: item.row.id }}" class="outline-none focus:outline-none p-2 appearance-none flex items-center" v-tooltip.top-center="'Editar'"><svg-icon src="~@svg/icons/regular/edit.svg" class="block fill-current w-4 h-4" /></router-link>
      </template>

      <template slot="actions">
        <router-link :to="{name: 'admin.labor-mobility-estates.create'}" class="btn bg-teal uppercase text-white">Agregar</router-link>
      </template>

      <template slot="filters" slot-scope="index">
        <div class="flex items-end mb-6 -mx-3">
          <div class="px-3 w-full sm:w-1/3 flex-none">
            <form-field label-class="text-xs" name="term" label="Buscar">
              <input placeholder="Bucar por nombre" type="text" v-model="index.query.term" class="form-field text-xs">
            </form-field>
          </div>
          <div class="flex-none px-3 py-2">
            <button type="submit" class="btn bg-purple uppercase text-white px-4 py-2">
              &nbsp;<svg-icon class="w-4 h-4 fill-none stroke-current" src="~@svg/search-icon.svg" />&nbsp;
            </button>
          </div>
        </div>
      </template>
    </index-view>
  </div>
</template>

<script>
export default {
  data() {
    return {
      url: '/admin/labor-mobility-estates/:id?'
    }
  }
}
</script>
