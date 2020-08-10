<template>
    <button 
        v-if="status.is_liked"
        @click="unlike(status)"
        class="btn btn-link">
        <i class="fa fa-thumbs-up"></i> Te gusta
    </button>
    <button 
        v-else
        @click="like(status)" 
        class="btn btn-link">
        <i class="far fa-thumbs-up"></i> Me gusta
    </button>
</template>

<script>
    export default {
        props: {
			status: {
				type: Object,
				required: true
			}
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
    }
</script>
