
<template>

	<div class="grid-col-4 otherinfo" style="box-sizing:border-box;box-shadow: 2px 2px 2px black">
		<div class="panel">
			<div class="panel-header panel-default">
					<span class="panel-title">&nbsp;</span>
			</div>
			<div class="panel-body">
		<div style="text-align:center;">

			<img :src="imgUrl+userinfo.img" width="80%;" height="80%;" />
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
			<button class="iconbtn" @click="showwishlistfunc"><span style="font-size:25pt;font-weight:bold;" class="fa fa-heart"></span></button>
			<br/>
			<small>Wishlist</small>
			</div>

			<div class="icondisplay grid-col-4">
			<button class="iconbtn" disabled @click="showorderfunc"><span style="font-size:25pt;font-weight:bold;" class="fa fa-file-alt"></span></button>
			<br/>
			<small>Records</small>
			</div>

			<div class="icondisplay grid-col-4">
			<button class="iconbtn" @click="showcartfunc"><span style="font-size:25pt;font-weight:bold;" class="fa fa-cart-plus"></span></button>
			<br/>
			<small>My Cart</small>
				<!-- <router-link :to="{name: 'cart'}"><span style="font-size:25pt;font-weight:bold;" class="fa fa-cart-plus"></span></router-link> -->
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

	.iconactive{
		color: white !important;
	}

	.icondisplay button {
		border-radius: 10px;
	}

</style>

<script>

import path from '../../config/path'

export default {
	props: {
		showcart: {
			type: Boolean,
			required: true,
		},
		showorder: {
			type: Boolean,
			required: true,
		},
		showwishlist: {
			type: Boolean,
			required: true,
		}
	},
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
			imgUrl: this.$store.state.imgUrl,
		}
	},
	methods: {
			refreshiconbtn: function(){

					let iconbtns = document.getElementsByClassName("iconbtn")
					for(let x = 0 ; x < iconbtns.length ; x++){
						iconbtns[x].removeAttribute("disabled")
					}
			
			},
			showcartfunc: function(){
				this.refreshiconbtn()
				document.getElementsByClassName("iconbtn")[2].setAttribute("disabled",true)
				this.$emit("displaycart",this.showcart ? false : true)
			},
			showorderfunc: function(){
				this.refreshiconbtn()
				document.getElementsByClassName("iconbtn")[1].setAttribute("disabled",true)
				this.$emit("displayorder",this.showorder ? false : true)
			},
			showwishlistfunc: function(){
				this.refreshiconbtn()
				document.getElementsByClassName("iconbtn")[0].setAttribute("disabled",true)
				this.$emit("displaywish",this.showwishlist ? false : true)
			}
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