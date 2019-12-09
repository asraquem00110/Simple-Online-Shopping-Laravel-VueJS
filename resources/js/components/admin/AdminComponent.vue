<template>
	<div>
			<span class="pageheader"><i class="fa fa-chart-pie"></i> Dashboard</span><hr/>
			<div class="grid-container">
					<div class="grid-col-3" style="margin: 0px 5px 5px 0px;">
						<div class="panel">
								<div class="panel-header panel-primary">
									<span class="panel-title"></span>
								</div>
								<div class="panel-body otherdash" style="position: relative;">
									<span style="font-size: 40pt;" class="fa fa-cogs"></span>
									<span class="dashboard-item">Categories</span>
									<span class="dashboard-item-count">{{dashboardcounts[1]}}</span>
								</div>
						</div>
					</div>

					<div class="grid-col-3" style="margin: 0px 5px 5px 0px;">
						<div class="panel">
								<div class="panel-header panel-primary">
									<span class="panel-title"></span>
								</div>
								<div class="panel-body otherdash" style="position: relative;">
									<span style="font-size: 40pt;" class="fa fa-cubes"></span>
									<span class="dashboard-item">Items</span>
									<span class="dashboard-item-count">{{dashboardcounts[2]}}</span>
								</div>
						</div>
					</div>

				

					<div class="grid-col-3" style="margin: 0px 5px 5px 0px;">
						<div class="panel">
								<div class="panel-header panel-primary">
									<span class="panel-title"></span>
								</div>
								<div class="panel-body otherdash" style="position: relative;">
									<span style="font-size: 40pt;" class="fa fa-coins"></span>
									<span class="dashboard-item">Brands</span>
									<span class="dashboard-item-count">{{dashboardcounts[0]}}</span>
								</div>
						</div>
					</div>

					<div class="grid-col-3" style="margin: 0px 5px 5px 0px;">
						<div class="panel">
								<div class="panel-header panel-primary">
									<span class="panel-title"></span>
								</div>
								<div class="panel-body otherdash" style="position: relative;">
									<span style="font-size: 40pt;" class="fa fa-user"></span>
									<span class="dashboard-item">Admin</span>
									<span class="dashboard-item-count">{{Admin}}</span>
								</div>
						</div>
					</div>

				<div class="grid-col-3" style="margin: 0px 5px 5px 0px;">
						<div class="panel">
								<div class="panel-header panel-primary">
									<span class="panel-title"></span>
								</div>
								<div class="panel-body otherdash" style="position: relative;">
									<span style="font-size: 40pt;" class="fa fa-users"></span>
									<span class="dashboard-item">Customers</span>
									<span class="dashboard-item-count">{{User}}</span>
								</div>
						</div>
					</div>


				<div class="grid-col-3" style="margin: 0px 5px 5px 0px;">
						<div class="panel">
								<div class="panel-header panel-warning"  style="background: maroon">
									<span class="panel-title"></span>
								</div>
								<div class="panel-body otherdash" style="position: relative;">
									<span style="font-size: 40pt;color:maroon" class="fa fa-exclamation-circle"></span>
									<span class="dashboard-item" style="color:maroon">Pending Orders</span>
									<span class="dashboard-item-count" style="color:maroon">{{pendingorder.length}}</span>
								</div>
						</div>
					</div>


				<div class="grid-col-3" style="margin: 0px 5px 5px 0px;">
						<div class="panel">
								<div class="panel-header panel-success" style="background: green">
									<span class="panel-title"></span>
								</div>
								<div class="panel-body otherdash" style="position: relative;">
									<span style="font-size: 40pt;color:green" class="fa fa-truck"></span>
									<span class="dashboard-item" style="color:green">For Delivery</span>
									<span class="dashboard-item-count" style="color:green">{{deliveryorder.length}}</span>
								</div>
						</div>
					</div>
			</div>
			<hr/>
			<center><h1>Monthly Sale for the Year {{getYearNow}}</h1></center>
			<div class="grid-container">

				<div class="grid-col-12">

					<column-chart :data="monthlysales" height="500px"></column-chart>
				</div>

			</div>

	</div>
</template>


<script>
import path from '../../config/path'
import {mapState} from 'vuex'
export default {

	data: function(){
		return {
			dashboardcounts: {},
			titlename: 'alvin raquem',
			charData: [['Sun', 32], ['Mon', 46], ['Tue', 28]],
		}
	},
	methods: {
		getdashboardCount: function(){

		}
	},
	created(){
		let app = this;
		axios.get(`/api/getDashboardDetails`,{headers: {'Accept': 'application/json','Authorization': 'Bearer '+ this.$store.state.token}})
			.then((resp)=>{
				console.log(resp)
				if(resp.data.error){
					    localStorage.removeItem('token')
						localStorage.removeItem('isLogin')
						localStorage.removeItem('loguser')
						this.$store.state.user = 'guest'
						this.$router.replace({name: 'adminlogin'})
						this.$toastr.Add({
								name: 'addtoCartMessage',
								title: 'Authentication',
								msg: 'Permission Denied!!',
								timeout: 5000,
								progressbar: false,
								type: 'error',
								style: { backgroundColor: "maroon"},
								position: 'toast-top-center',
							})
				}else{
					app.dashboardcounts = resp.data;
				}
				
			})
			.catch((resp)=>{
				console.log(resp);
			});

			this.$store.dispatch('order/pendingOrders')
			this.$store.dispatch('order/deliveryOrders')
			this.$store.dispatch('order/getMonthlySales')


	},
	computed: {
		getYearNow: function(){
			let date = new Date();
			let now = date.getFullYear();
			return now
		},
		Admin: function(){
			let admin = this.dashboardcounts[3].filter((admin)=>{
				return admin.userType == 1;
			})
			return admin.length
		},

		User: function(){
			let user = this.dashboardcounts[3].filter((user)=>{
				return user.userType == 0;
			})
			return user.length
		},


		...mapState('order',{
			'pendingorder': state=> state.pendingOrder,
			'deliveryorder': state=> state.forDelivery,
			'monthlysales': state=> state.monthlysales,
		})
	},
	mounted(){
			
		require('../../adminresponsive')
		
	},	
	
}

</script>