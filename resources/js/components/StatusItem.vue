<template>
	<div class="card mb-3 border-0 shadow">
		<div class="card-body">
			<div class="d-flex flex-column">
				<div class="d-flex mb-2 align-item-center">
					<img class="rounded mr-2 shadow" width="40px" height="40px" :src="status.user.avatar">
					<div>
						<h5 class="mb-0">
							<a :href="status.user.link">{{ status.user.name }}</a>
						</h5>
						<span class="small text-muted">{{ status.ago }}</span>
					</div>
				</div>
				<div class="card-text text-secondary">
					{{ status.body }}
				</div>
			</div>
		</div>
		<div class="card-footer p-1 d-flex align-items-center justify-content-between">
			<like-btn
				:resource="status"
				:url="url"
				>
			</like-btn>
			<span class="text-primary mr-2"> {{ status.likes }}</span>
		</div>
		<status-comment
			:status="status"
		></status-comment>		
	</div>
</template>

<script>
	import LikeBtn from './LikeBtn'
	import StatusComment from './StatusComment'
	export default {
		props: {
			status: {
				type: Object,
				required: true
			}
		},
		components: { LikeBtn, StatusComment },
		computed: {
			url(){
				return `statuses/${this.status.id}/likes`
			}
		}
	}
</script>

<style>

</style>
