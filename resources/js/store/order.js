import path from '../config/path'

export default {
	namespaced: true,
	state: {

		userorders: {},
		pendingOrder: [],
		forDelivery: [],
		monthlysales: [],
		records: [],
		recordsPagination: {},
	},
	actions: {
		sortAdminbySearch: function(context,data){
			return new Promise((resolve,reject)=>{
			
				axios.get(`/api/AdminorderSearch/${data}`,{headers: {'Accept': 'application/json','Authorization': 'Bearer '+ context.rootState.token}})
				.then((res)=>{
					context.commit('setRecords',{order: res.data.orders})
					console.log(res)
				})
				.catch((err)=>{
					console.log(err)
					reject(err)
				})
			})
		},

		AdminPaginateData: function(context,data){
				 return new Promise((resolve,reject)=>{
				  	axios.get(`${data}`,{headers: {'Accept': 'application/json','Authorization': 'Bearer '+ context.rootState.token}})
						.then((res)=>{
							context.commit('setRecords',{order: res.data.orders})
							resolve(res)
						})
						.catch((err)=>{
							reject(err)
						})
				  })
		},
		sortbySearch: function(context,data){
			return new Promise((resolve,reject)=>{
			
				axios.get(`/api/orderSearch/${data}`,{headers: {'Accept': 'application/json','Authorization': 'Bearer '+ context.rootState.token}})
				.then((res)=>{
					context.commit('setOrders', res.data)
					console.log(res)
				})
				.catch((err)=>{
					console.log(err)
					reject(err)
				})
			})
		},

		paginateData: function(context,data){
				 return new Promise((resolve,reject)=>{
				  	axios.get(`${data}`,{headers: {'Accept': 'application/json','Authorization': 'Bearer '+ context.rootState.token}})
						.then((res)=>{
							context.commit('setOrders',res.data)
							resolve(res)
						})
						.catch((err)=>{
							reject(err)
						})
				  })
		},

		getUserOrders: function(context){

			return new Promise((resolve,reject)=>{
						axios.get(`/api/getUserOrders`,{headers: {'Accept': 'application/json','Authorization': 'Bearer '+ context.rootState.token}})
						.then((res)=>{
							context.commit('setOrders',res.data)
							resolve(res)
						})
						.catch((err)=>{
							reject(err)
							console.log(err)
						})
			})

	

		},

		pendingOrders: function(context){
			return new Promise((resolve,reject)=>{
						axios.get(`/api/getPendingOrders`,{headers: {'Accept': 'application/json','Authorization': 'Bearer '+ context.rootState.token}})
						.then((res)=>{
							context.commit('setPendingOrders',{order: res.data.orders})
							resolve(res)
						})
						.catch((err)=>{
							reject(err)
							console.log(err)
						})
			})
		},


		deliveryOrders: function(context){
			return new Promise((resolve,reject)=>{
						axios.get(`/api/getDeliveryOrders`,{headers: {'Accept': 'application/json','Authorization': 'Bearer '+ context.rootState.token}})
						.then((res)=>{
							context.commit('setDeliveryOrders',{order: res.data.orders})
							resolve(res)
						})
						.catch((err)=>{
							reject(err)
							console.log(err)
						})
			})
		},
		getRecords: function(context){
			return new Promise((resolve,reject)=>{
						axios.get(`/api/getRecords`,{headers: {'Accept': 'application/json','Authorization': 'Bearer '+ context.rootState.token}})
						.then((res)=>{
							context.commit('setRecords',{order: res.data.orders})
							resolve(res)
						})
						.catch((err)=>{
							reject(err)
							console.log(err)
						})
			})
		},
		getMonthlySales: function(context){

			return new Promise((resolve,reject)=>{
						axios.get(`/api/monthlysales`,{headers: {'Accept': 'application/json','Authorization': 'Bearer '+ context.rootState.token}})
						.then((res)=>{
							console.log(res)
							context.commit('setMonthlysales',res.data)
							resolve(res)
						})
						.catch((err)=>{
							reject(err)
							console.log(err)
						})
			})

		},
	},
	getters: {
		UserOrders: function(state){
			return state.userorders
		}
	},
	mutations: {
		setOrders: function(state,data){
			state.userorders = data.orders
		},
		setPendingOrders: function(state,data){
			state.pendingOrder = data.order
		},

		setDeliveryOrders: function(state,data){
			state.forDelivery = data.order
		},
		setRecords: function(state,data){
			state.records = data.order.data
			state.recordsPagination = data.order
		},
		setMonthlysales: function(state,data){
			state.monthlysales = data
			console.log(state.monthlysales)
		}
	
	}
}