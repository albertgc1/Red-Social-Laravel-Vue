<template>
	<form v-if="isAuthenticated" @submit.prevent="submit">
        <div class="card-body">
            <textarea
            	v-model="body"
            	class="form-control border-0"
            	name="body"
            	:placeholder="`¿Que estas pensando ${user.name}?`">
            </textarea>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary">
				<i class="fa fa-paper-plane"></i> Publicar
			</button>
        </div>
    </form>
    <div v-else class="card-body">
    	<p>Debes <a href="/login">autenticarte</a> para interactuar con la página</p>
    </div>
</template>

<script>
	export default {
		data(){
			return{
				body: ''
			}
		},
		methods: {
			submit() {
				axios.post('/statuses', { body: this.body })
					.then(res => {
						this.body = '',
						EventBus.$emit('status-created', res.data.data)
					})
					.catch(e =>  console.log(e.response.data))
			}
		}
	};
</script>

<style>

</style>
