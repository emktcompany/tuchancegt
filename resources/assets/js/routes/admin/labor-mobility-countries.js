var apiUrl = 'admin/labor-mobility-countries/:id?';

export default [
  {
    path: 'mobilidad/paises',
    name: 'admin.labor-mobility-countries',
    component: () => import(/* webpackChunkName: "admin-labor-mobility-countries" */ '@/pages/Admin/LaborMobilityCountries/Index.vue'),
    meta: {
      title: 'Movilidad Laboral / Países',
      apiUrl
    }
  },
  {
    path: 'mobilidad/paises/crear',
    name: 'admin.labor-mobility-countries.create',
    component: () => import(/* webpackChunkName: "admin-labor-mobility-countries" */ '@/pages/Admin/LaborMobilityCountries/Form.vue'),
    meta: {
      title: 'Crear',
      parent: 'admin.labor-mobility-countries',
      apiUrl
    }
  },
  {
    path: 'mobilidad/paises/edita/:id',
    name: 'admin.labor-mobility-countries.edit',
    component: () => import(/* webpackChunkName: "admin-labor-mobility-countries" */ '@/pages/Admin/LaborMobilityCountries/Form.vue'),
    meta: {
      title: 'Editar',
      parent: 'admin.labor-mobility-countries',
      apiUrl
    }
  },
];
