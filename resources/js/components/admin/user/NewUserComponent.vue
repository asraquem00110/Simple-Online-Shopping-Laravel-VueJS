<template>

<div class="">

	
			<span class="pageheader"><i class="fa fa-plus"></i> Create User</span><hr/>
		<div class="panel" id="userpanel">
			<div class="panel-header panel-primary">
				&nbsp;
			</div>

			<div class="panel-body">
				<span v-if="message != ''">{{message.message}}</span><hr/>
					<label>Fullname</label>
					<input type="text" class="form-control" v-model="name">
					<span ref="nameerror" :style="errorstyle"></span><br/>

					<label>EmailAdd</label>
					<input type="email" class="form-control" v-model="email">
					<span ref="emailerror" :style="errorstyle"></span><br/>

					<label>Address</label>
					<input type="text" class="form-control" v-model="address">
					<span ref="addresserror" :style="errorstyle"></span><br/>

					<label>Contact</label>
					<input type="text" class="form-control" v-model="contact">
					<span ref="contacterror" :style="errorstyle"></span><br/>

					<label>Type</label>
					<select class="form-control" v-model="type">
						<option value="1">Admin</option>
						<option value="0">Customer</option>
					</select>

					<label>Password</label>
					<input type="password" class="form-control" v-model="password">
					<span ref="passworderror" :style="errorstyle"></span><br/>

					<label>Confirm Password</label>
					<input type="password" class="form-control" v-model="password_confirmation">
					
				</div>


			</div>
			
			<button @click="saveNewUser" class="btn btn-primary pull-right"><span class="fa fa-check"></span> Save</button>
			<a href="javascript:history.back()"><button class="btn btn-default pull-left"><span class="fa fa-times"></span> Back</button></a>
		

	</div>



</template> 


<script>
	import path from '../../../config/path'
	export default {
	     data: function(){
			return {
				name: '',
				email: '',
				password: '',
				password_confirmation: '',
				type: 1,
				contact: '',
				address: '',
				message: '',
				errorstyle: {
					'color': 'maroon',
				}
			}
		},
		methods: {
			saveNewUser: function(){
				let user = {
					name: this.name,
					email: this.email,
					password: this.password,
					password_confirmation: this.password_confirmation,
					type: this.type,
					address: this.address,
					contact: this.contact,
				}

				axios.post(`/api/saveNewUser`,user,{headers: {'Accept': 'application/json','Authorization': 'Bearer '+ this.$store.state.token}})
				.then((res)=>{
					console.log(res)

					if(res.data.errors){
						this.$refs.nameerror.innerHTML = res.data.errors.name ? res.data.errors.name : ''
						this.$refs.emailerror.innerHTML = res.data.errors.email ? res.data.errors.email : ''
						this.$refs.addresserror.innerHTML = res.data.errors.address ? res.data.errors.address : ''
						this.$refs.passworderror.innerHTML = res.data.errors.password ? res.data.errors.password : ''
						this.$refs.contacterror.innerHTML = res.data.errors.contact ? res.data.errors.contact : ''
					}else{
						if(this.type == 1){
							this.$router.replace({name: 'adminlist'})
						}else{
							this.$router.replace({name: 'customerlist'})
						}
					}
				})
				.catch((err)=>{
					console.log(err)
				})
			}
		},
		mounted(){
			require('../../../adminresponsive')
		}
	}

</script>