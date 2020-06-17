<template>

	<form :action="formAction" method="POST">

		<input v-if="requestsPutMethod" type="hidden" name="_method" value="PUT" />

		<input v-if="requestsDeleteMethod" type="hidden" name="_method" value="DELETE" />

		<input type="hidden" name="_token" :value="csrf" />

		<slot></slot>

	</form>

</template>

<script>

	export default {

		data: function () {
			return {
				csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),

			}
		},

		computed: {
			requestsPutMethod: function () {
				return this.formMethod == 'PUT' ? true : false;
			},

			requestsDeleteMethod: function () {
				return this.formMethod == 'DELETE' ? true : false;
			},

		},

		props: {
			formAction: {
				type: String,
				default: '',

			},

			formMethod: {
				type: String,
				default: '',

			},

			formErrors: {
				type: [Object, Array],
				default: function () {
					return {

					}

				},

			},

		},

		provide: function () {
			return {
				formErrors: this.formErrors,
			}
		
		},

	}

</script>