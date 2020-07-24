<template>
	<form @submit.prevent="submit">
        <div class="card-body">
            <textarea
            	v-model="body"
            	class="form-control border-0"
            	name="body"
            	placeholder="¿Que estas pensando Albert?">
            </textarea>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary">Publicar</button>
        </div>
    </form>
</template>

<script>
	export default {
		data(){
			return{
				body: '',
				statuses: []
			}
		},
		methods: {
			submit() {
				axios.post('/statuses', { body: this.body })
					.then(res => console.log(res))
					.catch(e =>  console.log(e.response.data))
			}
		}
	};
</script>

<style>

</style>
