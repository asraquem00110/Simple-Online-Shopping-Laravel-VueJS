

require('./bootstrap')
// 

let bootstrap = require('bootstrap')
import 'bootstrap/dist/css/bootstrap.min.css'
import jQuery from 'jquery'
global.jQuery = jQuery

window.Vue = require('vue');

import VueRouter from 'vue-router';

window.Vue.use(VueRouter);

import VueToastr from "vue-toastr";
// use plugin
Vue.use(VueToastr, {});

Vue.config.productionTip = false;

import path from './config/path'

import NotFoundComponent from './components/NotFoundComponent';
import IndexComponent from './components/IndexComponent';
import TestComponent from './components/TestComponent';
import UserComponent from './components/user/IndexComponent';
import CartComponent from './components/shop/CartComponent';


const routes = [
	{path: `/`,component: IndexComponent,name: 'index'},
	{path: `/test`,component: TestComponent,name: 'test'},
	{path: `/UserProfile`,component: UserComponent,name: 'userprofile'},
	{path: `/MyCart`,component: CartComponent,name: 'cart'},
	{path: '*',component: NotFoundComponent},
];


const router = new VueRouter({mode: 'history',hash: false,routes});

import store from './store/index'



const app = new Vue({
	el: '#app',
	router,
	store,
	methods: {
		logout: function(){
			this.$store.dispatch('logout').then((res)=>{
				console.log(res)
				// this.$router.replace({name: 'adminlogin'})
			}).catch((err)=>{
				console.log(err.message)
			})
		}
	},
	computed: {
		UserLogged: function(){
			return this.$store.state.user
		}
	},
	mounted(){
	
	},
})