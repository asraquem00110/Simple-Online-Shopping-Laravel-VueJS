<template>
	
<div>
		<signupmodal v-if="modal.signup" @removemodal="closeModal"></signupmodal>

	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" style="background: rgba(0,0,0,0.7) !important;">
  <a class="navbar-brand" href="javascript:void(0)" @click="gotodashboard()"><img src="http://ashopping.herokuapp.com/upload/LOGOsample.png" height="60px" width="100px" /></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto" style="padding: 10px;">
      <li class="nav-item">
    <!--    <router-link class="nav-link" :to="{name: 'index'}" ><i class="fa fa-home"></i></router-link> -->
    <a class="nav-link" href="javascript:void(0)" @click="homepage"><i class="fa fa-home"></i></a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="javascript:void(0)" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-cart-plus"></i> <span style="position:absolute; top: -5px;background: green; border-radius: 10px;padding: 3.5px; color: white;">{{getCart.length}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="">
        	

						<div v-if="isLogIn != 'guest'" style="padding-top: 20px;">
								<div class="grid-container" style="background:#D9EDF7;color:black;margin:0;padding: 5pt;text-align: center;border-radius: 10px;">
								<div class="grid-col-12">
									<div class="grid-container productcart">
								

										<div class="grid-col-2">
											Image
										</div>

										<div class="grid-col-4">
											 Product
										</div>

										<div class="grid-col-2">
											Quantity
										</div>

										<div class="grid-col-2">
											Price
										</div>


										<div class="grid-col-2">
											Amount
										</div>

									</div>
								</div>
							</div>


							<div class="grid-container">
								<div class="grid-col-12" style="margin-top:10px;padding: 5pt;text-align: center;border-radius: 10px;">
									<div v-for="(item,index) in getCart" class="grid-container productcart" :key="index">
									
									
											
									
											<div class="grid-col-2">
												<img :src="imgUrl+ item.product.img" style="height: 50px;width: 50px;">
											</div>

											<div class="grid-col-4" style="text-align:left !important;">
												{{item.product.product}}<hr/>
												<small>{{item.product.description}}</small>
											</div>

											<div class="grid-col-2">
												{{item.quantity}}
											</div>

											<div class="grid-col-2">
												P {{ item.product.price }}
											</div>

											<div class="grid-col-2">
												P {{ (item.quantity * item.product.price) }}
											</div>

									</div>


										<div class="grid-col-12" style="text-align: center;">
											<span style="color: maroon;font-size: 14pt;font-weight: bold;background: white;">TOTAL: P {{computeTotal.toFixed(2)}}</span>
										</div>


										<div class="grid-col-12" style="margin-top: 30px;">
											<router-link :to="{name: 'cart'}"><button class="form-control btn btn-primary"><span class="fa fa-cart-plus"></span> View Cart</button></router-link>
										</div>

								</div>
							</div>

							</div>

							<div v-else style="padding-top: 20px;">
							You must Login First :)
							
							</div>


        </div>
      </li>

       <li class="nav-item dropdown" >
        <a class="nav-link dropdown-toggle" href="javascript:void(0)" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="">
         
        		<div v-if="isLogIn != 'guest'" style="padding-top: 20px;">
        						<div class="grid-container">
									<div class="grid-col-12" style="text-align:center">

										<!-- <img src="upload/default.png"/> -->
										<img :src="imgUrl+userinfo.img" style="width:150px;height:100px;margin-bottom: 20px;">
										<p style="margin:0;padding:0;">{{userinfo.name}}</p>
										<p style="margin:0;padding:0;">{{userinfo.email}}</p>
										

									</div>

							</div>
							<hr/>
							<div class="col-md-12">
								<div class="col-md-6">
							<router-link :to="{name: 'userprofile'}"><button class="btn btn-primary form-control" style="background: #3071A9"><span class="fa fa-edit"></span> ORDERS</button></router-link>
						</div>
									<div class="col-md-6">
							<a href="javascript:void(0)" @click="logout"><button class="btn btn-default form-control" style="background: #DDDDDD"><span class="fa fa-power-off"></span> LOGOUT</button></a>
						</div>
							</div>
							

        		</div>

        		<div v-else style="padding-top: 20px;padding-left: 50px;padding-right: 50px;">
        			
							<input v-model="user.email" type="email" name="" class="form-control" placeholder="Emailadd">
							<span ref="emailerror" :style="errorstyle"></span><br/>
							<input v-model="user.password" type="password" name="" class="form-control" placeholder="Password">
							<span ref="passworderror" :style="errorstyle"></span><br/>
							
							

							<div class="col-md-12">
								<div class="col-md-6">
							<a href="javascript:void(0)" @click="login"><button class="btn btn-primary form-control">LOGIN</button></a>
						</div>
									<div class="col-md-6">
							<a href="javascript:void(0)" @click="showSignupModal"><button class="btn btn-default form-control" style="background: #DDDDDD">SIGN UP</button></a>
						</div>
							</div>
							
						

        		</div>

        </div>
      </li>
     <!--  <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li> -->
    </ul>
  </div>
