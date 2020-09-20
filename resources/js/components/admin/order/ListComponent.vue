<template>

	<table class="table table-bordered table-condensed table-striped">
					<thead>
						<tr style="background:dimgray;color:white;">
							<th>Order #</th>
							<th>Order Date</th>
							<th>Customer Name</th>
							<th>Customer email</th>
							<th>Customer No</th>
							<th>Payment Type</th>
							<th>No of Items</th>
							<th>Total Amount</th>
				

						</tr>


					</thead>

					<tbody>
						<tr v-for="(order,index) in getOrders" :key="index"  style="font-size:14pt;font-weight:bold;color:dimgray">
							<td><button @click="showDetail(order)" style="color:green;font-weight:bold" class="form-control">{{ order.id}}</button></td>
							<td>{{setDate(order.created_at)}}</td>
							<td>{{order.name}}</td>
							<td>{{order.email}}</td>
							<td>{{order.contact}}</td>
							<td>{{order.payment}}</td>
							<td>{{order.product.length}}</td>
							<td>P {{computeTotal(order.product).toFixed(2)}}</td>
							

						</tr>

					</tbody>


				</table>

</template>

<script>
	
	export default {

		data: function(){
			return {
					monthNames: ["January", "February", "March", "April", "May", "June","July", "August", "September", "October", "November", "December"],

					pendingorder: [],

			}
		},
		props: {
			orders: {
				type: Array,
				required: true,
			}
		},

		computed: {
			getOrders: function(){
				return this.orders
			}
		},
		methods: {
		    setDate: function(rawdate){
			let newDate = new Date(rawdate)
			return `${this.monthNames[newDate.getMonth()]} ${newDate.getDate()}, ${newDate.getFullYear()}`
			},

			computeTotal: function(items){
				let total = 0
				items.forEach((item)=>{
					total += (item.pivot.quantity * item.price)
				})

				return total
			}, 
			showDetail: function(order){
				this.$emit("showDetail",order)
			}
		}
	}

</script>
