<template>




		<div id="mainSection" style="margin-top: 80px;">
			<headernav></headernav>
			<div class="grid-container" style="margin-top:50px;padding: 20px;">

				<InfoComponent></InfoComponent>
				<OrderComponent v-if="showorder" :showdetails.sync="showdetails" @showDetailComponent="showDetailComponent"></OrderComponent>
				<DetailsComponent v-if="showdetails" :order="order" @closeComponent="closeComponent"></DetailsComponent>

			</div>

		</div>






</template>


<script>
import headernav from '../shop/HeaderComponent'
import InfoComponent from './InfoComponent'
import OrderComponent from './OrderComponent'
import DetailsComponent from './DetailsComponent'

export default {

	data: function(){
		return {
			showorder: true,
			showdetails: false,
			order: {},
		}
	},
	methods: {
		showDetailComponent: function(order){
			this.order = order
			this.showdetails = true
			this.showorder = false
		},
		closeComponent: function(){
			this.order = {}
			this.showdetails = false
			this.showorder = true

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
	components: {InfoComponent,headernav,OrderComponent,DetailsComponent}

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

