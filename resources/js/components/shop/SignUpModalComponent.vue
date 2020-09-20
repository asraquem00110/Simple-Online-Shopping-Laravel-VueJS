<template>

	<div class="modal" id="signUpModal">
			<div class="modal-content" style="width: 50% !important;">
			<span class="close-modal" ref="closemodal">&times;</span>
			<div class="modal-body" style="padding-bottom: 40px;">

					<input v-model="user.name" type="text" name="" class="form-control" placeholder="Fullname">
					<span ref="nameerror" :style="errorstyle"></span><br/>
					<input v-model="user.email" type="email" name="" class="form-control" placeholder="Emailadd">
					<span ref="emailerror" :style="errorstyle"></span><br/>
					<input v-model="user.address" type="text" name="" class="form-control" placeholder="Address">
					<span ref="addresserror" :style="errorstyle"></span><br/>
					<input v-model="user.contact" type="text" name="" class="form-control" placeholder="Contact No">
					<span ref="contacterror" :style="errorstyle"></span><br/>
					<input v-model="user.password" type="password" name="" class="form-control" placeholder="Password">
					<span ref="passworderror" :style="errorstyle"></span><br/>
					<input v-model="user.password_confirmation" type="password" name="" class="form-control" placeholder="Confirm Password">
					<span :style="errorstyle"></span><br/>

					<a href="javascript:void(0)" @click="saveuser"><button class="btn btn-primary pull-right"><span class="fa fa-check"></span> SAVE</button></a>

			</div>

		</div>

	</div>

</template>

<script>


	export default {
		data: ()=>{
			return {
				user: {
					name: '',
					email: '',
					password: '',
					password_confirmation: '',
					address: '',
					contact: '',
				},
				errorstyle: {
					'color': 'maroon',
				}
			}
		},
		methods: {
			saveuser: async function(){
				let app = this
				let saveres = await app.$store.dispatch('register',this.user)

				if(saveres.data.errors){
				
					app.$refs.nameerror.innerHTML = saveres.data.errors.name ? saveres.data.errors.name : ''
					app.$refs.emailerror.innerHTML = saveres.data.errors.email ? saveres.data.errors.email : ''
					app.$refs.addresserror.innerHTML = saveres.data.errors.address ? saveres.data.errors.address : ''
					app.$refs.contacterror.innerHTML = saveres.data.errors.contact ? saveres.data.errors.contact : ''
					app.$refs.passworderror.innerHTML = saveres.data.errors.password ? saveres.data.errors.password : ''

				}else{
					try{
						let loginres = await this.$store.dispatch('login',{email: this.user.email,password: this.user.password})

						window.location.href = './'
					}catch(err){
						console.log(err)
					}
					
				}

			
			},
			removemodal: function(){
				this.$emit('removemodal')
			}
		},
		mounted(){
			this.$refs.closemodal.onclick = ()=>{
				this.removemodal()
			}

			require('../../shopresponsive')
		}


	}


</script>