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
		<div class="card-footer p-1 d-flex align-items-center justify-content-between">
			<like-btn
				:status="status">
			</like-btn>
			<span class="text-primary"> {{ status.likes }}</span>
		</div>
		<div class="comments">
			<div class="input-group mb-3">
				<!-- <div class="input-group-prepend">
					<img class="rounded" width="30px" height="30px">
				</div> -->
				<input v-model="body" type="text" class="form-control" placeholder="Escribe algo aquí">
				<div class="input-group-append">
					<button @click="storeComment(status.id)" class="btn btn-outline-primary" type="button" id="button-addon2">Commentar</button>
				</div>
			</div>
			<div
				v-for="comment in status.comments"
				:key="comment.id"
				class="card p-2">
				<div class="d-flex">
					<img class="rounded mr-2 shadow" width="30px" height="30px" :src="comment.user_avatar" :alt="comment.user_name">
					<div class="d-flex flex-column">
						<span> <strong>{{ comment.user_name }}</strong> {{ comment.body }}</span>
						<span class="text-muted" style="font-size: 12px">{{ comment.ago }}</span>
					</div>
				</div>
			</div>
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
				body: ''
			}
		},
		methods: {
			storeComment(id) {
				axios.post(`statuses/${id}/comments`, { body: this.body })
					.then(res => {
						console.log(res.data.data)
						this.status.comments.unshift(res.data.data)
						//EventBus.$emit('status-created', res.data.data)
					})
					.catch(e =>  console.log(e.response.data))
			}
		}
	}
</script>

<style>

</style>
