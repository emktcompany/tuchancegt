let children = [
  {
    name: 'admin.dashboard',
    path: '',
    component: () => import(/* webpackChunkName: "admin" */ '@/pages/Admin/DashboardPage.vue'),
  }
];

children = children
  .concat(require('./admin/stats').default)
  .concat(require('./admin/users').default)
  .concat(require('./admin/candidates').default)
  .concat(require('./admin/bidders').default)
  .concat(require('./admin/opportunities').default)
  .concat(require('./admin/enrollments').default)
  .concat(require('./admin/categories').default)
  .concat(require('./admin/banners').default)
  .concat(require('./admin/interests').default)
  .concat(require('./admin/testimonials').default)
  .concat(require('./admin/faqs').default)
  .concat(require('./admin/labor-mobility-countries').default)
  .concat(require('./admin/labor-mobility-estates').default)
  .concat(require('./admin/labor-mobility-people').default)
  .concat(require('./admin/labor-mobility-returns').default)
  .concat(require('./admin/labor-mobility-interviews').default)
  .concat(require('./admin/skills').default)
  .concat(require('./admin/dialects').default)
  .concat(require('./admin/ethnicities').default)
  .concat(require('./admin/training-workshops').default)
  .concat(require('./admin/training-people').default)
  .concat(require('./admin/training-records').default)
  .concat(require('./admin/email-templates').default)
;

export default [
  {
    path: '/admin',
    component: () => import(/* webpackChunkName: "admin" */ '@/components/layouts/AdminLayout.vue'),
    meta: {
      title: 'Administración',
      route: 'admin.dashboard',
      auth: {roles: ['admin', 'bidder'], redirect: '/cuenta/login'}
    },
    children
  }
];
