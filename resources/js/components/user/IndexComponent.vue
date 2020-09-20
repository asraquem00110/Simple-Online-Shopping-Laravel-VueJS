<template>




		<div id="mainSection" style="margin-top: 80px;">
			<headernav></headernav>
			<div class="grid-container" style="margin-top:50px;padding: 20px;">

				<InfoComponent :showwishlist="showwishlist" :showorder="showorder" :showcart="showcart" @displaywish="displaywish" @displaycart="displaycart"  @displayorder="displayorder"></InfoComponent>
				<OrderComponent v-if="showorder" :showdetails.sync="showdetails" @showDetailComponent="showDetailComponent"></OrderComponent>
				<DetailsComponent v-if="showdetails" :order="order" @closeComponent="closeComponent"></DetailsComponent>
				<CartComponent v-if="showcart" @closeComponent="closeComponent"></CartComponent>
				<wishComponent v-if="showwishlist" @closeComponent="closeComponent"></wishComponent>
			</div>

		</div>






</template>


<script>
import headernav from '../shop/HeaderComponent'
import InfoComponent from './InfoComponent'
import OrderComponent from './OrderComponent'
import DetailsComponent from './DetailsComponent'
import CartComponent from './cartComponent'
import wishComponent from './wishComponent'

export default {

	data: function(){
		return {
			showorder: true,
			showdetails: false,
			showcart: false,
			showwishlist: false,
			order: {},
		}
	},
	methods: {
		displaycart: function(result){
			this.showcart = result
			this.showdetails = false
			this.showorder = false
			this.showwishlist = false
		},
		displayorder: function(result){
			this.showorder = result
			this.showcart = false
			this.showdetails = false
			this.showwishlist = false
		},
		displaywish: function(result){
			this.showwishlist = result
			this.showorder = false
			this.showcart = false
		},	
		showDetailComponent: function(order){
			this.order = order
			this.showdetails = true
			this.showorder = false
		},
		closeComponent: function(){
			this.order = {}
			this.showdetails = false
			this.showorder = true
			this.showcart = false
			this.showwishlist = false

		}
	},

	mounted(){
			// require('../../shopresponsive')
			// let app = this
			// if(app.$route.params.idno){
			// 	alert('test')
			// }else{
			// 	alert('ggwp')
			// }
	},
	components: {InfoComponent,headernav,OrderComponent,DetailsComponent,CartComponent,wishComponent}

}

</script>


<style>

@media (max-width: 800px) and (min-width: 100px){
.grid-col-4, .grid-col-8 {
	grid-column: span 12 !important;
	padding: 0 !important;
	margin: 0 !important;
	width: 100% !important;
}

.icondisplay {
	grid-column: span 4 !important;
}

}

</style>

