<template>
	<div @click="redirectIfGuest">
		<status-item
			v-for="status in statuses"
			:status="status"
			:key="status.id"
		>
		</status-item>
	</div>
</template>

<script>
	import StatusItem from './StatusItem'
	export default {
		components: { StatusItem },
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
		}
	};
</script>

<style>

</style>
