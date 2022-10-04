var apiUrl = 'admin/labor-mobility-people/:id?';

export default [
  {
    path: 'mobilidad/personas',
    name: 'admin.labor-mobility-people',
    component: () => import(/* webpackChunkName: "admin-labor-mobility-people" */ '@/pages/Admin/LaborMobilityPeople/Index.vue'),
    meta: {
      title: 'Movilidad Laboral / Personas',
      apiUrl
    }
  },
  {
    path: 'mobilidad/personas/crear',
    name: 'admin.labor-mobility-people.create',
    component: () => import(/* webpackChunkName: "admin-labor-mobility-people" */ '@/pages/Admin/LaborMobilityPeople/Form.vue'),
    meta: {
      title: 'Crear',
      parent: 'admin.labor-mobility-people',
      apiUrl
    }
  },
  {
    path: 'mobilidad/personas/edita/:id',
    name: 'admin.labor-mobility-people.edit',
    component: () => import(/* webpackChunkName: "admin-labor-mobility-people" */ '@/pages/Admin/LaborMobilityPeople/Form.vue'),
    meta: {
      title: 'Editar',
      parent: 'admin.labor-mobility-people',
      apiUrl
    }
  },
];
