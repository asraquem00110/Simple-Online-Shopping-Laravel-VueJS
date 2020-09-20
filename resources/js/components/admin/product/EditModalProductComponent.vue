<template>
	<div class="modal" id="addModal">
			<div class="modal-content modal-50">
			<span class="close-modal" ref="closemodal">&times;</span>
			<div class="modal-body" style="padding-bottom: 40px;">

				  <img :src="'../upload/'+passProduct.img" style="width: 200px;height: 200px;" @click="$refs.imgFile.click()"><br/>
				   <span ref="imgerror" :style="errorstyle"></span><br/>
					   <input type="file" style="display:none;" class="form-control" v-on:change="onFileChange" ref="imgFile">
				<label>Product</label>
					<input type="text" class="form-control" v-model="passProduct.product">
					<span ref="producterror" :style="errorstyle"></span><br/>

					<label>Description</label>
					<textarea class="form-control" v-model="passProduct.description"></textarea>
					<span ref="deserror" :style="errorstyle"></span><br/>


					<label>Price</label>
					<input type="text" class="form-control" v-model="passProduct.price"></input>
					<span ref="priceerror" :style="errorstyle"></span><br/>

					<label>Category</label>
					<select class="form-control" v-model="passProduct.category.category">
						<option v-for="(category,index) in product_CategoryList" :key="index" :value="category.category">{{category.category}}</option>
					</select>
					<span ref="categoryerror" :style="errorstyle"></span><br/>

					<label>Brand</label>
					<select class="form-control" v-model="passProduct.brand.brand">
						<option v-for="(brand,index) in product_BrandList" :key="index" :value="brand.brand">{{brand.brand}}</option>
					</select>
					<span ref="branderror" :style="errorstyle"></span><br/>

					<button style="margin-bottom: 20px;" @click="udpateProduct" class="btn btn-primary pull-right"><span class="fa fa-check"></span> Update</button>


	</div>

</div>

</div>


</template>


<script>
import path from '../../../config/path'
import { mapGetters,mapActions,mapState,mapMutations } from 'vuex'

export default {
	data: function (){
		return {
				passProduct: JSON.parse(JSON.stringify(this.product)),
				// passProduct:  Object.assign({},this.product),
				success: '',
				imgfile: '',
				oldimg: '',
				errorstyle: {
					'color': 'maroon',
				}
		}
	},
	props: {
		product: {
			type: Object,
			required: true,
		},

	},
	methods: {	

		 onFileChange: function(e){

                let files = e.target.files;

                if(files.length == 0){
                    console.log("empty");
                }else{
                    let reader = new FileReader();
                    reader.onload = (e)=> {
                    		this.oldimg = this.passProduct.img
                            this.passProduct.img = e.target.result
                        }

                        reader.readAsDataURL(files[0]);
                }

                this.imgfile = e.target.files[0];

            },
		removemodal:function(){
			 this.$emit('removemodal')
		},

		udpateProduct:function(){
		
			let category = this.product_Category.filter((categ)=>{
				return categ.category == this.passProduct.category.category
			})

			let brand = this.product_Brand.filter((brand)=>{
				return brand.brand == this.passProduct.brand.brand
			})

			let formData = new FormData()

			formData.append('product', this.passProduct.product)
			formData.append('description', this.passProduct.description)
			formData.append('price',this.passProduct.price)
			formData.append('category', category[0]['id'])
			formData.append('brand', brand[0]['id'])
			formData.append('imgfile',this.imgfile)
			formData.append('oldimg',this.oldimg)
			formData.append('id',this.passProduct.id)


			axios.post(`/api/updateProduct`,formData,{headers: { 'Content-Type': 'multipart/form-data','Accept': 'application/json','Authorization': 'Bearer '+ this.$store.state.token}})
				.then((res)=>{
				  if(res.data.errors){
            					let app = this
            					app.$refs.producterror.innerHTML = res.data.errors.product ? res.data.errors.product : ''
            					app.$refs.deserror.innerHTML = res.data.errors.description ? res.data.errors.description : ''
            					app.$refs.categoryerror.innerHTML = res.data.errors.category ? res.data.errors.category : ''
            					app.$refs.branderror.innerHTML = res.data.errors.brand ? res.data.errors.brand : ''
            					app.$refs.priceerror.innerHTML = res.data.errors.price ? res.data.errors.price : ''
            				
            	  }else{
					this.$emit('udpateProductdetails',this.passProduct)
			        this.removemodal()	
			  	  }

				})
				.catch((res)=>{
					console.log(res);
				})

			


		},




	},
	computed: {
		// passProduct: function(){
		// 	return this.product
		// },
		 	...mapGetters("product",[
			        'product_CategoryList',
			        'product_BrandList'
			      ]),

			      ...mapState('product',{
			     	product_Category: state => state.product_categories,
			     	product_Brand: state => state.product_brands,
			     })

			  

	},
	watch: {
		// passProduct: function(newval){
		// 	this.product = newval
		// 	console.log(newval)
		// }
	},
	created() {
			let app =this
			app.$store.dispatch("product/product_getCategories")
			app.$store.dispatch("product/product_getBrands")
		
	},
	mounted(){
		this.$refs.closemodal.onclick = ()=>{
			this.removemodal()
		}

		
	}

}


</script>