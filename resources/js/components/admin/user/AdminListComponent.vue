<template>

	<div class="">
				<span class="pageheader"><i class="fa fa-user"></i> Admin(s) List</span><hr/>

			<div class="panel" id="userpanel">
			<div class="panel-header panel-primary">
				&nbsp;
			</div>

	
			
			<div class="panel-body">


			<input v-model="search" type="text" placeholder="Search via name..." class="form-control" style="width: 50% !important">

					<div style="overflow-x:auto;">
						<table class="table table-bordered table-striped">
					<thead>
						<tr style="background: dimgray;color: white;">
							<th>Fullname</th>
							<th>Email</th>
							<th>Contact</th>
							<th>Address</th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						

						<tr v-for="(user,index) in users.data" :key="index">
							<td>{{ user.name }}</td>
							<td>{{ user.email }}</td>
							<td>{{ user.contact }}</td>
							<td>{{ user.address }}</td>
							<td><router-link :to="{name: 'editUser',params: {idno: user.id}}">Edit</router-link></td>
							<td><a href="javascript:void(0)" @click="removeUser(index)">Delete</a></td>
						</tr>
						
					</tbody>

				</table>
			</div>
					<small style="margin-left: 10px;font-weight:bold;color:dimgray;">Showing {{users.from}} to {{users.to}} of {{users.total}} entries</small>
					<div class="paginationx" style="margin-top: 20px;">
						<button v-if="users.prev_page_url" class="prevpage"  @click="paginateData(users.prev_page_url)">PREV</button>
						<button v-else  class="prevpage" disabled>PREV</button>



						<button v-if="users.next_page_url" class="nextpage" @click="paginateData(users.next_page_url)">NEXT</button>
						<button v-else class="nextpage" disabled>NEXT</button>
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
					users: {},
					search: '',
					doneTyping: 500,
					Timer: '',
				}
			},
			created(){
				this.getUserlist()
			},
			watch: {
				search: function(newval,oldval){

					clearTimeout(this.Timer)
					if(newval){
						this.Timer = setTimeout(()=>{
							this.sortbySearch(newval)
						},this.doneTyping)
					}else{
						this.getUserlist()
					}
				}
			},
			methods: {
				getUserlist: function(){
					let app = this


					axios.get(`/api/getAdminList`,{headers: {'Accept': 'application/json','Authorization': 'Bearer '+ app.$store.state.token}})
					.then((res)=>{
						
						app.users = res.data.users
					})
					.catch((err)=>{
						console.log(err)
					})
				},
				removeUser: function(key){

					if(confirm("Are you sure you want to delete this user?")){
							axios.delete(`/api/removeUser/${this.users.data[key].id}`,{headers: {'Accept': 'application/json','Authorization': 'Bearer '+ this.$store.state.token}})
							.then((res)=>{
								this.users.data.splice(key,1)
							})
							.catch((err)=>{
								console.log(err)
							})
					}

					
				},

				paginateData: function(url){
			
							  	axios.get(`${url}`,{headers: {'Accept': 'application/json','Authorization': 'Bearer '+ this.$store.state.token}})
									.then((res)=>{
										this.users = res.data.users
									})
									.catch((err)=>{
										console.log(err)
									})
	
					},
				sortbySearch: function(){

						
							axios.get(`/api/getAdminBySearch/${this.search}`,{headers: {'Accept': 'application/json','Authorization': 'Bearer '+ this.$store.state.token}})
							.then((res)=>{
								this.users = res.data.users
							})
							.catch((err)=>{
								console.log(err)
							})
		

					},
			},
			mounted(){
				require('../../../adminresponsive')
			}


	}

</script>