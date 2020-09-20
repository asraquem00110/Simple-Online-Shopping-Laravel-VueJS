import { fn } from 'jquery'
import path from '../config/path'


export default {
		namespaced: true,
		state: {
			items: [],
			wishlists: [],
		},
		actions: {
			removewishlist: function(context,data){
				axios.delete(`/api/removewishlist/${data.id}`,{headers: {'Accept': 'application/json','Authorization': 'Bearer '+ context.rootState.token}})
					.then((res)=> context.commit("removeWishlist",data.index))
					.catch((err)=>console.log(err))
			},
			updateQuantity: function(context,data){

				return new Promise((resolve,reject)=>{

					axios.patch(`/api/updateCart`,data,{headers: {'Accept': 'application/json','Authorization': 'Bearer '+ context.rootState.token}})
					.then((res)=>{
						context.commit('updateQuantity',res.data.cart)
						resolve(res)
					})
					.catch((err)=>{
						console.log(err)
						reject(err)
					})

				})
			},
			removeItem: function(context,data){
		
				return new Promise((resolve,reject)=>{
						axios.delete(`/api/removeCart/${data.id}`,{headers: {'Accept': 'application/json','Authorization': 'Bearer '+ context.rootState.token}})
						.then((res)=>{
							resolve(res)
						})
						.catch((err)=>{
							console.log(err)
							reject(err)
						})
				})
			},
			getwishlist: function(context){
				axios.get('/api/getwishlist',{headers: {'Accept': 'application/json','Authorization': 'Bearer '+ context.rootState.token}})
				.then((res)=>{
					context.commit("setWishlist",res.data.list)
				}).catch((err)=>{
					console.log(err)
				})
			},
			addtowish: function(context,data){

				return new Promise((resolve,reject)=>{
					axios.post(`/api/addtowishlist`,data,{headers: {'Accept': 'application/json','Authorization': 'Bearer '+ context.rootState.token}})
					.then((res)=>{
						resolve(res)
					}).catch((err)=>{
						reject(err)
					})
				})
			},
			addtocart: function(context,data){

				//console.log(context.rootState.user)
				if(context.rootState.user == 'guest'){
					// alert('You must login first')
				}else{
					// context.commit("addItems",data)
			
					let itemdata = {
						product_id: data.id,
					}						

					return new Promise((resolve,reject)=>{
						axios.post(`/api/addtocart`,data,{headers: {'Accept': 'application/json','Authorization': 'Bearer '+ context.rootState.token}})
						.then((res)=>{
							context.commit('addItems',res.data.cartdetails)
							resolve(res)
						}).catch((err)=>{
							reject(err)
						})
					})
				}

				// return new Promise((resolve,reject)=>{

				// })
				// context.commit("addItems",data)
			},

			getItems: function(context,data){
				return new Promise((resolve,reject)=>{

					axios.post(`/api/getCart`,null,{headers: {'Accept': 'application/json','Authorization': 'Bearer '+ context.rootState.token}})
					.then((res)=>{
						context.commit('updateitems',res.data.cart)
						resolve(res)
					})
					.catch((err)=>{
						console.log(err)
						reject(err)
					})


				})
			}
		},
		getters: {
			getCart: function(state){
				return state.items
			},

			computeTotal: function(state){
				let total = 0
				state.items.forEach((item)=>{
					total += (item.quantity * item.product.price)
				})

				return total
			}
		},
		mutations: {
			removeWishlist: function(state,index){
				state.wishlists.splice(index,1)
			},
			setWishlist: function(state,data){
				state.wishlists = data
			},
			updateQuantity: function(state,data){
					for(let item of state.items){
						if(item.product.id === data[0].product_id && item.user_id === data[0].user_id){
							item.quantity = data[0].quantity
							break
						}
						
					}
			},
			updateitems: function(state,data){
				state.items = data
			},
			addItems: function(state,data){
				// console.log(data[0])
				// state.items.push(data[0])
				// console.log(state.items)
	
				if(state.items.length > 0){
					let res = 0;
					for(let item of state.items){
						if(item.product.id === data[0].product_id && item.user_id === data[0].user_id){
							item.quantity = item.quantity + 1
							res = 1
							break
						}
						res = 0
					}

					if(!res){
							state.items.push(data[0])
					}
				}else{
					state.items.push(data[0])
				}


				
			}
		}
}