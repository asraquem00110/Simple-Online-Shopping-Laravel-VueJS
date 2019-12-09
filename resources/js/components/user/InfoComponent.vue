
<template>

	<div class="grid-col-4 otherinfo" style="box-sizing:border-box;box-shadow: 2px 2px 2px black">
		<div class="panel">
			<div class="panel-header panel-default">
					<span class="panel-title">&nbsp;</span>
			</div>
			<div class="panel-body">
		<div style="text-align:center;">

			<img :src="'upload/'+userinfo.img" width="80%;" height="80%;" />
		</div>

		<div style="margin-top: 30px;padding:10px;">
			<hr/>
			<span style="font-size:12pt;font-weight:bold;color:dimgray;">NAME: {{userinfo.name.toUpperCase()}}</span>
			<hr/>
			<span style="font-size:12pt;font-weight:bold;color:dimgray;">EMAIL: {{userinfo.email.toUpperCase()}}</span>
			<hr/>
			<span style="font-size:12pt;font-weight:bold;color:dimgray;">ADDRESS: {{userinfo.address.toUpperCase()}}</span>
			<hr/>
			<span style="font-size:12pt;font-weight:bold;color:dimgray;">CONTACT: {{userinfo.contact.toUpperCase()}}</span>
			<hr/>

		</div>

		<div class="grid-container" style="text-align:center;background:silver;padding:20pt;border-radius: 10px;">
			<div class="icondisplay grid-col-4">
			<span style="font-size:25pt;font-weight:bold;" class="fa fa-heart"></span>
			</div>

			<div class="icondisplay grid-col-4">
			<span style="font-size:25pt;font-weight:bold;" class="fa fa-cube"></span>
			</div>

			<div class="icondisplay grid-col-4">
				<router-link :to="{name: 'cart'}"><span style="font-size:25pt;font-weight:bold;" class="fa fa-cart-plus"></span></router-link>
			</div>

		<!-- 	<div class="grid-col-3">
				<span style="font-size:25pt;font-weight:bold;" class="fa fa-power-off"></span>
			</div> -->

		</div>
		</div>	
		</div>

	</div>




</template>

<style>

	a {
		color: #212529;
	}

</style>

<script>

import path from '../../config/path'

export default {

	data: function(){
		return {
			spanstyle: {
				'position': 'absolute',
				'bottom': '-15px',
				'right': '30px',
				'font-size': '16pt',
				'font-weight': 'bold',
				'color': 'green',
			},
			userinfo: {},
		}
	},
	methods: {
		
	},
	created(){
		this.$store.dispatch('getUserInfo').then((res)=>{
			this.userinfo = res.data
		}).catch((err)=>{
			console.log(err)
		})
	
	},
	mounted(){
			
	},

}


</script>