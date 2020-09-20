<template>
				<div id="displaydiv">
					<slot></slot>
					<div class="grid-container" style="grid-template-columns: repeat(12,1fr);margin-left: 10px;">
						<div class="productitem grid-col-4" v-for="(product,index) in products" :key="index">
							<div class="panel">
								<div class="panel-header panel-primary">
									<span class="panel-title"></span>
								</div>
								<div class="panel-body">
										<div class="product" style="text-align: center !important;">
										
										<img @click="productInfo(product)" :src="'./upload/'+product.img" style="width: 70% !important;">
										<span style="color:dimgray;">{{product.product}}</span><hr/>
										<small>{{product.description}}</small><br/>
										<small>{{product.brand.brand}}</small>
										<span>P {{product.price.toFixed(2)}}</span>
											<div class="grid-container">

												<div class="grid-col-6">
												<button @click="addtowish(product)" title="Add to Cart"><i class="fa fa-heart"></i> </button>
												</div>

												<div class="grid-col-6">
												<button @click="addtocart(product)" title="Add to Cart"><i class="fa fa-cart-plus"></i> </button>
												</div>
											</div>
										</div>
								</div>
							</div>
						</div>	

				
				
					</div>

					<productInfoModal :info="productinfo" v-if="showinfo" @removemodal="removemodal"/>
					

					<small style="margin-left: 10px;font-weight:bold;color:dimgray;">Showing {{product_pagination.from}} to {{product_pagination.to}} of {{product_pagination.total}} entries</small>
 					<div class="paginationx">



						<button v-if="product_pagination.prev_page_url" class="prevpage"  @click="paginateData(product_pagination.prev_page_url)">PREV</button>
						<button v-else  class="prevpage" disabled>PREV</button>



						<button v-if="product_pagination.next_page_url" class="nextpage" @click="paginateData(product_pagination.next_page_url)">NEXT</button>
						<button v-else class="nextpage" disabled>NEXT</button>
					</div>
				</div>

</template>

<script>

import { mapGetters,mapActions,mapState,mapMutations } from 'vuex'
import productInfoModal from "./productInfoModal"
export default {
	components: {productInfoModal},
	data: function(){
			return {
				imagesrc: 
				[
					'./ashop/img/camera.jpg',
					'./ashop/img/12039452_525963140912391_6353341236808813360_n.png',
				],

				prev_disable: false,
				next_disable: false,
				showinfo: false,
				productinfo: {}
			
			}
	},
	methods: {
			// ...mapActions('cart',[
			// 		'addtocart',

			// 	]),
			removemodal: function(){
				this.showinfo = false
			},
			productInfo: function(product){
				this.productinfo = product
				this.showinfo = true
				
			},
			addtowish: function(data){
					this.$store.dispatch('cart/addtowish',data).then((res)=>{
						if(res){
							this.$toastr.Add({
								name: 'addtoCartMessage',
								title: 'Wishlist Message',
								msg: 'Added to Wish List Successfully!',
								timeout: 1000,
								progressbar: false,
								type: 'success',
								style: { backgroundColor: "green"},
								// position: "toast-top-full-width",
							})
						}

					}).catch((err)=>{
						if(err.response.status == 401){
									this.$toastr.Add({
								name: 'addtoCartMessage',
								title: 'Authentication',
								msg: 'You must Login First',
								timeout: 3000,
								progressbar: false,
								type: 'error',
								style: { backgroundColor: "maroon"},
								position: 'toast-top-center',
							})
						}
					})
			},
			addtocart: function(data){
				this.$store.dispatch('cart/addtocart',data).then((res)=>{
					if(res){
							this.$toastr.Add({
								name: 'addtoCartMessage',
								title: 'Cart Message',
								msg: 'Added to Cart Successfully!',
								timeout: 1000,
								progressbar: false,
								type: 'success',
								style: { backgroundColor: "green"},
								// position: "toast-top-full-width",
							})
					}else{
							this.$toastr.Add({
								name: 'addtoCartMessage',
								title: 'Authentication',
								msg: 'You must Login First',
								timeout: 3000,
								progressbar: false,
								type: 'error',
								style: { backgroundColor: "maroon"},
								position: 'toast-top-center',
							})

					}


						
				})
				.catch((err)=>{

				})
			},

			...mapActions('product',[
					'paginateData',
				])
	},
	computed: {
			products: function(){
				return this.$store.state.product.product_products
			},

			...mapGetters('product',[
					'product_pagination',
					
				])

		
	},
	created(){
		// let app = this
		// app.$store.dispatch('product/product_getProducts')
	},
	mounted(){
		
	},
}


</script>