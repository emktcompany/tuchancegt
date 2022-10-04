var apiUrl = 'admin/labor-mobility-interviews/:id?';

export default [
  {
    path: 'mobilidad/entrevistas',
    name: 'admin.labor-mobility-interviews',
    component: () => import(/* webpackChunkName: "admin-labor-mobility-interviews" */ '@/pages/Admin/LaborMobilityInterviews/Index.vue'),
    meta: {
      title: 'Movilidad Laboral / Retornos',
      apiUrl
    }
  },
  {
    path: 'mobilidad/entrevistas/crear',
    name: 'admin.labor-mobility-interviews.create',
    component: () => import(/* webpackChunkName: "admin-labor-mobility-interviews" */ '@/pages/Admin/LaborMobilityInterviews/Form.vue'),
    meta: {
      title: 'Crear',
      parent: 'admin.labor-mobility-interviews',
      apiUrl
    }
  },
  {
    path: 'mobilidad/entrevistas/edita/:id',
    name: 'admin.labor-mobility-interviews.edit',
    component: () => import(/* webpackChunkName: "admin-labor-mobility-interviews" */ '@/pages/Admin/LaborMobilityInterviews/Form.vue'),
    meta: {
      title: 'Editar',
      parent: 'admin.labor-mobility-interviews',
      apiUrl
    }
  },
];
