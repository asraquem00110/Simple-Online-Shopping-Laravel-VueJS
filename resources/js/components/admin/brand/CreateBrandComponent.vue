<template>
	<div class="">

	
			<span class="pageheader"><i class="fa fa-plus"></i> Create Brand</span><hr/>
		<div class="panel" id="userpanel">
			<div class="panel-header panel-primary">
				
			</div>

			<div class="panel-body">
					<span v-if="message != ''">{{message.message}}</span><hr/>
					<label>Brand</label>
					<input type="text" class="form-control" v-model="brand">
					<span ref="branderror"></span>
				</div>
			</div>
			
			<button @click="saveNewBrand" class="btn btn-primary pull-right"><span class="fa fa-check"></span> Save</button>
			<router-link :to="{name: 'brandlist'}"><button class="btn btn-default pull-left"><span class="fa fa-times"></span> Back</button></router-link>
		

	</div>


</template> 

<script>


import path from '../../../config/path'
	
	export default {
		data: function() {
			return {
				brand: '',
				message: '',
			}
		},
		methods: {
			saveNewBrand: function(){
				let app = this
				let fd = new FormData()

				fd.append('brand',this.brand)

				axios.post(`/api/saveBrand`,fd,{headers: {'Accept': 'application/json','Authorization': 'Bearer '+ this.$store.state.token}})
					.then((res)=>{
						if(res.data.errors){
							app.$refs.branderror.innerHTML = res.data.errors.brand
							app.$refs.branderror.style.color = 'maroon'
						}else{
							app.message = res.data
							app.brand = "";
							app.$refs.branderror.innerHTML = ''
						}
					})
					.catch((res)=>{
						console.log(res)
					})
			}
		},
		mounted(){
			require('../../../adminresponsive')
		}
	}

</script>