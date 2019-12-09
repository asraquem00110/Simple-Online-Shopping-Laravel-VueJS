<template>



<div class="">
				<span class="pageheader"><i class="fa fa-exclamation-circle"></i> Pending Order(s) List</span><hr/>

			<ListComponent v-if="showList" :orders="pendingorder" @showDetail="showDetail"></ListComponent>
			<div v-if="showdetail">
					<DetailComponent :order="order" @closeComponent="closeComponent"></DetailComponent>
					<hr/>
					<div class="grid-container">
						<div class="grid-col-3">
					<button class="form-control btn btn-primary" @click="UpdateStatus">For Delivery</button>
				</div>
			</div>
			</div>

</div>



</template>

<script>
	import ListComponent from './ListComponent'
	import DetailComponent from '../../user/DetailsComponent'
	import path from '../../../config/path'
	import {mapState} from 'vuex'
	export default {
		data: function(){
			return {
				showList: true,
				showdetail: false,
				order: {},
			}
		},
		computed: {
			...mapState('order',{
			'pendingorder': state=> state.pendingOrder,
			})
		},
		methods: {
			showDetail:function(data){
				this.order = data
				this.showdetail = true
				this.showList = false
			},
			closeComponent: function(){
			this.order = {}
			this.showdetail = false
			this.showList = true

		},
		UpdateStatus: function(){
			if(confirm("For Delivery?")){
				axios.post(`/api/updatePendingOrder`, this.order,{headers: {'Accept': 'application/json','Authorization': 'Bearer '+ this.$store.state.token}})
				.then((res)=>{
					console.log(res)
					this.order.status = 1
					this.$store.dispatch('order/pendingOrders')
					this.$store.dispatch('order/deliveryOrders')
				}).catch((err)=>{

				})
				
			}
		}

		},
		mounted(){
			require('../../../adminresponsive')
			this.$store.dispatch('order/pendingOrders')
		},
		components: {ListComponent,DetailComponent}
	}

</script>