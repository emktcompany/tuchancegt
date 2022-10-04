var apiUrl = 'admin/labor-mobility-returns/:id?';

export default [
  {
    path: 'mobilidad/retornos/reporte',
    name: 'admin.labor-mobility-returns.export',
    component: () => import(/* webpackChunkName: "admin-labor-mobility-returns" */ '@/pages/Admin/LaborMobilityReturns/Export.vue'),
    meta: {
      title: 'Exportar',
      parent: 'admin',
      apiUrl
    }
  },
  {
    path: 'mobilidad/retornos/estadisticas',
    name: 'admin.labor-mobility-returns.stats',
    component: () => import(/* webpackChunkName: "admin-labor-mobility-returns" */ '@/pages/Admin/LaborMobilityReturns/Stats.vue'),
    meta: {
      title: 'Estadísticas',
      parent: 'admin',
      apiUrl
    }
  },
  {
    path: 'mobilidad/retornos/:labor_mobility_country_id',
    name: 'admin.labor-mobility-returns',
    component: () => import(/* webpackChunkName: "admin-labor-mobility-returns" */ '@/pages/Admin/LaborMobilityReturns/Index.vue'),
    meta: {
      title: 'Movilidad Laboral / Retornos',
      apiUrl
    }
  },
  {
    path: 'mobilidad/retornos/:labor_mobility_country_id/crear',
    name: 'admin.labor-mobility-returns.create',
    component: () => import(/* webpackChunkName: "admin-labor-mobility-returns" */ '@/pages/Admin/LaborMobilityReturns/Form.vue'),
    meta: {
      title: 'Crear',
      parent: 'admin.labor-mobility-returns',
      apiUrl
    }
  },
  {
    path: 'mobilidad/retornos/:labor_mobility_country_id/edita/:id',
    name: 'admin.labor-mobility-returns.edit',
    component: () => import(/* webpackChunkName: "admin-labor-mobility-returns" */ '@/pages/Admin/LaborMobilityReturns/Form.vue'),
    meta: {
      title: 'Editar',
      parent: 'admin.labor-mobility-returns',
      apiUrl
    }
  },
  {
    path: 'mobilidad/importar',
    name: 'admin.labor-mobility-returns.import',
    component: () => import(/* webpackChunkName: "admin-labor-mobility-returns" */ '@/pages/Admin/LaborMobilityReturns/Import.vue'),
    meta: {
      title: 'Importar',
      parent: 'admin.labor-mobility-returns',
      apiUrl
    }
  },
];
