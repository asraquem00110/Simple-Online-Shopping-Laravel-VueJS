


require('./bootstrap')

window.Vue = require('vue')
import Chartkick from 'vue-chartkick'
import Chart from 'chart.js'

Vue.use(Chartkick.use(Chart))

import VueToastr from "vue-toastr"
// use plugin
Vue.use(VueToastr, {})

import VueRouter from 'vue-router'

window.Vue.use(VueRouter)

import path from './config/path'


import AdminNotFoundComponent from './components/AdminNotFoundComponent'
import AdminComponent from './components/admin/AdminComponent.vue'

import ProductComponent from './components/admin/product/ProductComponent.vue'
import CreateProductComponent from './components/admin/product/CreateProductComponent.vue'
import EditProductComponent from './components/admin/product/EditProductComponent.vue'


import CategoryComponent from './components/admin/category/CategoryComponent.vue'
import CreateCategoryComponent from './components/admin/category/CreateCategoryComponent.vue'
import EditCategoryComponent from './components/admin/category/EditCategoryComponent.vue'

import BrandComponent from './components/admin/brand/BrandComponent.vue'
import CreateBrandComponent from './components/admin/brand/CreateBrandComponent.vue'
import EditBrandComponent from './components/admin/brand/EditBrandComponent.vue'
import LoginComponent from './components/admin/LoginComponent.vue'

import AdminListComponent from './components/admin/user/AdminListComponent.vue'
import CustomerComponent from './components/admin/user/CustomerComponent.vue'
import EditUserComponent from './components/admin/user/EditUserComponent.vue'
import NewUserComponent from './components/admin/user/NewUserComponent.vue'


import PendingOrdersComponent from './components/admin/order/PendingOrdersComponent.vue'
import ForDeliveryComponent from './components/admin/order/ForDeliveryComponent.vue'
import RecordListComponent from './components/admin/order/RecordListComponent.vue'
import SalesReportComponent from './components/admin/order/SalesReportComponent.vue'

import UploadComponent from './components/admin/UploadComponent.vue'


import {Auth,Login} from './RedirectMiddleware.js'

// import sample from './sample/index'

// console.log(sample.test())



 const routes = [
 
 	// {path: `./admin`,component: AdminComponent,name: 'adminindex', beforeEnter: Auth,Login},
 	{path: `/admin`,component: AdminComponent,name: 'adminindex', beforeEnter: Auth},
 	{path: `/admin/login`,component: LoginComponent,name: 'adminlogin',beforeEnter: Login},
 	{path: `/admin/product`,component: ProductComponent,name: 'productlist',beforeEnter: Auth},
 	{path: `/admin/product/create`,component: CreateProductComponent,name: 'createProduct',beforeEnter: Auth},
 	{path:`/admin/product/:idno`,component: EditProductComponent,name: 'editProduct',beforeEnter: Auth},

 	{path: `/admin/category`,component: CategoryComponent,name: 'categorylist',beforeEnter: Auth},
 	{path: `/admin/category/create`,component: CreateCategoryComponent,name: 'createCategory',beforeEnter: Auth},
 	{path: `/admin/uploadtest`,component: UploadComponent, name: 'uploadtest',beforeEnter: Auth},
 	{path: `/admin/category/:idno`,component: EditCategoryComponent, name: 'editCategory',beforeEnter: Auth},

 	{path: `/admin/brand`,component: BrandComponent,name: 'brandlist',beforeEnter: Auth},
 	{path: `/admin/brand/create`,component: CreateBrandComponent, name: 'newbrand',beforeEnter: Auth},
 	{path: `/admin/brand/:idno`,component: EditBrandComponent,name: 'editBrand',beforeEnter: Auth},

 	{path: `/admin/newuser`,component: NewUserComponent,name: 'newuser', beforeEnter: Auth},
 	{path: `/admin/list`,component: AdminListComponent,name: 'adminlist', beforeEnter: Auth},
 	{path: `/admin/customerlist`,component: CustomerComponent,name: 'customerlist', beforeEnter: Auth},
 	{path: `/admin/editUser/:idno`,component: EditUserComponent, name: 'editUser',beforeEnter: Auth},

 	{path: `/admin/pendingOrders`,component: PendingOrdersComponent, name: 'pendingorder',beforeEnter: Auth},
 	{path: `/admin/forDelivery`,component: ForDeliveryComponent, name: 'fordelivery',beforeEnter: Auth},
 	{path: `/admin/records`,component: RecordListComponent, name: 'records',beforeEnter: Auth},
 	{path: `/admin/salesreport`,component: SalesReportComponent, name: 'salesreport',beforeEnter: Auth},
 	{path: '*',component: AdminNotFoundComponent},

 ]

 const router = new VueRouter({mode:'history',hash: false,routes});

//  router.beforeEach((to, from, next) => {
//   if (to.meta.requiresAuth) {
//     const authUser = 0
//     if (authUser == 1) {
//       next()
//     } else {
//       next({
//         name: 'adminlogin'
//       })
//     }
//   }
//   next()
// })


// const app = new Vue({
//     router,
// }).$mount('#app');

import store from './store/index'
import {mapState} from 'vuex'
const app = new Vue({
	el: '#app',
	router,
	store,
	methods: {
		logout: function(){
			this.$store.dispatch('logout').then((res)=>{
				console.log(res)
				this.$router.replace({name: 'adminlogin'})
				// window.location.href= "./"
			}).catch((err)=>{
				console.log(err.message)
			})
		}
	},
	computed: {
		UserLogged: function(){
			return this.$store.state.user
		},

		...mapState('order',{
			'pendingorder': state=> state.pendingOrder,
			'deliveryorder': state=> state.forDelivery
		})
	},

	created(){
			this.$store.dispatch('order/pendingOrders')
			this.$store.dispatch('order/deliveryOrders')
	}
})



