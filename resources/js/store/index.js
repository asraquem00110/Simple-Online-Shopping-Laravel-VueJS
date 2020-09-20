import Vuex from 'vuex'
import Vue from 'vue'
import axios from 'axios'

import product from './product'
import cart from './cart'
import order from './order'
import path from '../config/path'

Vue.use(Vuex)

export default new Vuex.Store({
	 // namespaced: true,
	modules: {
		product,
		cart,
		order,
	},

	state: {
		status: '',
		token: localStorage.getItem('token') ? localStorage.getItem('token') : '',
		user: localStorage.getItem('loguser') ? localStorage.getItem('loguser') : 'guest',
		//email: localStorage.getItem('email') ? localStorage.getItem('email') : '',
		//id: localStorage.getItem('id') ? localStorage.getItem('id') : 0,
		//img: localStorage.getItem('img') ? localStorage.getItem('img') : '',
		imgUrl: "http://localhost:8000/upload/",
	},
	getters: {
		getToken: function(state,getter){
			return state.token
		},

		getUserDetails: function(state,getter){
			return state.userdetails
		}
	},
	actions: {
		login: function(context,data){
			return new Promise((resolve,reject)=>{
				axios.post(`/api/login`,data).then((res)=>{
					
					if(!res.data.errors && !res.data.message){
							const token = res.data.access_token
							const user = res.data.user

							localStorage.setItem('token',token)
							localStorage.setItem('isLogin', 1 )
							localStorage.setItem('loguser', user.name )
							//localStorage.setItem('email', user.email)
							//localStorage.setItem('id', user.id)
							//localStorage.setItem('img', user.img)
							// axios.defaults.headers.common['Authorization'] = token
							context.commit('auth_success',{token: token,user: user})
							
					}
					resolve(res)
				
				}).catch((err)=>{
					commit('auth_error')
					localStorage.removeItem('token')
					reject(err)
				})
			})
		},
		logout: function(context){
		     localStorage.removeItem('token')
			 localStorage.removeItem('isLogin')
			 localStorage.removeItem('loguser')
			 //localStorage.removeItem('email')
			// localStorage.removeItem('id')
			 //localStorage.removeItem('img')
			
			 return new Promise((resolve, reject) => {
			 	// console.log(context.state.token)
			
			    axios.post(`/api/logout`,null,{headers: {'Accept': 'application/json','Authorization': 'Bearer '+ context.state.token}}).then((res)=>{
			    	context.commit('logout')
		
			     //   delete axios.defaults.headers.common['Authorization']
			    	resolve(res)
			    }).catch((err)=>{

			    	reject(err)
			    })
			  })
		},
		register: function(context,data){
			return new Promise((resolve, reject) => {
			 	// console.log(context.state.token)
			
			    axios.post(`./api/register`,data).then((res)=>{
			   
			     //   delete axios.defaults.headers.common['Authorization']
			    	resolve(res)
			    }).catch((err)=>{

			    	reject(err)
			    })
			  })
		},
		getUserInfo: function(context){
			return new Promise((resolve,reject)=>{
				axios.get(`/api/user`,{headers: {'Accept': 'application/json','Authorization': 'Bearer '+ context.state.token}})
				.then((res)=>{
					resolve(res)
				}).catch((err)=>{
					reject(err)
					console.log(err)
				})
			})
		}
	},
	mutations: {
		auth_error: function(state,data){
			state.status = 'error'
		},
		auth_success: function(state,data){
			state.status = 'success'
			state.token = data.token
			state.user = data.user.name
			

			//console.log(state.userdetails)
		},
		logout: function(state){
			state.status = ''
    		state.token = ''
    		state.user = 'guest'
    		
		}
	}


});