<template>

	<div class="grid-col-8" style="box-sizing:border-box;box-shadow: 2px 2px 2px black">
			<div class="panel">
			<div class="panel-header panel-default">
					<span class="panel-title">&nbsp;</span>
			</div>
			<div class="panel-body" style="overflow-x:auto;">
		
						<table class="table table-bordered">
					<thead>
						<tr>
						
							<th style="width:100px;">IMAGE</th>
							<th>PRODUCT INFO</th>
							<th style="width:100px;"></th>
					

						</tr>

					</thead>

					<tbody>
						<tr v-for="(item,index) in wishlists" :key="index">
							<td><img :src="imgUrl+ item.product.img" style="height: 100px;width: 100px;"></td>
							<td>{{item.product.product}}<hr/>
								<small>{{item.product.description}}</small>
							</td>
							<td><a @click="remove(index)" style="color:maroon;" href="javascript:void(0)">Remove</a></td>
						</tr>
					</tbody>
				</table>


            </div>
           </div>
       </div>
</template>

<script>
import {mapState} from 'vuex'
export default {
	data: function(){
		return {
			      imgUrl: this.$store.state.imgUrl
		}
	},
	methods: {
		remove: function(index){
			if(confirm("remove this from list?")){
				let data = this.wishlists[index]
				data.index = index
				this.$store.dispatch("cart/removewishlist",data)
			}
		}
	},
	computed: {
		...mapState('cart',[
			'wishlists'
		])
	},
    mounted(){
		this.$nextTick(()=>{
			this.$store.dispatch("cart/getwishlist")
		})
	}
}
</script>