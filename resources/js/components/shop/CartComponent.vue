<template>

<div class="mainSection">
	<headernav></headernav>
		<div class="col-10" id="cartdiv" style="margin-left: 8%;">
		<div class="panel" style="box-shadow: 3px 2px 2px black">
				<div class="panel-header panel-info">
					<i class="fa fa-cart-plus"></i> MY CART
				</div>
				<div class="panel-body" style="padding-bottom: 70px;">

							<div class="grid-container" style="background:#D9EDF7;color:black;margin:0;padding: 5pt;text-align: center;border-radius: 10px;">
								<div class="grid-col-12">
									<div class="grid-container productcart">
								

										<div class="grid-col-2">
											Image
										</div>

										<div class="grid-col-3">
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

										<div class="grid-col-1">
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

											<div class="grid-col-3" style="text-align:left !important;">
												{{item.product.product}}<hr/>
												<small>{{item.product.description}}</small>
											</div>

											<div class="grid-col-2">
											<input @change="updateQuantity(index,$event.target.value)" type="number" min="1" class="form-control" :value="item.quantity">
											</div>

											<div class="grid-col-2">
												P {{ item.product.price }}
											</div>

											<div class="grid-col-2">
												P {{ (item.quantity * item.product.price) }}
											</div>

											<div class="grid-col-1">
												<button class="btn btn-danger" @click="removeItem(index)"><span class="fa fa-times"></span> </button>
											</div>

									</div>

										<div class="grid-col-12" style="text-align: left;margin-left: 12px;margin-top: 80px;">
											<span style="color: black;font-size: 12pt;font-weight: bold;background: white;">AMOUNT : P {{computeTotal}}</span>
										</div>

										<div class="grid-col-12" style="text-align: left;margin-left: 12px;">
												<span style="color: black;font-size: 12pt;font-weight: bold;background: white;">DELIVERY CHARGE : P {{deliverycharge}}</span>

										</div>
											<hr/>
										<div class="grid-col-12" style="text-align: left;margin-left: 12px;">
											<span style="color: maroon;font-size: 14pt;font-weight: bold;background: white;">TOTAL: P {{(computeTotal+deliverycharge).toFixed(2)}}</span>
										</div>
										<hr/>


								</div>
							</div>



					<div>
			
			<p class="" style="margin-left: 20px;font-size: 14pt;font-weight:bold">PROCEED TO PAYMENT</p>
			<hr/>

				<div class="col-12 pull-right align-right" id="cartoptions">
					
					<router-link style="margin-right: 20px;" :to="{name: 'index'}" class="pull-left"><button style="border-radius: 50px;padding: 5px 30px;" class="btn btn-primary"><i></i> CONTINUE SHOPPING</button></router-link>
					  <div style="margin-right: 20px;" id="paypal-button" class="pull-left"></div>
					 <a href="javascript:void(0)" class="pull-left" @click="cod = true"><button class="btn btn-warning" style="color: white;border-radius: 50px;padding: 5px 50px;"><i></i> CASH ON DELIVERY</button></a>

				</div>

				</div>
			</div>
		</div>
	</div>

    <div v-if="cod" class="modal" id="cartdiv">
			<div class="modal-content modal-25">
			<span class="close-modal" ref="closemodal">&nbsp;</span>
			<div class="modal-body" style="padding-bottom: 40px;">

		
					<form class="form-horizontal">
						<div class="form-group">
							<label style="margin-left: 15px;font-weight:bold;color:dimgray;">FULL NAME</label>
							<div class="col-md-12">
								<input type="text" name="fullname" class="form-control" v-model="userinfo.name">
								<span ref="nameerror" :style="errorstyle"></span><br/>
							</div>
						</div>

						<div class="form-group">
							<label style="margin-left: 15px;font-weight:bold;color:dimgray;">EMAIL ADDRESS</label>
							<div class="col-md-12">
								<input type="email" name="emailadd" class="form-control" v-model="userinfo.email">
								<span ref="emailerror" :style="errorstyle"></span><br/>
							</div>
						</div>

						<div class="form-group">
							<label style="margin-left: 15px;font-weight:bold;color:dimgray;">CONTACT NO</label>
							<div class="col-md-12">
								<input type="text" name="number" class="form-control" v-model="userinfo.contact">
								<span ref="contacterror" :style="errorstyle"></span><br/>
							</div>
						</div>

						<div class="form-group">
							<label style="margin-left: 15px;font-weight:bold;color:dimgray;">ADDRESS</label>
							<div class="col-md-12">
								<input type="text" name="address" class="form-control" v-model="userinfo.address">
								<span ref="addresserror" :style="errorstyle"></span><br/>
							</div>
						</div>
					</form>
					<button @click="cod =false" class="btn btn-danger pull-left" style="margin-left: 15px;margin-top: 20px;"><i class="fa fa-times"></i> CANCEL</button>
					<button @click="createOrder_COD" class="btn btn-success pull-right" style="margin-right: 15px;margin-top: 20px;"><i class="fa fa-check"></i> PROCEED</button>
			
			</div>

		</div>

	</div>



