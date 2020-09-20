<template>

	<div class="">

	
			<span class="pageheader"><i class="fa fa-plus"></i> Update Category</span><hr/>
		<div class="panel" id="userpanel">
			<div class="panel-header panel-primary">
				
			</div>

			<div class="panel-body">
					<span v-if="message != ''">{{message.message}}</span><hr/>
					<label>Category</label>
					<input type="text" class="form-control" v-model="category">

				</div>
			</div>
			
			<button @click="UpdateCategory" class="btn btn-primary pull-right"><span class="fa fa-check"></span> Save</button>
			<router-link :to="{name: 'categorylist'}"><button class="btn btn-default pull-left"><span class="fa fa-times"></span> Back</button></router-link>
		

	</div>



</template>

<script>
import path from '../../../config/path'
	export default {
		data: function(){
			return {
				category: '',
				message: '',
				idno: 0,
			}
		},
		methods: {
			UpdateCategory: function(){
				let app = this

				let category = {
					'idno': app.idno,
					'category': app.category,
				}

				axios.patch(`/api/UpdateCategory`,category,{headers: {'Accept': 'application/json','Authorization': 'Bearer '+ this.$store.state.token}})
				.then((res)=>{
				
						if(res.data.message == 'Successfully Updated!'){
							alert(res.data.message)
							// app.$router.push('/admin/category')
							app.$router.replace('/admin/category')
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

			axios.get(`/api/getCategory/${id}`,{headers: {'Accept': 'application/json','Authorization': 'Bearer '+ this.$store.state.token}})
				.then((res)=>{
					app.category = res.data[0].category
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