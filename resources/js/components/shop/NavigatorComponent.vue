<template>

<div id="productdiv">
					 <ul>
					 	<li style="background: #3071A9;color:white;padding: 5pt;"><span style="font-size: 18pt;">CATEGORIES</span></li>
					 	<li v-for="(category,index) in product_CategoryList" :key="'category'+index"><a href="javascript:void(0)" style="color:dimgray;font-weight:bold;font-family: calibri" @click="sortitem('category',index)">{{category.category}}</a></li>
					 	<li style="background: #3071A9;color:white;padding: 5pt;"><span style="font-size: 18pt;">BRANDS</span></li>
					 	<li v-for="(brand,index) in product_BrandList" :key="'brand'+index"><a href="javascript:void(0)"  style="color:dimgray;font-weight:bold;font-family: calibri" @click="sortitem('brand',index)">{{brand.brand}}</a></li>
					 </ul>
				</div>
</template>


<script>

	import { mapGetters,mapActions,mapState,mapMutations } from 'vuex'

	export default {
		methods: {
			sortitem: function(type,key){
				if(type=="category"){
					this.$store.dispatch('product/sortbyCategory',this.product_CategoryList[key])
				}else{
					this.$store.dispatch('product/sortbyBrand',this.product_BrandList[key])
				}

			}
		},
		computed: {
			...mapGetters('product',[
					"product_CategoryList",
					"product_BrandList",
				]),
		},
		mounted(){
			require('../../shopresponsive')
		}
	}

</script>