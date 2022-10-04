var apiUrl = 'admin/ethnicities/:id?';

export default [
  {
    path: 'etnias',
    name: 'admin.ethnicities',
    component: () => import(/* webpackChunkName: "admin-ethnicities" */ '@/pages/Admin/Ethnicities/Index.vue'),
    meta: {
      title: 'Etnias',
      apiUrl
    }
  },
  {
    path: 'etnias/crear',
    name: 'admin.ethnicities.create',
    component: () => import(/* webpackChunkName: "admin-ethnicities" */ '@/pages/Admin/Ethnicities/Form.vue'),
    meta: {
      title: 'Crear',
      parent: 'admin.ethnicities',
      apiUrl
    }
  },
  {
    path: 'etnias/edita/:id',
    name: 'admin.ethnicities.edit',
    component: () => import(/* webpackChunkName: "admin-ethnicities" */ '@/pages/Admin/Ethnicities/Form.vue'),
    meta: {
      title: 'Editar',
      parent: 'admin.ethnicities',
      apiUrl
    }
  },
];
