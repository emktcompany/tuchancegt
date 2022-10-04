var apiUrl = 'admin/training-workshops/:id?';

export default [
  {
    path: 'capacitaciones/talleres',
    name: 'admin.training-workshops',
    component: () => import(/* webpackChunkName: "admin-training-workshops" */ '@/pages/Admin/TrainingWorkshops/Index.vue'),
    meta: {
      title: 'Capacitaciones / Talleres',
      apiUrl
    }
  },
  {
    path: 'capacitaciones/talleres/crear',
    name: 'admin.training-workshops.create',
    component: () => import(/* webpackChunkName: "admin-training-workshops" */ '@/pages/Admin/TrainingWorkshops/Form.vue'),
    meta: {
      title: 'Crear',
      parent: 'admin.training-workshops',
      apiUrl
    }
  },
  {
    path: 'capacitaciones/talleres/edita/:id',
    name: 'admin.training-workshops.edit',
    component: () => import(/* webpackChunkName: "admin-training-workshops" */ '@/pages/Admin/TrainingWorkshops/Form.vue'),
    meta: {
      title: 'Editar',
      parent: 'admin.training-workshops',
      apiUrl
    }
  },
];
