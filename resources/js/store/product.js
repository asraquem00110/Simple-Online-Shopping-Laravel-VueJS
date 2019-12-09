import path from '../config/path'

export default {
	namespaced: true,
	state: {
		product_products: [],
		product_categories: [],
		product_brands: [],
		sortproduct: 'ALL PRODUCTS',

		pagination: {}
		
	},
	actions: {
		sortbySearch: function(context,data){

			return new Promise((resolve,reject)=>{
			
				axios.get(`/api/getBySearch/${data}`)
				.then((res)=>{
					console.log(res.data.products.data)
					context.commit('product_Sort', {sort: 'SORT BY SEARCH', products: res.data})
					console.log(res)
				})
				.catch((err)=>{
					console.log(err)
					reject(err)
				})
			})

		},
		sortbyCategory: function(context,data){
			return new Promise((resolve,reject)=>{

				axios.get(`/api/getByCategory/${data.id}`)
				.then((res)=>{
					console.log(res.data.products.data)
					context.commit('product_Sort', {sort: 'SORT BY CATEGORY', products: res.data})
					resolve(res)
				})
				.catch((err)=>{
					console.log(err)
					reject(err)
				})

			})
		},

		sortbyBrand: function(context,data){
			return new Promise((resolve,reject)=>{

				axios.get(`/api/getByBrand/${data.id}`)
				.then((res)=>{
					console.log(res.data.products.data)
					context.commit('product_Sort', {sort: 'SORT BY BRAND', products: res.data})
					resolve(res)
				})
				.catch((err)=>{
					console.log(err)
					reject(err)
				})

			})
		},

		product_getCategories: function(context,data){
		  return new Promise((resolve,reject)=>{
		  		axios.get(`/api/getCategories`)
				.then((res)=>{
					context.commit('product_SetCategories',res.data)
					resolve(res)
				}).catch((err)=>{
					reject(err)
				})
		  })
		
		},
		product_getBrands: function(context,data){
				  return new Promise((resolve,reject)=>{
				  		axios.get(`/api/getBrands`)
						.then((res)=>{
							context.commit('product_SetBrands',res.data)
							resolve(res)
						}).catch((err)=>{
							reject(err)
						})
				  })
		},

		product_getProducts: function(context,data){
				 return new Promise((resolve,reject)=>{
				  	axios.get(`/api/getProducts`)
						.then((res)=>{
							context.commit('product_SetProducts',res.data)
							resolve(res)
						})
						.catch((err)=>{
							reject(err)
						})
				  })
		},

		paginateData: function(context,data){
				 return new Promise((resolve,reject)=>{
				  	axios.get(`${data}`)
						.then((res)=>{
							context.commit('product_SetProducts',res.data)
							resolve(res)
						})
						.catch((err)=>{
							reject(err)
						})
				  })
		}	
	},
	mutations: {
		product_Sort: function(state,data){
			state.product_products = data.products.products.data
			state.sortproduct = data.sort
			state.pagination = data.products.products
		},

		product_SetCategories: function(state,data){
			state.product_categories = data.categories.data
		},
		product_SetBrands: function(state,data){
			state.product_brands = data.brands.data
		},
		product_SetProducts: function(state,data){
			state.product_products = data.products.data
			state.pagination = data.products
		}
	},
	getters: {
		product_CategoryList: function(state){
			return state.product_categories
		},
		product_BrandList:function(state){
			return state.product_brands
		},
		product_ProductList:function(state){
			return state.product_products
		},
		product_sort: function(state){
			return state.sortproduct
		},
		product_pagination: function(state){
			return state.pagination
		}
	}

}