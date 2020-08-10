<template>
	<div class="card mb-3 border-0 shadow">
		<div class="card-body">
			<div class="d-flex flex-column">
				<div class="d-flex mb-2 align-item-center">
					<img class="rounded mr-2 shadow" width="40px" height="40px" :src="status.user_avatar">
					<div>
						<h5 class="mb-0">{{ status.user_name }}</h5>
						<span class="small text-muted">{{ status.ago }}</span>
					</div>
				</div>
				<div class="card-text text-secondary">
					{{ status.body }}
				</div>
			</div>
		</div>
		<div class="card-footer d-flex align-items-center justify-content-between">
			<like-btn
				:status="status">
			</like-btn>
			<span class="text-primary"> {{ status.likes }}</span>
		</div>
	</div>
</template>

<script>
	import LikeBtn from './LikeBtn'
	export default {
		props: {
			status: {
				type: Object,
				required: true
			}
		},
		components: { LikeBtn },
		data () {
			return {
			}
		}
	}
</script>

<style>

</style>
