require('./bootstrap');

const Vue = require('vue')

import StatusForm from './components/StatusForm'
import StatusItem from './components/StatusItem'

/*Vue.component('status-form', StatusForm)
Vue.component('status-item', StatusItem)*/

const app = new Vue({
	el: '#app',
	components: {
		'status-form': StatusForm,
		'status-item': StatusItem
	}
})
