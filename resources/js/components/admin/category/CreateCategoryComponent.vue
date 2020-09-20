<template>

	<div class="">

	
			<span class="pageheader"><i class="fa fa-plus"></i> Create Category</span><hr/>
		<div class="panel" id="userpanel">
			<div class="panel-header panel-primary">
				
			</div>

			<div class="panel-body">
					<span v-if="message != ''">{{message.message}}</span><hr/>
					<label>Category</label>
					<input type="text" class="form-control" v-model="category">
					<span ref="categoryerror"></span>
				</div>
			</div>
			
			<button @click="saveNewCategory" class="btn btn-primary pull-right"><span class="fa fa-check"></span> Save</button>
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
			}
		},
		methods: {
			saveNewCategory: function(){
				let app = this

				let fd = new FormData()
				fd.append('category',app.category)
				axios.post(`/api/SaveCategory`,fd,{headers: {'Accept': 'application/json','Authorization': 'Bearer '+ this.$store.state.token}})
				.then((res)=>{
					if(res.data.errors){
							app.$refs.categoryerror.innerHTML = res.data.errors.category
							app.$refs.categoryerror.style.color = 'maroon'
					}else{
						app.message = res.data
						app.category = ""
						app.$refs.categoryerror.innerHTML = ''
					}
					
					
				})
				.catch((res)=>{
					console.log(res);
				})
			}
		},
		mounted(){
			let app = this;
				require('../../../adminresponsive')
		}
	}
	
</script>