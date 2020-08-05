<template>
	<div>
		<div v-for="status in statuses" class="card mb-3 border-0 shadow">
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
			<div class="card-footer">
				<button class="btn btn-primary" v-on:click="like(status.id)">Me gusta</button>
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
			like(id){
				axios.post(`statuses/${id}/likes`)
					.then(res => {
						console.log(res)
					})
					.catch(e =>  console.log(e.response.data))
			}
		}
	};
</script>

<style>

</style>
