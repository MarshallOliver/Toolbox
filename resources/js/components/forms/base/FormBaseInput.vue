<template>

	<div class="form-group">

		<label :for="$attrs.id"><slot></slot></label>
		<input v-bind="$attrs" class="form-control" :class="{ 'is-invalid': formErrors[$attrs.name] }">
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

	}

</script>