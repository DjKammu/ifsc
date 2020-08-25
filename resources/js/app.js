require('./bootstrap');

import Vue from 'vue'
import App from './App.vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import VueAxios from 'vue-axios';
import axios from 'axios';

Vue.use(VueAxios, axios);


import DistrictComponent from './components/DistrictComponent.vue';
import BranchComponent from './components/BranchComponent.vue';
import StateComponent from './components/StateComponent.vue';
import HomeComponent from './components/HomeComponent.vue';
import BankComponent from './components/BankComponent.vue';
import CityComponent from './components/CityComponent.vue';
import IFSCComponent from './components/IFSCComponent.vue';


const routes = [
  {
      name: 'home',
      path: '/',
      component: HomeComponent
    },
    {
      path: '/home',
      name: 'Home',
      component: HomeComponent
    },
    {
        name: 'ifsc',
        path: '/ifsc/:ifsc?',
        component: IFSCComponent
    },
    {
        name: 'bank',
        path: '/:bank',
        component: BankComponent
    },
    {
        name: 'state',
        path: '/:bank/:state',
        component: StateComponent
    },
    {
        name: 'district',
        path: '/:bank/:state/:district',
        component: DistrictComponent
    },
    {
        name: 'city',
        path: '/:bank/:state/:district/:city',
        component: CityComponent
    },
    {
        name: 'branch',
        path: '/:bank/:state/:district/:city/:branch',
        component: BranchComponent
    }
];

const router = new VueRouter({ mode: 'history', routes: routes});
const app = new Vue({ 
render: h => h(App), // mount the base component
 router 
}).$mount('#app');