/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 Vue.component('app')

const app = new Vue({
    el: '#app',
 	data: function () {
 		return {
      selectedLocation: 0,
      selectedDatabase: 0,
      selectedSignType: 0,
      selectedArea: 0,
      areas: null,
      loading: false,
 			modal: {
				title: '',
				body: '',
				action: '',
			}
 		}
 	},

  methods: {
		showModal: function (name, action, title = null, body = null) {

			this.modal.action = action;

			this.modal.title = title ? title : 'Delete ' + name + '?';
			this.modal.body = body ? body : 'Are you sure you want to DELETE ' + name + '?';

			$('.modal').modal('show');

		},

		hideModal: function () {

			$('.modal').modal('hide');

		},

    resetSelectedDatabase: function () {
      this.selectedDatabase = 0;
      this.selectedSignType = 0;
      this.selectedArea = 0;
      this.areas = null;
    },

    loadSignType: function () {
      this.loading = true;
      if (this.selectedSignType === 1) {
        axios.get('/api/catalog/' + this.selectedDatabase + '/areas')
        .then((response) => {
          this.areas = response.data.data;
          this.loading = false;
        })
        .catch(function (error) {
          console.log(error);
        });
      }
      console.log(this.areas);
    }

	},

});
