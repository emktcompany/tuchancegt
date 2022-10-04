var apiUrl = 'admin/dialects/:id?';

export default [
  {
    path: 'dialectos',
    name: 'admin.dialects',
    component: () => import(/* webpackChunkName: "admin-dialects" */ '@/pages/Admin/Dialects/Index.vue'),
    meta: {
      title: 'Dialectos',
      apiUrl
    }
  },
  {
    path: 'dialectos/crear',
    name: 'admin.dialects.create',
    component: () => import(/* webpackChunkName: "admin-dialects" */ '@/pages/Admin/Dialects/Form.vue'),
    meta: {
      title: 'Crear',
      parent: 'admin.dialects',
      apiUrl
    }
  },
  {
    path: 'dialectos/edita/:id',
    name: 'admin.dialects.edit',
    component: () => import(/* webpackChunkName: "admin-dialects" */ '@/pages/Admin/Dialects/Form.vue'),
    meta: {
      title: 'Editar',
      parent: 'admin.dialects',
      apiUrl
    }
  },
];
