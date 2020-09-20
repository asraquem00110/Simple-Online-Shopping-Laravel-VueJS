<template>
    <div>
        <aside v-if="UserLogged != 'guest'">
			<div id="accountinfo">
				<div class="col-5">
					<a href="profile.html"><img src="{{asset('upload/default.png')}}" style="width: 80px;"></a>
				</div>
				<div class="col-7" style="margin-top: 35px;">
					<span style="font-weight: bold;">Welcome</span><br/>
					<span v-html="UserLogged"></span>
				</div>
			</div>
	
			<ul>
				<li><router-link :to="{name: 'adminindex'}"><i class="fa fa-chart-pie"></i> &nbsp;Dashboard</router-link></li>
				<li class="dropdown-nav"><a href="javascript:void(0)" class="dropbtn"><i class="fa fa-cubes"></i> &nbsp;Items</a>
					<div class="dropdown-nav-content">
							<router-link :to="{name: 'productlist'}"><span><i class="fa fa-dot-circle"></i></span> &nbsp;Products</router-link>
							<router-link :to="{name: 'categorylist'}"><span><i class="fa fa-dot-circle"></i></span> &nbsp;Category</router-link>
							<router-link :to="{name: 'brandlist'}"><span><i class="fa fa-dot-circle"></i></span> &nbsp;Brand</router-link>
					</div>
				</li>

				<li><router-link :to="{name: 'pendingorder'}"><i class="fa fa-exclamation-circle"></i> &nbsp;Pending Orders <span style="padding: 3px;background:maroon;color:white;border-radius: 50%;font-size: 11pt;">@{{pendingorder.length}}</span></router-link></li>

				<li><router-link :to="{name: 'fordelivery'}"><i class="fa fa-truck"></i> &nbsp;For Delivery <span v-if="deliveryorder.length > 0" style="padding: 3px;background:green;color:white;border-radius: 50%;font-size: 11pt;">@{{deliveryorder.length}}</span></router-link></li>

				<li><router-link :to="{name: 'records'}"><i class="fa fa-edit"></i> &nbsp;Records</router-link></li>
				<li><router-link :to="{name: 'salesreport'}"><i class="fa fa-chart-bar"></i> &nbsp;Sale Reports</router-link></li>
					<li class="dropdown-nav"><a href="javascript:void(0)" class="dropbtn"><i class="fa fa-users"></i> &nbsp;Manage Users</a>
					<div class="dropdown-nav-content">
							<router-link :to="{name: 'newuser'}"><span><i class="fa fa-plus"></i></span> &nbsp;New</router-link>

							<router-link :to="{name: 'adminlist'}"><span><i class="fa fa-user"></i></span> &nbsp;Admin</router-link>
							<router-link :to="{name: 'customerlist'}"><span><i class="fa fa-user"></i></span> &nbsp;Customers</router-link>
						
					</div>
				</li>


				<li><a href="javascript:void(0)" @click="logout"><i class="fa fa-power-off"></i> &nbsp;Logout</a></li>


			</ul>
		
	</aside>

      <router-view></router-view>


    </div>
</template>

<script>

export default {
    computed: {
		UserLogged: function(){
			return this.$store.state.user
        },
    }
}
</script>