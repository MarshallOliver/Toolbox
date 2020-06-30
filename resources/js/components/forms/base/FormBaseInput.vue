<template>

	<div class="form-group">

		<label :for="$attrs.id"><slot></slot></label>
		<input v-bind="$attrs" v-model="value" @change="broadcastUpdate" class="form-control" :class="{ 'is-invalid': formErrors[$attrs.name] }">
		<div v-if="formErrors[$attrs.name]" class="invalid-feedback">
			<span v-for="message in formErrors[$attrs.name]">
				{{ message }}
			</span>
		</div>

	</div>

</template>

<script>

	import DebugMixin from 'mixins/DebugMixin';

	export default {
		data: function () {
			return {
				value: this.$attrs.value,

			}
		},

		methods: {
			broadcastUpdate: function () {
				this.$root.$emit('update:' + this.$attrs.name, this.value);
			
			},

		},

		inheritAttrs: false,
		inject: ['formErrors'],
		mixins: [DebugMixin],

	}

</script>