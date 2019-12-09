<template>

<div class="">
				<span class="pageheader"><i class="fa fa-user"></i> Update Information(s) of {{userinfo.email}}</span><hr/>

				<span v-if="message != ''">{{message}}</span><hr/>

					<div class="panel" id="userpanel">
			<div class="panel-header panel-primary">
				&nbsp;
			</div>

			<div class="panel-body" style="padding-bottom:50px;">
				
					<label>Fullname</label>
					<input type="text" class="form-control" v-model="userinfo.name">
					<span ref="nameerror" :style="errorstyle"></span><br/>

					<!-- <label>EmailAdd</label>
					<input type="email" class="form-control" v-model="userinfo.email"> -->
					<span ref="emailerror" :style="errorstyle"></span>

					<label>Address</label>
					<input type="text" class="form-control" v-model="userinfo.address">
					<span ref="addresserror" :style="errorstyle"></span><br/>

					<label>Contact No</label>
					<input type="text" class="form-control" v-model="userinfo.contact">
					<span ref="contacterror" :style="errorstyle"></span><br/>

					<label>Type</label>
					<select class="form-control" v-model="userinfo.userType">
						<option value="1">Admin</option>
						<option value="0">Customer</option>
					</select>

						<button @click="updateUser" class="btn btn-primary pull-right"><span class="fa fa-check"></span> Update</button>
						<a href="javascript:history.back()"><button class="btn btn-default pull-left"><span class="fa fa-times"></span> Back</button></a>
							</div>


			</div>

			<hr/>

		<div class="panel" id="userpanel">
			<div class="panel-header panel-primary">
				<span style="color:white;">CHANGE PASSWORD</span>
			</div>

			<div class="panel-body"  style="padding-bottom:50px;">
				<label>Password</label>
					<input type="password" class="form-control" v-model="password">
					<span ref="passworderror" :style="errorstyle"></span><br/>

					<label>Confirm Password</label>
					<input type="password" class="form-control" v-model="password_confirmation">
					

					<button @click="changePassword" class="btn btn-primary pull-right"><span class="fa fa-check"></span> Change</button>

			</div>
		</div>
</div>



</template>

<script>
	
	import path from '../../../config/path'
	export default {
		data: function(){
			return {
				userinfo: {},
				message: '',
				password: '',
				password_confirmation: '',
				errorstyle: {
					'color': 'maroon',
				},
			}
		},
		methods: {
			updateUser: function(){
				let idno = this.$route.params.idno

				let user = {
					id: idno,
					name: this.userinfo.name,
					email: this.userinfo.email,
					address: this.userinfo.address,
					contact: this.userinfo.contact,
					type: this.userinfo.userType,
				}

					axios.patch(`/api/updateUser`,user,{headers: {'Accept': 'application/json','Authorization': 'Bearer '+ this.$store.state.token}})
				.then((res)=>{
					// this.message = res.data.message

					if(res.data.errors){
						this.$refs.nameerror.innerHTML = res.data.errors.name ? res.data.errors.name : ''
						this.$refs.emailerror.innerHTML = res.data.errors.email ? res.data.errors.email : ''
						this.$refs.addresserror.innerHTML = res.data.errors.address ? res.data.errors.address : ''
						this.$refs.passworderror.innerHTML = res.data.errors.password ? res.data.errors.password : ''
						this.$refs.contacterror.innerHTML = res.data.errors.contact ? res.data.errors.contact : ''
					}else{
						alert(res.data.message)
						this.getUserInformation(user.id)
					}
					
				})
				.catch((err)=>{
					console.log(err)
				})

			},
			changePassword: function(){
				let idno = this.$route.params.idno

				let user = {
					id: idno,
					password: this.password,
					password_confirmation: this.password_confirmation,
				}

				axios.patch(`/api/changePassword`,user,{headers: {'Accept': 'application/json','Authorization': 'Bearer '+ this.$store.state.token}})
				.then((res)=>{
					// this.message = res.data.message

					if(res.data.errors){
						this.$refs.passworderror.innerHTML = res.data.errors.password ? res.data.errors.password : ''
					}else{
						alert(res.data.message)
						this.$refs.passworderror.innerHTML = ""
						this.password = ""
						this.password_confirmation = ""
					}
					
				})
				.catch((err)=>{
					console.log(err)
				})
			},

			getUserInformation: function(idno){
						axios.get(`/api/getUserInfo/${idno}`,{headers: {'Accept': 'application/json','Authorization': 'Bearer '+ this.$store.state.token}})
						.then((res)=>{
							this.userinfo = res.data.user
						})
						.catch((err)=>{
							console.log(err)
						})
			}

		},
		created(){
			let app = this

			let idno = app.$route.params.idno
		
			this.getUserInformation(idno)
		
		},
		mounted(){
			require('../../../adminresponsive')
			
		}
	}

</script>