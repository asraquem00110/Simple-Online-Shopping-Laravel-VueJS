<template>

<div class="">
				<span class="pageheader"><i class="fa fa-edit"></i> Sales Report</span><hr/>

				<button class="btn btn-primary" @click="showmonthlyfilter">Monthly Reports</button>
				<button class="btn btn-primary" @click="showyearlyfilter">Yearly Reports</button>
				<hr/>	


				<div class="grid-container">
					<div v-if="showmonthly" class="grid-col-4">
						<div class="panel">
							<div class="panel-header panel-primary"></div>
							<div class="panel-body">
								<label>Year</label>
								<input type="number" class="form-control" v-model="filter.year">

		

									<button class="btn btn-primary" @click="showdataMonthly">Generate</button>
							</div>
						</div>
					</div>

					<div v-if="showyearly" class="grid-col-4">
						<div class="panel">
							<div class="panel-header panel-primary"></div>
							<div class="panel-body">
								<label>FROM</label>
								<input type="number" class="form-control" v-model="filter.from">
								<label>TO</label>
								<input type="number" class="form-control" v-model="filter.to">

								<button class="btn btn-primary" @click="showdataYearly">Generate</button>

							</div>
						</div>
					</div>

					<div v-if="showdata" class="grid-col-4">
							<table class="table table-bordered table-condensed form-control">
									<thead>
										<tr style="background:#3071A9;">
											<th colspan="2" style="text-align:center;color:white;" >SALES REPORT FOR YEAR {{filter.year}}</th>
										</tr>
										<tr style="background:#DDDDDD;">
											<th style="color:dimgray;">{{column1}}</th>
											<th style="color:dimgray;">{{column2}}</th>
										</tr>
									</thead>
									<tbody>
										<tr v-for="(data,index) in displaydata" :key="index">
											<td>{{data[0]}}</td>
											<td>P {{data[1].toFixed(2)}}</td>
										</tr>
										<tr style="background:#3071A9;">
											<td style="color:white;">TOTAL AMOUNT:</td>
											<td style="color:white;">P {{totalamount.toFixed(2)}}</td>
										</tr>

									</tbody>
								</table>
					</div>
					<div class="grid-col-8" v-if="showdata">
						<div class="panel">
							<div class="panel-header panel-primary"></div>
							<div class="panel-body">

						<pie-chart  :donut="false" :data="this.displaydata" width="100%" height="700px"></pie-chart>

						</div>
						</div>
					</div>

					<div class="grid-col-12" v-if="showdata" style="margin-top: 40px;">
						<div class="panel">
							<div class="panel-header panel-primary"></div>
							<div class="panel-body">

						<area-chart  :donut="false" :data="this.displaydata" width="100%" height="700px"></area-chart>

							</div>
						</div>
					</div>

				</div>


</div>



</template>

<script>
	import path from '../../../config/path'
	export default {
		data: function(){
			return {
				showmonthly: false,
				showyearly: false,
				showdata: false,
				displaydata: [],
				filter: {
					year: '',
					from: '',
					to: '',
				},
				column1: '',
				column2: '',
				monthNames: ["JAN", "FEB", "MAR", "APR", "MAY", "JUN","JUL", "AUG", "SEP", "OCT", "NOV", "DEC"],
			}
		},
		computed: {
			totalamount: function(){
				let total = 0
				this.displaydata.forEach((data)=>{
					total += data[1]
				})

				return total
			}
		},
		methods: {
			showmonthlyfilter: function(){
				this.showyearly = false
				this.showmonthly = true
				this.showdata = false
				this.resetinputs()
			},
			showyearlyfilter: function(){
				this.showyearly = true
				this.showmonthly = false
				this.showdata = false
				this.resetinputs()
			},
			showdataMonthly: function(){
				this.showyearly = false
				this.showmonthly = false
				this.showdata = true
				this.column1 = "MONTH"
				this.column2 = "AMOUNT"

				axios.post(`/api/showdataMonthly`,this.filter, {headers: { 'Accept': 'application/json','Authorization': 'Bearer '+ this.$store.state.token }})
				.then((res)=>{
					console.log(res)
					this.displaydata = res.data
				})
				.catch((err)=>{
					console.log(err)
				})
			},
			showdataYearly: function(){
				this.showyearly = false
				this.showmonthly = false
				this.showdata = true

				this.column1 = "YEAR"
				this.column2 = "AMOUNT"
				this.filter.year = `${this.filter.from} UP TO ${this.filter.to}`

				axios.post(`/api/showdataYearly`,this.filter, {headers: { 'Accept': 'application/json','Authorization': 'Bearer '+ this.$store.state.token }})
				.then((res)=>{
					if(res.data.message){
							this.$toastr.Add({
								name: 'addtoCartMessage',
								title: 'System Message',
								msg: res.data.message,
								timeout: 5000,
								progressbar: false,
								type: 'error',
								style: { backgroundColor: "maroon"},
								position: 'toast-top-center',
							})

								this.showyearly = true
								this.showmonthly = false
								this.showdata = false
					}else{
						this.displaydata = res.data
					}	
				
				})
				.catch((err)=>{
					console.log(err)
				})
			},
			resetinputs: function(){
				let date = new Date();
				let now = date.getFullYear()
				this.filter.year = this.filter.from = this.filter.to = now
			}
		},
		mounted(){
			this.resetinputs()
			require('../../../adminresponsive')
			
		},	
	}


</script>