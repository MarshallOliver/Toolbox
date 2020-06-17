<template>
	<div>
		<form-base-row>
			<form-base-select name="sign_type" id="sign_type" :form-options="{ options: signTypes, keyBy: 'id', listBy: 'name' }" :value="selectedSignType" class="col" required>
				Sign Type
			</form-base-select>
		</form-base-row>

		<form-base-row v-if="selectedSignType == 1">
			
			<div v-if="loadingArea" class="form-group col">
				<div class="d-flex align-items-center">
					<strong>Loading...</strong>
					<div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
				</div>
			</div>			
			
			<form-base-select v-else name="area" id="area" :form-options="areaOptions" :value="selectedArea" class="col" :loading="loadingArea" required>
				Area
			</form-base-select>
		
		</form-base-row>
	</div>

</template>

<script>

	export default {
		mounted() {
			this.updateAreas();
			this.$root.$on('update:location_id', this.resetDatabase);
			this.$root.$on('update:database_id', this.updateDatabase);
			this.$root.$on('update:sign_type_id', this.updateSignType);

		},

		data: function () {
			return {
				areaOptions: {
					options: [],
					keyBy: 'area_guid',
					listBy: 'description',

				},

				selectedSignType: this.formOptions.selectedType,
				selectedArea: this.formOptions.selectedArea,
				selectedDatabase: this.formOptions.selectedDatabase,
				loadingArea: false,

			}
		},

		props: {
			formOptions: {
				type: Object,
				default: function () {
					return {}
				},

			},

			signTypes: {
				type: Array,

			},
		
		},

		methods: {
			updateDatabase: function (value) {
				this.selectedDatabase = value;
				this.updateAreas();

			},

			updateSignType: function (value) {
				this.selectedSignType = value;

			},

			updateAreas: function () {
				if (this.selectedDatabase) {			
					this.loadingArea = true;
					axios.get('/api/catalog/' + this.selectedDatabase + '/areas')
					.then((response) => {
						this.areaOptions.options = response.data.data;
						this.loadingArea = false;
					})
					.catch(function (error) {
						console.log(error);
					});
				}
			},

			resetDatabase: function () {
				this.selectedDatabase = '';
				this.selectedArea = '';
				this.areaOptions.options = [];

			},

		},

	}

</script>