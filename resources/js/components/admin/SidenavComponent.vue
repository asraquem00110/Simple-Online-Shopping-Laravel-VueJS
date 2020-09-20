<template>

<aside>
			<div id="accountinfo">
				<div class="col-5">
					<a href="profile.html"><img src=""></a>
				</div>
				<div class="col-7" style="margin-top: 25px;">
					<span style="font-weight: bold;">Welcome</span><br/>
					<span>@{!! Auth::user()->name !!}</span>
					<form method="POST" action="logout">
			  		@csrf
					<button type="submit"><span class="fa fa-power-off"></span> Logout</button>
				</form>
				</div>
			</div>
			<router-link :to="{name: 'testing'}" ><button class="btn btn-primary">Back</button></router-link>
			<ul>
				<li><router-link :to="{name: 'itemproducts'}"><i class="fa fa-chart-pie"></i> &nbsp;Dashboard</router-link></li>
				<li class="dropdown-nav"><a href="javascript:void(0)" class="dropbtn"><i class="fa fa-cubes"></i> &nbsp;Items</a>
					<div class="dropdown-nav-content">
						 <router-link :to="{name: 'editCompany', params: {id: company.id}}" class="btn btn-xs btn-default">
                                Edit
                            </router-link>


							<a href="item/product.html"><span><i class="fa fa-dot-circle"></i></span> &nbsp;Products</a>
							<a href="item/category.html"><span><i class="fa fa-dot-circle"></i></span> &nbsp;Category</a>
							<a href="item/brand.html"><span><i class="fa fa-dot-circle"></i></span> &nbsp;Brands</a>
					</div>
				</li>

				<li><a href="stores.html"><i class="fa fa-edit"></i> &nbsp;History</a></li>
				<li><a href="user.html"><i class="fa fa-users"></i> &nbsp;Users</a></li>
			

			</ul>
		
	</aside>

</template>


<script>

export default {
	mounted(){
		let opentoggle = document.getElementById('open-toggle');
		let aside = document.querySelector('aside');
		let mainsection = document.getElementById('MainSection');

		opentoggle.onclick = function(){
		if(aside.style.width=="0px"){
		aside.style.width = "220px";
		mainsection.style.marginLeft = "220px";
		}else{
		aside.style.width = "0px";
		mainsection.style.marginLeft = "0px";
		}
		}

		function adminmatch(x){
		let aside = document.querySelector('aside');
		if(x.matches){
		aside.style.width = "0px";
		mainsection.style.marginLeft = "0px";
		}else{
		aside.style.width = "220px";
		mainsection.style.marginLeft = "220px";
		}
		}

		var admin = window.matchMedia("(max-width: 800px) and (min-width: 200px)");
		adminmatch(admin);
		admin.addListener(adminmatch);



		var dropbtn = document.getElementsByClassName("dropbtn");

		for(let x = 0 ; x < dropbtn.length ; x++){
		dropbtn[x].onclick = function(){
		let childdiv = this.nextElementSibling;
		childdiv.style.display=="block" ? childdiv.style.display = "none" : childdiv.style.display = "block";	
		}
		}

	}
}

</script>