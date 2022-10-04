var apiUrl = 'admin/training-people/:id?';

export default [
  {
    path: 'capacitaciones/personas',
    name: 'admin.training-people',
    component: () => import(/* webpackChunkName: "admin-training-people" */ '@/pages/Admin/TrainingPeople/Index.vue'),
    meta: {
      title: 'Capacitaciones / Personas',
      apiUrl
    }
  },
  {
    path: 'capacitaciones/personas/crear',
    name: 'admin.training-people.create',
    component: () => import(/* webpackChunkName: "admin-training-people" */ '@/pages/Admin/TrainingPeople/Form.vue'),
    meta: {
      title: 'Crear',
      parent: 'admin.training-people',
      apiUrl
    }
  },
  {
    path: 'capacitaciones/personas/edita/:id',
    name: 'admin.training-people.edit',
    component: () => import(/* webpackChunkName: "admin-training-people" */ '@/pages/Admin/TrainingPeople/Form.vue'),
    meta: {
      title: 'Editar',
      parent: 'admin.training-people',
      apiUrl
    }
  },
];
