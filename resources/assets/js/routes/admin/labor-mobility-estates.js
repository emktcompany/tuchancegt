var apiUrl = 'admin/labor-mobility-estates/:id?';

export default [
  {
    path: 'mobilidad/empresas',
    name: 'admin.labor-mobility-estates',
    component: () => import(/* webpackChunkName: "admin-labor-mobility-estates" */ '@/pages/Admin/LaborMobilityEstates/Index.vue'),
    meta: {
      title: 'Movilidad Laboral / Empresas',
      apiUrl
    }
  },
  {
    path: 'mobilidad/empresas/crear',
    name: 'admin.labor-mobility-estates.create',
    component: () => import(/* webpackChunkName: "admin-labor-mobility-estates" */ '@/pages/Admin/LaborMobilityEstates/Form.vue'),
    meta: {
      title: 'Crear',
      parent: 'admin.labor-mobility-estates',
      apiUrl
    }
  },
  {
    path: 'mobilidad/empresas/edita/:id',
    name: 'admin.labor-mobility-estates.edit',
    component: () => import(/* webpackChunkName: "admin-labor-mobility-estates" */ '@/pages/Admin/LaborMobilityEstates/Form.vue'),
    meta: {
      title: 'Editar',
      parent: 'admin.labor-mobility-estates',
      apiUrl
    }
  },
];
