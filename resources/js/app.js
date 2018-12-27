import Vue from 'vue'
import VueRouter from 'vue-router'
import { VLazyImagePlugin } from "v-lazy-image";
import VueSweetalert2 from 'vue-sweetalert2';

Vue.use(VueSweetalert2);
Vue.use(VLazyImagePlugin);
Vue.use(VueRouter)

require('./bootstrap');

window.Vue = require('vue');


Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('item-shop', require('./components/Shop/ItemShopComponent.vue'));
Vue.component('cart-shop', require('./components/Shop/CartShoppingModal.vue'));
Vue.component('item-detail', require('./components/Shop/ItemDetailComponent.vue'));
Vue.component('details-item', require('./components/Shop/ItemDetailComponent.vue'));

Vue.component('user-home', require('./components/UserActions/IndexUserComponent.vue'));
Vue.component('shop-finish', require('./components/Shop/ShopFinish.vue'));


import ItemDetail from './components/Shop/ItemDetailComponent.vue';
import indexShop from './components/Shop/IndexShopComponent.vue';
import NewItem from './components/UserActions/NewItem.vue';
import NewClient from './components/UserActions/NewClient.vue';
import Transactions from './components/UserActions/Transactions.vue';



const routes = [
    { name: 'indexShop', path: '/', component: indexShop },
    { name: 'ItemDetail', path: '/item/:id', component: ItemDetail, props: true},
    { name: 'NewItem', path: '/user/new/item', component: NewItem },
    { name: 'NewClient', path: '/user/new/client', component: NewClient },
    { name: 'Transactions', path: '/user/new/transactions', component: Transactions }

];
  
  const router = new VueRouter({
    routes, // short for `routes: routes`
   // mode: 'history'
  })
  
  const app = new Vue({
      el: '#app',
      router
  });
