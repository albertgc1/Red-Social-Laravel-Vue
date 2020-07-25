require('./bootstrap');

const Vue = require('vue')

import StatusForm from './components/StatusForm'
import StatusList from './components/StatusList'
import StatusItem from './components/StatusItem'

window.EventBus = new Vue()

import auth from './mixins/auth'
Vue.mixin(auth)

const app = new Vue({
	el: '#app',
	components: {
		'status-form': StatusForm,
		'status-list': StatusList,
		'status-item': StatusItem
	}
})
