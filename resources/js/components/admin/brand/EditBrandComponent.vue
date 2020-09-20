<template>

	<div class="">

	
			<span class="pageheader"><i class="fa fa-plus"></i> Update Brand</span><hr/>
		<div class="panel" id="userpanel">
			<div class="panel-header panel-primary">
				
			</div>

			<div class="panel-body">
					<span v-if="message != ''">{{message.message}}</span><hr/>
					<label>Brand</label>
					<input type="text" class="form-control" v-model="brand">

				</div>
			</div>
			
			<button @click="UpdateBrand" class="btn btn-primary pull-right"><span class="fa fa-check"></span> Save</button>
			<router-link :to="{name: 'brandlist'}"><button class="btn btn-default pull-left"><span class="fa fa-times"></span> Back</button></router-link>
		

	</div>



</template>

<script>
import path from '../../../config/path'

	export default {
		data: function(){
			return {
				brand: '',
				message: '',
				idno: 0,
			}
		},
		methods: {
			UpdateBrand: function(){
				let app = this

				let brand = {
					'idno': app.idno,
					'brand': app.brand,
				}

				axios.patch(`/api/UpdateBrand`,brand,{headers: {'Accept': 'application/json','Authorization': 'Bearer '+ this.$store.state.token}})
				.then((res)=>{
				
						if(res.data.message == 'Successfully Updated!'){
							alert(res.data.message)
							// app.$router.push('/admin/category')
							app.$router.replace('/admin/brand')
						}

				})
				.catch((res)=>{
					console.log(res);
				})
			}
		},
		created(){
			let app = this
			let id = app.$route.params.idno
			app.idno = id

			axios.get(`/api/getBrand/`+ id,{headers: {'Accept': 'application/json','Authorization': 'Bearer '+ this.$store.state.token}})
				.then((res)=>{
					
					console.log(res)
					app.brand = res.data[0].brand
				})
				.catch((res)=>{
					console.log(res)
				})
		},
		mounted(){
			require('../../../adminresponsive')
		
		}
	}
	
</script>