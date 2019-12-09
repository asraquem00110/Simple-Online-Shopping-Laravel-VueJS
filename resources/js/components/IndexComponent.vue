<template>

<div>
	<headernav></headernav>

	<div class="mainSection">
			<div id="categoryDiv">

		<input type="text" name="" placeholder="searchproduct" v-model="searchproduct">
		<button><i class="fa fa-search"></i></button>
		
		<select @change="sortitem($event.target.value)" ref="categoryselect" class="form-control categoryselect" style="font-size: 13pt;color: gray;display:none;">
			<option></option>
			<option disabled style="background: dimgray;color: white;">CATEGORIES</option>
			<option v-for="(category,index) in product_CategoryList" :key="'category'+index" :value="'c'+index">{{category.category}}</option>
			<option disabled style="background: dimgray;color: white;">BRANDS</option>
			<option v-for="(brand,index) in product_BrandList" :key="'brand'+index" :value="'b'+index">{{brand.brand}}</option>
		</select>
	</div>
			<maincontent></maincontent>

	</div>

</div>

</template>

<script>
	
	import headernav from './shop/HeaderComponent.vue';
	import maincontent from './shop/MainComponent.vue';

	import { mapGetters,mapActions,mapState,mapMutations } from 'vuex'


	export default {
		data: function(){
			return {
				searchproduct: '',
				typingTimer: '',
				doneTypingInterval: 500,
				typingmessage: '',
			}
		},
		computed: {
			...mapGetters('product',[
					"product_CategoryList",
					"product_BrandList",
				]),

			...mapState('product',{
					sort: state => state.sortproduct,
			}),
		},
		watch: {
			searchproduct: function(newval,oldval){

				clearTimeout(this.typingTimer)
				this.typingmessage = "is typing"
				if(newval.length > 0){
					this.typingTimer = setTimeout(()=>{
						this.$store.dispatch('product/sortbySearch',newval)
						this.typingmessage = ""
					},this.doneTypingInterval)
				}else{
					this.$store.dispatch('product/product_getProducts')
						// this.$store.state.product.sortproduct = 'ALL PRODUCTS'
						this.$router.replace({name: 'index'})
						this.typingmessage = ""
				}


				
			}
		},
		methods: {
			sortitem: function(val){
				if(val[0]=="c"){
					this.$store.dispatch('product/sortbyCategory', this.product_CategoryList[val.substr(1)])
				}else{
					this.$store.dispatch('product/sortbyBrand',this.product_BrandList[val.substr(1)])
				}
			},

			match:function(x){
				if(x.matches){
					this.$refs.categoryselect.style.display = "none"
				}else{
					this.$refs.categoryselect.style.display = "block"
				}
			}
		},
		created(){

		},
		mounted(){


					var x = window.matchMedia("(min-width: 801px)");
					this.match(x);
					x.addListener(this.match);
		},
		components: {headernav,maincontent},
	}

</script>