<!-- 
	<div class="col-10" id="cartdiv" style="margin-left: 8%;" v-if="cod">
	
	</div> -->
</div>

</template>

<script>

	import path from '../../config/path'
	import headernav from '../shop/HeaderComponent'
	import { mapGetters,mapActions,mapState,mapMutations } from 'vuex'
	export default {
		data: function(){
			return {
				cod: false,
				userinfo: {},
				errorstyle: {
					'color': 'maroon',
				},
				deliverycharge: 100,
				imgUrl: this.$store.state.imgUrl
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
			test: function(){
					axios.post(`/api/test`,this.getCart, {headers: { 'Accept': 'application/json','Authorization': 'Bearer '+ this.$store.state.token }})
					.then((res)=>{
						console.log(res)
					})
					.catch((err)=>{
						console.log(err)
					})
			},
			updateQuantity: function(key,pcs){
				this.$store.dispatch("cart/updateQuantity", {product: this.getCart[key], quantity: pcs})
			},
			removeItem: function(key){
				if(confirm("Are you sure you want to remove this item?")){

					// console.log(this.$store.state.cart.items)

					this.$store.dispatch("cart/removeItem",this.items[key]).
					then((res)=>{
						this.items.splice(key,1)
					}).catch((err)=>{
						console.log(err)
					})

				}
			},

			createOrder_COD: function(){

					this.userinfo.items = this.getCart
					
					axios.post(`/api/createOrderCOD`,this.userinfo, {headers: { 'Accept': 'application/json','Authorization': 'Bearer '+ this.$store.state.token }})
					.then((res)=>{
						if(res.data.errors){
								this.$refs.nameerror.innerHTML = res.data.errors.name ? res.data.errors.name : ''
								this.$refs.emailerror.innerHTML = res.data.errors.email ? res.data.errors.email : ''
								this.$refs.contacterror.innerHTML = res.data.errors.contact ? res.data.errors.contact : ''
								this.$refs.addresserror.innerHTML = res.data.errors.address ? res.data.errors.address : ''
						}else{
							this.$store.state.cart.items = []
							this.cod = false
							this.$toastr.Add({
								name: 'addtoCartMessage',
								title: 'Cash On Delivery',
								msg: 'Order Created!',
								timeout: 3000,
								progressbar: false,
								type: 'success',
								style: { backgroundColor: "green"},
								position: "toast-top-full-width",
							})

						}
					})
					.catch((err)=>{
						console.log(err)
					})

			},

			createPayPalOrder: function(paypalres){
				this.userinfo.paypalData = paypalres
				this.userinfo.items = this.getCart
				return new Promise((resolve,reject)=>{

					axios.post(`/api/createOrderPay`,this.userinfo, {headers: { 'Accept': 'application/json','Authorization': 'Bearer '+ this.$store.state.token }})
					.then((res)=>{
							this.$store.state.cart.items = []
							this.$toastr.Add({
								name: 'addtoCartMessage',
								title: 'Paypal Payment',
								msg: 'Order Created!',
								timeout: 3000,
								progressbar: false,
								type: 'success',
								style: { backgroundColor: "green"},
								position: "toast-top-full-width",
							})
					})
					.catch((err)=>{
						reject(err)
					})
				})
			}
		},
		mounted(){
	
			let app = this
			

			 paypal.Button.render({
			        env: 'sandbox', // Or 'production'
			        style: {
			          size: 'medium',
			          color: 'white',
			          shape: 'pill',
			        },
			          onShippingChange: function(data, actions) {
			        // ...
			        },
			        // Set up the payment:
			        // 1. Add a payment callback
			        payment: function(data, actions) {
			          // 2. Make a request to your server

			          app.userinfo.computeTotal = app.computeTotal
			          app.userinfo.deliverycharge = app.deliverycharge
			          return actions.request.post('/api/create-payment', app.userinfo)
			            .then(function(res) {
			              // 3. Return res.id from the response
			              // console.log(res);
			                return res.id;
			            });
			        },
			        // Execute the payment:
			        // 1. Add an onAuthorize callback
			        onAuthorize: async function(data, actions) {
			          // 2. Make a request to your server
			          return actions.request.post('/api/execute-payment', {
			            paymentID: data.paymentID,
			            payerID:   data.payerID
			          })
			            .then(function(paypalres) {

			              app.createPayPalOrder(paypalres).then((res)=>{
			              		console.log(res)
			              })
			              .catch((err)=>{
			              	console.log(err)
			              })
			             
			              // 3. Show the buyer a confirmation message.
			            });
			        }
			      }, '#paypal-button');
		},
		created(){
			this.$store.dispatch('getUserInfo').then((res)=>{
			this.userinfo = res.data
			}).catch((err)=>{
				console.log(err)
			})
		},
		components: {headernav}
	}
</script>