<template>

	<div class="form-group">

		<label :for="$attrs.id"><slot></slot></label>
		<select v-bind="$attrs" class="form-control" :class="{ 'is-invalid': formErrors[$attrs.name] }" v-model="$attrs.value" v-on:change="broadcastUpdate" :disabled="isDisabled">
			<option value="" disabled>Select a <slot></slot></option>
			<option v-for="option in options" :value="option[optionKey]">{{ option[optionDesc] }}</option> 
		</select>
		<div v-if="formErrors[$attrs.name]" class="invalid-feedback">
			<span v-for="message in formErrors[$attrs.name]">
				{{ message }}
			</span>
		</div>

	</div>

</template>

<script>

	export default {

		inheritAttrs: false,
		inject: ['formErrors'],

		mounted() {
			this.$root.$on('update:' + this.filterKey, this.updateFilter);

		},

		data: function () {
			return {
				optionKey: this.formOptions.keyBy,
				optionDesc: this.formOptions.listBy,
				filterKey: this.formOptions.filterBy,
				filterValue: this.formOptions.filterValue,

			}
		},

		props: {
			formOptions: {
				type: Object,
				default: function () {
					return {}
				},
		
			},

		},

		computed: {
			options: function () {
				if (this.filterKey) {
					return this.formOptions.options.filter(this.filterOptions);
				} else {
					return this.formOptions.options;
				}
			},

			broadcastKey: function () {
				return this.optionKey == 'id' ? this.$attrs.name + '_' + this.optionKey : this.optionKey;
			},

			isDisabled: function () {
				return this.options.length == 0 ? true : false;
			}

		},

		methods: {
			broadcastUpdate: function () {
				this.$root.$emit('update:' + this.broadcastKey, this.$attrs.value);
			
			},

			filterOptions: function (value) {
				return value[this.filterKey] == (this.filterValue ? this.filterValue : 0);
			},

			updateFilter: function (value) {
				this.$attrs.value = '';
				this.filterValue = value;

			},
			
		},

	}

</script>