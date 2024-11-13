// resources/js/router.js
import { createRouter, createWebHistory } from 'vue-router';
import Products from './components/Products.vue';

const routes = [
  {
    path: '/loai-san-pham/:slug',
    name: 'Products',
    component: Products,
    props: true
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;