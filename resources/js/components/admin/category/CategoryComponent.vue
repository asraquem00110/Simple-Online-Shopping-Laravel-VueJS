<template>
	<div class="">
				<span class="pageheader"><i class="fa fa-cubes"></i> Category(s) List</span><hr/>
		<div class="panel" id="userpanel">
			<div class="panel-header panel-primary">
				<router-link :to="{name: 'createCategory'}"><button class="btn btn-default"><span class="fa fa-plus"></span> New Category</button></router-link>
			</div>

			<div class="panel-body">
				

				<table class="table table-bordered table-striped">
					<thead>
						<tr style="background: dimgray;color: white;">
							<th>#</th>
							<th>Category</th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						
						<tr v-for="(category,index) in categories" :key="index">
							<td>{{index+1}}</td>
							<td>{{category.category}}</td>
							<td><router-link :to="{name: 'editCategory',params : {idno: category.id}}" class="btn btn-warning"> Edit</router-link></td>
							<td><button @click="removeCategory(index)" class="btn btn-danger"><span class="fa fa-trash"></span> Delete</button></td>
							
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
		data(){
			return {
				categories: [],
			}
		},
		created(){
			let app = this
			axios.get(`/api/getCategories`,{headers: {'Accept': 'application/json','Authorization': 'Bearer '+ this.$store.state.token}})
			.then((res)=>{
				app.categories = res.data.categories.data
				console.log(app.categories)
			})
			.catch((res)=>{
				console.log(res)
			})
		},
		methods: {
			removeCategory: function(index){
				let app = this
	
				if(confirm("Are you sure you want to remove this category?")){
				
					axios.delete(`/api/removeCategory/${app.categories[index].id}`,{headers: {'Accept': 'application/json','Authorization': 'Bearer '+ this.$store.state.token}})
					.then((res)=>{
						console.log(res.data.message)
						app.categories.splice(index,1)
						
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