<template>
	<div @click="redirectIfGuest">
		<div v-for="status in statuses" :key="status.id" class="card mb-3 border-0 shadow">
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
				<button 
					v-if="status.is_liked"
					@click="unlike(status)"
					class="btn btn-link"
				>
					<i class="fa fa-thumbs-up"></i> Te gusta
				</button>
				<button 
					v-else
					@click="like(status)" 
					class="btn btn-link"
				>
					<i class="far fa-thumbs-up"></i> Me gusta
				</button>
				<span class="text-primary"> {{ status.likes }}</span>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		data(){
			return {
				statuses: []
			}
		},
		mounted(){
			axios.get('/statuses')
				.then(res => {
					this.statuses = res.data.data
				})
				.catch(e =>  console.log(e.response.data))

			EventBus.$on('status-created', status => {
				this.statuses.unshift(status)
			})
		},
		methods: {
			like(status){
				axios.post(`statuses/${status.id}/likes`)
					.then(res => {
						status.likes ++
						status.is_liked = true
					})
					.catch(e =>  console.log(e.response.data))
			},
			unlike(status){
				axios.delete(`statuses/${status.id}/likes`)
					.then(res => {
						status.likes --
						status.is_liked = false
					})
					.catch(e =>  console.log(e.response.data))
			}
		}
	};
</script>

<style>

</style>
