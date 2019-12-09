<template>
	<div class="">

			<span class="pageheader"><i class="fa fa-edit"></i> Update Product</span><hr/>
		<div class="panel" id="userpanel">
			<div class="panel-header panel-primary">
				&nbsp;
			</div>

			<div class="panel-body">
					  <div v-if="success != ''" class="alert alert-success" role="alert">

                          {{success}}

                        </div>

					  <img :src="product.img" style="width: 200px;height: 200px;" @click="$refs.imgFile.click()"><br/>
					  <span ref="imgerror" :style="errorstyle"></span><br/>
					   <input type="file" style="display:none;" class="form-control" v-on:change="onFileChange" ref="imgFile">

					<label>Product</label>
					<input type="text" class="form-control" v-model="product.name">
					<span ref="producterror" :style="errorstyle"></span><br/>

					<label>Description</label>
					<textarea class="form-control" v-model="product.description"></textarea>
					<span ref="deserror" :style="errorstyle"></span><br/>

					<label>Category</label>
					<select class="form-control" v-model="product.category">
						<option v-for="(category,index) in categories" :key="index" :value="category.id">{{category.category}}</option>
					</select>
					<span ref="categoryerror" :style="errorstyle"></span><br/>

					<label>Brand</label>
					<select class="form-control" v-model="product.brand">
						<option v-for="(brand,index) in brands" :key="index" :value="brand.id">{{brand.brand}}</option>
					</select>
					<span ref="branderror" :style="errorstyle"></span><br/>
				</div>
			</div>

				<button @click="saveProduct" class="btn btn-primary pull-right"><span class="fa fa-check"></span> Update</button>
				<router-link :to="{name: 'productlist'}"><button class="btn btn-default pull-left"><span class="fa fa-times"></span> Back</button></router-link>
		
			
			
     </div>


</template> 

<script>
	export default {
		data: function(){
			return {
				message: '',
				product: {
					name: '',
					description: '',
					category: '',
					brand: '',
					img: '../../../upload/plus.png',
					imgfile: '',
				},
				categories: [],
				brands: [],
				success: '',
				errorstyle: {
					'color': 'maroon',
				}
			}
		},
		methods: {
			 onFileChange: function(e){

                let files = e.target.files;

                if(files.length == 0){
                    console.log("empty");
                }else{
                    let reader = new FileReader();
                    reader.onload = (e)=> {
                            this.product.img = e.target.result
                        }

                        reader.readAsDataURL(files[0]);
                }

                this.product.imgfile = e.target.files[0];

            },
            saveProduct: function(e){
            	e.preventDefault()
            	let app = this
            	const config = {
                        headers: { 'content-type': 'multipart/form-data','Accept': 'application/json','Authorization': 'Bearer '+ this.$store.state.token }
                }

            	let fd = new FormData

            	fd.append("product",app.product.name)
            	fd.append("description",app.product.description)
            	fd.append("category",app.product.category)
            	fd.append("brand",app.product.brand)
            	fd.append("imgfile",app.product.imgfile)

            	axios.post('/api/saveProduct',fd,config)
            		.then((res)=>{	
            			console.log(res.data.errors)
            			console.log(app.$refs)
            			if(res.data.errors){
            					app.$refs.imgerror.innerHTML = res.data.errors.imgfile ? res.data.errors.imgfile : ''
            					app.$refs.producterror.innerHTML = res.data.errors.product ? res.data.errors.product : ''
            					app.$refs.deserror.innerHTML = res.data.errors.description ? res.data.errors.description : ''
            					app.$refs.categoryerror.innerHTML = res.data.errors.category ? res.data.errors.category : ''
            					app.$refs.branderror.innerHTML = res.data.errors.brand ? res.data.errors.brand : ''
            				
            			}else{
            			  app.success = res.data.success;
            			  app.product.name = ''
            			  app.product.description = ''
            			  app.product.category = ''
            			  app.product.brand = ''
            			  app.product.imgfile = ''
            			  app.product.img = ''

            			  app.$refs.imgerror.innerHTML = app.$refs.producterror.innerHTML = app.$refs.deserror.innerHTML = app.$refs.categoryerror.innerHTML = app.$refs.branderror.innerHTML = ''
            			}


            			 
            		})
            		.catch((res)=>{
            			  app.success = res;
            		})
            },
            getCategories: function(){
            	let app = this

            	axios.get('/api/getCategories')
				.then((res)=>{
					app.categories = res.data.categories.data
				})
				.catch((res)=>{
					console.log(res)
				})
            },
            getBrands: function(){
            	let app = this
				axios.get('/api/getBrands')
				.then((res)=>{
					app.brands = res.data.brands.data
				})
				.catch((res)=>{
					console.log(res)
				})
            }
		},
		created(){
			this.getCategories()
			this.getBrands()
		},
		mounted(){
			require('../../../adminresponsive')
		}

	}
	

</script>