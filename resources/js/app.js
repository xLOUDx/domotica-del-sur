import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

require('./bootstrap');

window.Vue = require('vue');


Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('item-shop', require('./components/Shop/ItemShopComponent.vue'));
Vue.component('cart-shop', require('./components/Shop/CartShoppingModal.vue'));
Vue.component('item-detail', require('./components/Shop/ItemDetailComponent.vue'));
Vue.component('new-item', require('./components/Shop/NewItemComponent.vue'));


import ItemDetail from './components/Shop/ItemDetailComponent.vue'
import indexShop from './components/Shop/IndexShopComponent.vue'


const routes = [
    { name:'indexShop', path: '/', component: indexShop },
    { name:'ItemDetail', path: '/item/:id', component: ItemDetail, props: true},
];
  
  const router = new VueRouter({
    routes, // short for `routes: routes`
   // mode: 'history'
  })
  
  const app = new Vue({
      el: '#app',
      router
  });
  