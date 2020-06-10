<template>

	<div class="form-group col">
		<label for="database">Database</label>
		<select v-model="database" v-on:change="updateDatabase" name="database" id="database" class="form-control" :class="{ 'is-invalid': $parent.errors.database }"v-bind:disabled="disabled">
			<option value="0" disabled>Select a Database</option>
			<option v-for="database in databases" v-bind:value="database.id">{{ database.catalog }}</option>
		</select>
		<slot></slot>
	</div>

</template>

<script>

	export default {
		data: function () {
			return {
				database: this.selectedDatabase,

			}
		},

		props: {
			disabled: {
				type: Boolean,
				default: false,

			},

			selectedDatabase: {
				type: Number,
				default: 0,

			},

			databases: Array,

		},

		watch: {
			selectedDatabase: function () {
				this.database = this.selectedDatabase;
			},

		},

		methods: {
			updateDatabase () {
				this.$emit('update:database', this.database);
			},

		},

	}

</script>