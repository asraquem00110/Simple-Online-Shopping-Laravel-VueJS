<template>
	<div class="grid-col-8" style="box-sizing:border-box;box-shadow: 2px 2px 2px black">
			<div class="panel">
			<div class="panel-header panel-default">
					<span class="panel-title"><button  @click="closeComponent" style="border-radius:10px" class="btn"><span class="fa fa-times"></span> CLOSE</button></span>
			</div>
			<div class="panel-body" >
					<div style="overflow-x:auto;">
					<table class="table table-bordered table-condensed">
							<tr>
								<td colspan="4" style="text-align:center !important;background:dimgray"><span style="color:white;font-weight:bold;font-size:16pt;">ORDER ID: {{order.id}}</span></td>

							</tr>
							<tr>
								<td>ORDER DATE:</td>
								<td>{{ setDate(order.created_at) }}</td>
								<td>PAYMENT TYPE:</td>
								<td>{{order.payment}}</td>
							</tr>
							<tr>
								<td>ORDER STATUS:</td>
								<td :style="statusStyle">{{ checkstatus(order.status) }}</td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>FULLNAME:</td>
								<td>{{order.name}}</td>
								<td>EMAIL ADD:</td>
								<td>{{order.email}}</td>
							</tr>
							<tr>
								<td>ADDRESS:</td>
								<td>{{order.address}}</td>
								<td>CONTACT:</td>
								<td>{{order.contact}}</td>
							</tr>

					</table>
				</div>
					<hr/>
							<div class="grid-container" style="background:#D9EDF7;color:black;margin:0;padding: 5pt;text-align: center;border-radius: 10px;">
								<div class="grid-col-12">
									<div class="grid-container productcart">
								

										<div class="grid-col-2">
											Image
										</div>

										<div class="grid-col-4">
											 Product
										</div>

										<div class="grid-col-2">
											Quantity
										</div>

										<div class="grid-col-2">
											Price
										</div>


										<div class="grid-col-2">
											Amount
										</div>

									</div>
								</div>
							</div>


							<div class="grid-container">
								<div class="grid-col-12" style="margin-top:10px;padding: 5pt;text-align: center;border-radius: 10px;">
									<div v-for="(item,index) in order.product" class="grid-container productcart" :key="index">
									
									
											
									
											<div class="grid-col-2">
												<img :src="imgurl+ item.img" style="height: 50px;width: 50px;">
											</div>

											<div class="grid-col-4" style="text-align:left !important;">
												{{item.product}}<hr/>
												<small>{{item.description}}</small>
											</div>

											<div class="grid-col-2">
												{{ item.pivot.quantity}}
											</div>

											<div class="grid-col-2">
												{{ item.price}}
											</div>

											<div class="grid-col-2">
													{{ item.pivot.quantity * item.price }}
											</div>

									</div>

										<div class="grid-col-12" style="text-align: right;">
											<span style="color: black;font-size: 12pt;font-weight: bold;background: white;">AMOUNT : P {{totalamount}}</span>
										</div>

										<div class="grid-col-12" style="text-align: right;">
												<span style="color: black;font-size: 12pt;font-weight: bold;background: white;">DELIVERY CHARGE : P {{deliverycharge}}</span>

										</div>
											<hr/>
										<div class="grid-col-12" style="text-align: right;">
											
											<span style="color: maroon;font-size: 14pt;font-weight: bold;background: white;">TOTAL: P {{totalamount + deliverycharge}}</span>
										</div>									

								</div>
							</div>

			</div>
		</div>
	</div>
</template>

<style>
	table tr td {
		text-align: left !important;
		font-weight: bold;
		color:dimgray;
	}

</style>

<script>

	export default {

		data: function(){
			return {
					monthNames: ["January", "February", "March", "April", "May", "June","July", "August", "September", "October", "November", "December"],
					statusStyle: {
						color: '',
					},
					deliverycharge: 100,
					imgurl: this.$store.state.imgUrl,
				
			}
		},
		props: {
			order: {
				type: Object,
			}
		},
		computed: {
		 	totalamount: function(){
		 		let total = 0
		 		this.order.product.forEach((order)=>{
		 		 total += (order.price*order.pivot.quantity)
		 		})

		 		return total
		 	}
		},
		methods: {
			closeComponent: function(){
				this.$emit("closeComponent")
			},
			setDate: function(rawdate){
				let newDate = new Date(rawdate)
				return `${this.monthNames[newDate.getMonth()]} ${newDate.getDate()}, ${newDate.getFullYear()}`
			},
			checkstatus: function(status){
				this.statusStyle.color = status == 0 ? 'maroon' : 'green'
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
		},
		mounted(){

		}
	}

</script>
