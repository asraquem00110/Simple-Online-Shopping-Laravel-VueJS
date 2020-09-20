<template>
	<div class="">
				<span class="pageheader"><i class="fa fa-cubes"></i> Brand(s) List</span><hr/>
		<div class="panel" id="userpanel">
			<div class="panel-header panel-primary">
				<router-link :to="{name: 'newbrand'}"><button class="btn btn-default"><span class="fa fa-plus"></span> New Brand</button></router-link>
			</div>

			<div class="panel-body">
				

				<table class="table table-bordered table-striped">
					<thead>
						<tr style="background: dimgray;color: white;">
							<th>#</th>
							<th>Brand</th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						
						<tr v-for="(brand,index) in brands" :key="index">
							<td>{{index+1}}</td>
							<td>{{brand.brand}}</td>
							<td><router-link :to="{name: 'editBrand',params : {idno: brand.id}}" class="btn btn-warning"> Edit</router-link></td>
							<td><button @click="removeBrand(index)" class="btn btn-danger"><span class="fa fa-trash"></span> Delete</button></td>
							
						</tr>
						
					</tbody>

				</table>
					

			</div>

		</div>

</div>
</template>

<script>
	
	import path from '../../../config/path'

	export default {
		data:function(){
			return {
				brands: [],
			}
		},
		created(){
			let app = this
			axios.get(`/api/getBrands`,{headers: {'Accept': 'application/json','Authorization': 'Bearer '+ this.$store.state.token}})
			.then((res)=>{
				app.brands = res.data.brands.data
				console.log(app.brands)
			})
			.catch((res)=>{
				console.log(res)
			})
		},
		methods: {
			removeBrand: function(index){
				let app = this
	
				if(confirm("Are you sure you want to remove this brand?")){
				
					axios.delete(`/api/removeBrand/${app.brands[index].id}`,{headers: {'Accept': 'application/json','Authorization': 'Bearer '+ this.$store.state.token}})
					.then((res)=>{
						console.log(res.data.message)
						app.brands.splice(index,1)
						
					})
					.catch((res)=>{
						console.log(res)
					})
				}
			}
		},
		mounted(){
			require('../../../adminresponsive')
		}
	}

</script>