<template>
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
				<div class="d-flex align-items-center justify-content-between">
					<div class="d-flex">
                        <img class="rounded mr-2 shadow" width="30px" height="30px" :src="comment.user.avatar" :alt="comment.user.name">
                        <div class="d-flex flex-column">
                            <span> <strong><a :href="comment.user.link">{{ comment.user.name }}</a></strong> {{ comment.body }}</span>
                            <span class="text-muted" style="font-size: 12px">{{ comment.ago }}</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <like-btn
                            :resource="comment"
                            :url="getUrl(comment)"
                            >
                        </like-btn>
                        <span class="text-primary">{{ comment.likes }}</span>
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
            },
            getUrl(comment){
                return `comments/${comment.id}/likes`
            }
        }
    }
</script>

<style>
    .likes{
        width: 50px;
    }
</style>
