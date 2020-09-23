<template>
    <div class="d-flex align-item-center justify-content-between">
        <div>
            {{ localfriendship.sender.first_name }} {{ localfriendship.sender.last_name }}
        </div>
        <button
            @click="toggleFriendshipRequest"
        >{{ getText }}</button>
    </div>
</template>

<script>
    export default {
        props: {
            friendship: {
                type: Object,
				required: true
            }
        },
        data(){
			return {
				localfriendship: this.friendship
			}
		},
        methods: {
            toggleFriendshipRequest(){
                axios.put(`friendships/${this.localfriendship.sender.name}`)
                    .then(res => {
						this.localfriendship.status = 'accepted'
					})
					.catch(e =>  console.log(e.response.data))
            },
        },
        computed: {
            getText(){
                if(this.localfriendship.status === 'pending'){
                    return 'Aceptar solicitud'
                }
                return 'Son amigos'
            }
        }
    }
</script>