</nav>
</div>

</template>

<style>
	.dropdown-menu {
		height: 500px !important;
		width: 500px !important;
		overflow-y: auto;
		float: left;
		padding: 0px 20px;
	}
	.nav-item {
		margin-left: 10px;
	}
	.nav-link {
		color: white !important;
		font-size: 12pt;
	}
</style>

<script>

	import { mapGetters,mapActions,mapState,mapMutations } from 'vuex'
	import signupmodal from './SignUpModalComponent.vue'
	export default {
		data: function(){
			return {
				isLogIn: this.$store.state.user,
				userinfo: {},
				user: {
					email: '',
					password: '',
				},
				componentKey: 0,
				errorstyle: {
					'color': 'maroon',
				},
				modal: {
					signup: false,
				},
				imgUrl: this.$store.state.imgUrl,
			}
		},
		computed: {
			...mapState('cart',{
				items: state => state.items,
			}),

			...mapGetters('cart',[
					'getCart',
					'computeTotal',
				]),
		},
		methods: {

			...mapActions('cart',[
					'addtocart',
			]),

			gotodashboard: function(){
				if(this.isLogIn != 'guest') this.$router.push({name: 'userprofile'})
			},

			homepage: function(){
				this.$store.dispatch('product/product_getProducts')
				this.$store.state.product.sortproduct = 'ALL PRODUCTS'
				this.$router.replace({name: 'index'})

			},

			showSignupModal: function(e){
				// e.stopPropagation()
				this.modal.signup = true
			},
			closeModal: function(e){

				Object.keys(this.modal).forEach((key)=>{
					this.modal[key] = false
				})
				
				
			},

			login: function(e){
				e.stopPropagation()
				let app = this
				app.$store.dispatch('login',app.user)
				.then((res)=>{
					if(res.data.errors){
						app.$refs.emailerror.innerHTML =res.data.errors.email ? res.data.errors.email : ''
            			app.$refs.passworderror.innerHTML = res.data.errors.password ? res.data.errors.password : ''
					}


					if(res.data.message){
						app.$refs.emailerror.innerHTML =res.data.message ? res.data.message : ''
						app.$refs.passworderror.innerHTML = ''
					}

					if(res.data.access_token){
					 // this.forceRerender()
					 window.location.href = './'
					}

					
					
				}).catch((err)=>{
					console.log(err)
				})
			},
			logout: async function(){

				try{
					await this.$store.dispatch('logout')
					// this.forceRerender()
					window.location.href = '/'
				}catch(err){
					console.log(err)
					throw err
				}
				
			},
			 forceRerender() {
			      this.componentKey += 1
			  }
		},
		created(){
				this.$store.dispatch('getUserInfo').then((res)=>{
					this.userinfo = res.data
				}).catch((err)=>{
					console.log(err)
				})

				this.$store.dispatch('cart/getItems').then((res)=>{

				}).catch((err)=>{

				})
		},
		mounted(){
			
			

		},
	
		components: {signupmodal}
	}

</script>
