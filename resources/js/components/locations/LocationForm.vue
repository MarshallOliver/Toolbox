<template>

	<form-base :form-route="route" :form-errors="errors">
		
		<form-base-row>
			<form-base-input name="short_name" id="short_name" type="text" placeholder="Short Name" class="col-3" required>
				Short Name
			</form-base-input>
			<form-base-input name="long_name" id="long_name" type="text" placeholder="Long Name" class="col" required>
				Long Name
			</form-base-input>
		</form-base-row>

		<form-base-row>
			<form-base-input name="address1" type="text" placeholder="Address 1" class="col" required>
				Address 1
			</form-base-input>
		</form-base-row>

		<form-base-row>
			<form-base-input name="address2" type="text" placeholder="Address 2" class="col">
				Address 2
			</form-base-input>
		</form-base-row>

		<form-base-row>
			<form-base-input name="city" type="text" placeholder="City" class="col" required>
				City
			</form-base-input>

			<form-base-input name="state" type="text" placeholder="State" class="col" required>
				State
			</form-base-input>

			<form-base-input name="zip_code" type="text" placeholder="Zip Code" class="col" pattern="^([0-9]{5}(?:-[0-9]{4})?)$" required>
				Zip Code
			</form-base-input>
		</form-base-row>

		<form-base-row>
			<form-base-submit class="col" :is-primary="true" cancel-action="/locations">Save</form-base-submit>
		</form-base-row>

	</form-base>

</template>

<script>

	export default {
		props: {
			route: {
				type: String,
				default: '',

			},

			errors: {
				type: Object,
				default: function () {
					return {

					}
				},

			},
		
		},

	}

</script>