<template>
	<div class="modal" id="signUpModal">
			<div class="modal-content" style="width: 50% !important;">
			<span @click="removemodal" class="close-modal" ref="closemodal">&times;</span>
			<div class="modal-body" style="padding-bottom: 40px;position:relative;height:500px;width:500px;text-align:center;">

					<img :src="`${imgUrl}/${info.img}`"  style="height:100%;width:100%;position:absolute;"/>

			</div>

		</div>

	</div>

</template>

<script>
	export default {

		props: {
			info: {
				type: Object,
				required: true,
			}
		},

		data: function(){
			return {
				imgUrl: this.$store.state.imgUrl
			}
		},

		methods: {
			removemodal: function(){
				this.$emit('removemodal')
			}
		}

	}
</script>