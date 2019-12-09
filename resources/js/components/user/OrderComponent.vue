
<template>

	<div class="grid-col-8" style="box-sizing:border-box;box-shadow: 2px 2px 2px black">
			<div class="panel">
			<div class="panel-header panel-default">
					<span class="panel-title">&nbsp;</span>
			</div>
			<div class="panel-body" style="overflow-x:auto;">
				<div class="col-md-4" style="padding: 0;margin:0"><input v-model="searchorder" type="text" class="form-control" placeholder="SEARCH VIA ORDER # ..." name=""></div>
		
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
						
							<th>ORDER #</th>
							<th>ORDER DATE</th>
							<th>PAYMENT</th>
							<th>STATUS</th>
					

						</tr>

					</thead>

					<tbody>
						
						<tr v-for="(order,index) in UserOrders.data" :key="index">
							
							<td><button @click="showDetailComponent(order)" style="color:green;font-weight:bold" class="form-control">{{ order.id}}</button></td>
							<td>{{ setDate(order.created_at)}}</td>
							<td>{{ order.payment }}</td>
							<td :style="checkstatuscolor(order.status)">{{ checkstatus(order.status)}}</td>
							

						</tr>


					</tbody>

				</table>
		
			</div>
		</div>

			<small style="margin-left: 10px;font-weight:bold;color:dimgray;">Showing {{UserOrders.from}} to {{UserOrders.to}} of {{UserOrders.total}} entries</small>
 					<div class="paginationx">



						<button v-if="UserOrders.prev_page_url" class="prevpage"  @click="paginateData(UserOrders.prev_page_url)">PREV</button>
						<button v-else  class="prevpage" disabled>PREV</button>



						<button v-if="UserOrders.next_page_url" class="nextpage" @click="paginateData(UserOrders.next_page_url)">NEXT</button>
						<button v-else class="nextpage" disabled>NEXT</button>
					</div>


	</div>

</template>
<style>


</style>
<script>
	import { mapGetters,mapActions,mapState,mapMutations } from 'vuex'
export default {

	data: function(){
		return {
			monthNames: ["January", "February", "March", "April", "May", "June","July", "August", "September", "October", "November", "December"],
			searchorder: '',
			doneTypingInterval: 500,
			typingTimer: '',
			statusStyle: {
					color: '',
				}
		}
	},
	props: {
		showdetails: {
			type: Boolean,
		}
	},
	computed: {
		...mapGetters('order',[
				'UserOrders'
			]),

		
	},

	watch: {
		searchorder: function(newval,oldval){
			clearTimeout(this.typingTimer)
			if(newval){
					this.typingTimer = setTimeout(()=>{
						this.$store.dispatch('order/sortbySearch',newval)
				},this.doneTypingInterval)
			}else{
				this.getUserOrders()
				this.$router.replace({name: 'userprofile'})
			}
		}
	},

	methods: {
		...mapActions('order',[
				'getUserOrders',
				'paginateData',
			]),

		setDate: function(rawdate){
			let newDate = new Date(rawdate)
			return `${this.monthNames[newDate.getMonth()-1]} ${newDate.getDay()}, ${newDate.getFullYear()}`
		},

		checkstatus: function(status){
				let statuscomment = ""
				if(status == 0){
					statuscomment = 'Pending'
				}else if(status == 1){
					statuscomment = 'For Delivery'
				}else{
					statuscomment = 'Delivered'
				}
				return statuscomment
		},

		checkstatuscolor: function(status){
			let style = {}
			if(status === 0){
				style.color = "maroon"
			}else{
				style.color = "green"
			}

			return style
		},

		showDetailComponent: function(order){
			this.$emit("showDetailComponent", order)
		}
	},
	created(){
		this.getUserOrders()
	},


}

</script>

