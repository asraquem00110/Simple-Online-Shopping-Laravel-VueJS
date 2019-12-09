<template>

	<div id="logindiv" class="grid-container">

	<div id="systemname" class="grid-col-6" style="position:relative;">
		<div >
		<h1>Simple Ecommerce using Laravel + Vue js</h1>
		</div>
	</div>


	<div id="logindetails" class="grid-col-6" style="position:relative;">
			<div class="loginform" style="background: transparent !important;text-align:center;">

			<!-- 	<img :src="logosample" :style="logostyle"> -->

	<input class="login form-control" type="email" name="email" v-model="email">
	<br/>
	<span ref="emailerror" :style="errorstyle"></span><br/>
	<input class="login form-control" type="password" name="password" v-model="password">
	<br/>
	<span ref="passworderror" :style="errorstyle"></span><br/>
	<button id="loginbutton" class="login form-control" @click="login" type="button">Login</button>



	</div>


	</div>

</div>




</template>

<script>

	import '../css/sample.css'; 
	export default {
		data: function(){
			return {
					email: 'admin@gmail.com',
					password: '123123',
					logosample: '../../../upload/LOGOsample.png',
					logostyle: {
						'height': '150px',
						'width': '200px',
						'text-align': 'center',
					},
					errorstyle: {
						'color': 'maroon',
					}			
			}
		},
		methods:{
			login: function(){
				let user = {
					email: this.email,
					password: this.password,
				}

				this.$store.dispatch('login',user)
				.then((res)=>{

					if(res.data.errors){
						this.$refs.emailerror.innerHTML = res.data.errors.email ? res.data.errors.email : ''
						this.$refs.passworderror.innerHTML = res.data.errors.password ? res.data.errors.password : ''
					}

					if(res.data.access_token){
						 this.$router.push({name: 'adminindex'})
						//window.location.href= "/admin"
					}
					
				}).catch((err)=>{
					console.log(err)
				})
			},
			logout: async function(){

				try{
					await this.$store.dispatch('logout')
					this.$router.push({name: 'adminlogin'})
						//window.location.href= "/admin/login"
				}catch(err){
					console.log(err)
					throw err
				}
				
			}
		
		},
		computed: {

		},
		created(){

			  
		},
		mounted(){

		}

	}
	
</script>

<style lang="scss">
// $value: 10px;
// $border: 5px;

// .login {
// padding: $value;
// 	margin: $value;
// 	border-radius: $border;

// }

// .loginform {
// 	position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);
// }

.form-control {
	border-radius: 2px;
}

$paddingLR: 80px;
$radius: 10px;

#systemname div h1 {
	color: white;
	font-size: 20pt;
	font-weight: bold;
}

#systemname div , .loginform {
	// padding: 220px $paddingLR 0px $paddingLR;
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%,-50%);
}


button#loginbutton {
	background: #3071A9;
	color: white;
}

		#logindiv {
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%,-50%);
			height: 60%;
			width: 60%;
			background: black;
			border-radius: 20px;
		}

		#systemname {
		
			background: #3071A9;
			// border-top-left-radius: 20px;
			// border-bottom-left-radius: 20px;
		}

		#logindetails{
			
			background: #DDDDDD;
			// border-top-right-radius: 20px;
			// border-bottom-right-radius: 20px;
		}

		.grid-container{
			grid-gap: 0;
		}

		@media (max-width: 1000px){
			#systemname {
				display: none;
			}

			#logindetails {
				grid-column: span 12 
			}
		
		}


</style>