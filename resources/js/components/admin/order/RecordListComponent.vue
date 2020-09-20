<template>



<div class="">
				<span class="pageheader"><i class="fa fa-edit"></i> Record List</span><hr/>
			<input v-model="search" type="text" placeholder="Search via Order #..." class="form-control" style="width: 50% !important">
			<ListComponent v-if="showList" :orders="records"  @showDetail="showDetail"></ListComponent>
			<div v-if="showdetail">
					<DetailComponent :order="order" @closeComponent="closeComponent"></DetailComponent>
					<hr/>
					
			</div>

			<small style="margin-left: 10px;font-weight:bold;color:dimgray;">Showing {{recordsPagination.from}} to {{recordsPagination.to}} of {{recordsPagination.total}} entries</small>
					<div class="paginationx" style="margin-top: 20px;">
						<button v-if="recordsPagination.prev_page_url" class="prevpage"  @click="AdminPaginateData(recordsPagination.prev_page_url)">PREV</button>
						<button v-else  class="prevpage" disabled>PREV</button>



						<button v-if="recordsPagination.next_page_url" class="nextpage" @click="AdminPaginateData(recordsPagination.next_page_url)">NEXT</button>
						<button v-else class="nextpage" disabled>NEXT</button>
					</div>
</div>



</template>

<script>
	import ListComponent from './ListComponent'
	import DetailComponent from '../../user/DetailsComponent'
	import path from '../../../config/path'
	import {mapState,mapActions} from 'vuex'
	export default {
		data: function(){
			return {
				showList: true,
				showdetail: false,
				order: {},
				search: '',
				doneTypingInterval: 500,
				typingTimer: '',
			}
		},
		computed: {
			...mapState('order',{
			'records': state=> state.records,
			'recordsPagination': state=>state.recordsPagination,
			})
		},
		watch: {
		search: function(newval,oldval){
				clearTimeout(this.typingTimer)
				if(newval){
						this.typingTimer = setTimeout(()=>{
						this.$store.dispatch('order/sortAdminbySearch',newval)
					},this.doneTypingInterval)
				}else{
					this.$store.dispatch('order/getRecords')
					//this.$router.replace({name: 'userprofile'})
				}
			}
		},
		methods: {
			...mapActions('order',[
				'AdminPaginateData',
				]),
			showDetail:function(data){
				this.order = data
				this.showdetail = true
				this.showList = false
			},
			closeComponent: function(){
			this.order = {}
			this.showdetail = false
			this.showList = true
				},
		},
		mounted(){
			require('../../../adminresponsive')
			this.$store.dispatch('order/getRecords')
		},
		components: {ListComponent,DetailComponent}
	}

</script>