<template>
				<div id="displaydiv">
					<slot></slot>
					<div class="grid-container" style="grid-template-columns: repeat(12,1fr);margin-left: 10px;">
						<div class="productitem grid-col-4" v-for="(product,index) in products">
							<div class="panel">
								<div class="panel-header panel-primary">
									<span class="panel-title">{{product.product}}</span>
								</div>
								<div class="panel-body">
										<div class="product" style="text-align: center !important;">
										
										<img :src="'./upload/'+product.img" style="width: 70% !important;">
								
										<span>P {{product.price.toFixed(2)}}</span>
											<button @click="addtocart(product)" title="Add to Cart"><i class="fa fa-cart-plus"></i> ADD TO CART</button>
										</div>
								</div>
							</div>
						</div>	

				
				
					</div>
					

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

export default {
	data: function(){
			return {
				imagesrc: 
				[
					'./ashop/img/camera.jpg',
					'./ashop/img/12039452_525963140912391_6353341236808813360_n.png',
				],

				prev_disable: false,
				next_disable: false,

			
			}
	},
	methods: {
			// ...mapActions('cart',[
			// 		'addtocart',

			// 	]),

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