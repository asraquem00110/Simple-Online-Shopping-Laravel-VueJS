<template>
	<div class="">
				<span class="pageheader"><i class="fa fa-cubes"></i> Product(s) List</span><hr/>
		<div class="panel" id="userpanel">
			<div class="panel-header panel-primary">
				<router-link :to="{name: 'createProduct'}"><button class="btn btn-default"><span class="fa fa-plus"></span> New Product</button></router-link>
			</div>

			<div class="panel-body">
				<input v-model="search" type="text" placeholder="Search via name..." class="form-control" style="width: 50% !important">
				<div style="overflow-x:auto;">
				<table class="table table-bordered table-striped">
					<thead>
						<tr style="background: dimgray;color: white;">
							<th>Image</th>
							<th>Name</th>
							<th>Description</th>
							<th>Price</th>
							<th>Category</th>
							<th>Brand</th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(product,index) in products" :key="index">
							<td style="text-align:center"><img :src="'../upload/'+product.img" style="height:100px;width:100px;" /></td>
							<td>{{product.product}}</td>
							<td>{{product.description}}</td>
							<td>{{product.price}}</td>
							<td>{{product.category.category}}</td>
							<td>{{product.brand.brand}}</td>
							<td><button @click="showmodal(index)" class="btn btn-warning"><span class="fa fa-edit"></span> Edit</button></td>
							<td><button @click="removeProduct(index)" class="btn btn-danger"><span class="fa fa-trash"></span> Remove</button></td>
						</tr>
					</tbody>

				</table>
			</div>
				<small style="margin-left: 10px;font-weight:bold;color:dimgray;">Showing {{product_pagination.from}} to {{product_pagination.to}} of {{product_pagination.total}} entries</small>
					<div class="paginationx">
					<button v-if="product_pagination.prev_page_url" class="prevpage"  @click="paginateData(product_pagination.prev_page_url)">PREV</button>
						<button v-else  class="prevpage" disabled>PREV</button>



						<button v-if="product_pagination.next_page_url" class="nextpage" @click="paginateData(product_pagination.next_page_url)">NEXT</button>
						<button v-else class="nextpage" disabled>NEXT</button>
					</div>

			</div>

		</div>

		<EditModal v-if="modal.editProduct" :product="product" @removemodal="closeModal" @udpateProductdetails="udpateProductdetails"></EditModal>


</div>
</template>

<script>
	import path from '../../../config/path'
	import EditModal from './EditModalProductComponent.vue'
	import { mapGetters,mapActions,mapState,mapMutations } from 'vuex'

	export default {
		data: function(){
			return {
				// products: [],
				modal: {
					editProduct: false,
				},
				product: {},
				editkey: null,
				search: '',
				doneTypingInterval: 500,
				typingmessage: '',
				typingTimer: '',
			}
		},
		watch: {
			search: function(newval,oldval){

				clearTimeout(this.typingTimer)
				if(newval.length > 0){
					this.typingTimer = setTimeout(()=>{
					this.$store.dispatch('product/sortbySearch',newval)

					},this.doneTypingInterval)
				}else{
					this.$store.dispatch('product/product_getProducts')
					
				}


				
			}
		},
		methods: {
			removeProduct: function(key){
				 let app = this
				 // setTimeout(()=>{
 				// 	app.products[key].description = "ggggggwwwww"
				 // },2000)
				
				 if(confirm("Are you sure you want to remove this?")){
				 	axios.delete(`/api/removeProduct/${app.products[key].id}`,{headers: {'Accept': 'application/json','Authorization': 'Bearer '+ this.$store.state.token}})
					.then((res)=>{
						console.log(res.data.message)
						app.products.splice(key,1)
					})
					.catch((res)=>{
						console.log(res)
					})
				 }

				
			},
			showmodal: function(index){
				this.product = this.products[index]
				this.editkey = index
				this.modal.editProduct = true
			},
			closeModal: function(){
				this.product = {}
				this.editkey = null
				Object.keys(this.modal).forEach((key)=>{
					this.modal[key] = false
				})
				
			},
			udpateProductdetails: function(newdata){
				this.products[this.editkey] = newdata
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
			let app = this
			app.$store.dispatch('product/product_getProducts')

			
		},
		mounted(){
			require('../../../adminresponsive')
		},
		components: {EditModal}
	}

</script>