<template>
	
	<div class="modal fade">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" v-html="modal.title"></h5>
					<button type="button" class="close" v-on:click="$emit('hide-modal')" area-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<span v-html="modal.body"></span>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" v-on:click="$emit('hide-modal')">Cancel</button>
					<form v-bind:action="modal.action" method="POST">

						<input type="hidden" name="_token" :value="csrf">

						<input type="hidden" name="_method" value="DELETE">

						<button type="submit" class="btn btn-danger">Delete</button>

					</form>
				</div>
			</div>
		</div>
	</div>

</template>

<script>

	export default {

		data: function () {
			return {
				csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
			}
		},

		props: {
			modal: Object,
		},
		
	}

</script>