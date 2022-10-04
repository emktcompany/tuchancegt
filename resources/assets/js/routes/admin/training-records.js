var apiUrl = 'admin/training-records/:id?';

export default [
  {
    path: 'capacitaciones/registro/reporte',
    name: 'admin.training-records.export',
    component: () => import(/* webpackChunkName: "admin-training-records" */ '@/pages/Admin/TrainingRecords/Export.vue'),
    meta: {
      title: 'Exportar',
      parent: 'admin',
      apiUrl
    }
  },
  {
    path: 'capacitaciones/registro/estadisticas',
    name: 'admin.training-records.stats',
    component: () => import(/* webpackChunkName: "admin-training-records" */ '@/pages/Admin/TrainingRecords/Stats.vue'),
    meta: {
      title: 'Estadísticas',
      parent: 'admin',
      apiUrl
    }
  },
  {
    path: 'capacitaciones/registro',
    name: 'admin.training-records',
    component: () => import(/* webpackChunkName: "admin-training-records" */ '@/pages/Admin/TrainingRecords/Index.vue'),
    meta: {
      title: 'Capacitaciones / Registros',
      apiUrl
    }
  },
  {
    path: 'capacitaciones/registro/crear',
    name: 'admin.training-records.create',
    component: () => import(/* webpackChunkName: "admin-training-records" */ '@/pages/Admin/TrainingRecords/Form.vue'),
    meta: {
      title: 'Crear',
      parent: 'admin.training-records',
      apiUrl
    }
  },
  {
    path: 'capacitaciones/registro/edita/:id',
    name: 'admin.training-records.edit',
    component: () => import(/* webpackChunkName: "admin-training-records" */ '@/pages/Admin/TrainingRecords/Form.vue'),
    meta: {
      title: 'Editar',
      parent: 'admin.training-records',
      apiUrl
    }
  },
  {
    path: 'capacitaciones/registro/importar',
    name: 'admin.training-records.import',
    component: () => import(/* webpackChunkName: "admin-training-records" */ '@/pages/Admin/TrainingRecords/Import.vue'),
    meta: {
      title: 'Importar',
      parent: 'admin.training-records',
      apiUrl
    }
  },
];
