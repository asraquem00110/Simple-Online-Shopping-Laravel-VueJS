import Vuex from 'vuex'
import Vue from 'vue'
import axios from 'axios'

Vue.use(Vuex)

export default new Vuex.Store({

	state: {
		status: '',
		token: localStorage.getItem('token') ? localStorage.getItem('token') : 'gg',
		user: {},
	},
	getters: {

	},
	actions: {
		
	},
	mutations: {
		
	}


});