require('./bootstrap');

const Vue = require('vue')

import StatusForm from './components/StatusForm'
import StatusList from './components/StatusList'
import StatusItem from './components/StatusItem'
import FriendshipBtn from './components/FriendshipBtn'
import FriendshipItem from './components/FriendshipItem'

window.EventBus = new Vue()

import auth from './mixins/auth'
Vue.mixin(auth)

const app = new Vue({
	el: '#app',
	components: {
		'status-form': StatusForm,
		'status-list': StatusList,
		'status-item': StatusItem,
		'friendship-btn': FriendshipBtn,
		'friendship-item': FriendshipItem
	}
})
