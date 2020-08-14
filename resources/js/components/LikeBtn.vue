<template>
    <button 
        v-if="resource.is_liked"
        @click="unlike()"
        class="btn btn-link">
        <i class="fa fa-thumbs-up"></i> Te gusta
    </button>
    <button 
        v-else
        @click="like()" 
        class="btn btn-link">
        <i class="far fa-thumbs-up"></i> Me gusta
    </button>
</template>

<script>
    export default {
        props: {
			resource: {
				type: Object,
				required: true
			},
			url: {
				type: String,
				required: true
			}
		},
        methods: {
			like(){
				axios.post(this.url)
					.then(res => {
						this.resource.likes ++
						this.resource.is_liked = true
					})
					.catch(e =>  console.log(e.response.data))
			},
			unlike(){
				axios.delete(this.url)
					.then(res => {
						this.resource.likes --
						this.resource.is_liked = false
					})
					.catch(e =>  console.log(e.response.data))
			}
        }
    }
</script>
