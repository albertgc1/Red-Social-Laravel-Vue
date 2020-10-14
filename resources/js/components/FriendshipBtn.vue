<template>
    <button
        @click="toggleFriendshipRequest"
    >{{ getText }}</button>
</template>

<script>
    export default {
        props: {
			recipient: {
				type: Object,
				required: true
            },
            friendshipStatus: {
                type: String,
				required: true
            }
        },
        data(){
			return {
				localFriendshipStatus: this.friendshipStatus
			}
		},
        methods: {
            toggleFriendshipRequest(){
                let method = this.getMethod()
                axios[method](`friendships/${this.recipient.name}`)
                    .then(res => {
						this.localFriendshipStatus = res.data.friendship_status
					})
					.catch(e =>  console.log(e.response.data))
            },
            getMethod(){
                if(this.localFriendshipStatus === 'pending' || this.localFriendshipStatus === 'accepted'){
                    return 'delete'
                }
                return 'post'
            }
        },
        computed: {
            getText(){
                console.log(this.localFriendshipStatus)
                if(this.localFriendshipStatus === 'pending'){
                    return 'Cancelar solicitud'
                }
                if(this.localFriendshipStatus === 'accepted'){
                    return 'Eliminar de mis amigos'
                }
                return 'Enviar solicitud'
            }
        }
    }
</script>
