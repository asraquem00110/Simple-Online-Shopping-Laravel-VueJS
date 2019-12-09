<template>

<div>

		<div id="mainContent">
		
			<div id="productsDiv">

					<navigator></navigator>
					<products>	
						<small style="margin:10px;font-weight:bold;color:dimgray;">{{sort}}</small>
					</products>

			</div>

		</div>

</div>


</template>


<script>

	import navigator from './NavigatorComponent.vue';	
	import products from './ProductComponent.vue';

	export default {

		computed: {
			sort: function(){
				return this.$store.getters['product/product_sort']
			}
		},

		created(){
			let app = this
			app.$store.dispatch('product/product_getProducts')
			app.$store.dispatch('product/product_getCategories')
			app.$store.dispatch('product/product_getBrands')
			
		},	
		mounted(){
			require('../../shopresponsive')

		},
		components: {navigator,products},
	}


</script>

