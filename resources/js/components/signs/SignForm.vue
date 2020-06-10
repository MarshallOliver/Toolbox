<template>

	<form :action="action" :method="getMethod">

		<input v-if="method == 'update'" type="hidden" name="_method" value="PUT">

		<input v-if="method == 'destroy'" type="hidden" name="_method" value="DELETE">

		<input type="hidden" name="_token" :value="$parent.csrf">

		<div class="form-row">
			<div class="form-group col">
				<label for="name">Description</label>
				<input v-model="description" type="text" name="name" id="name" class="form-control" :class="{ 'is-invalid': errors.name }" placeholder="Enter a Description">
				<div v-if="errors.name" class="invalid-feedback">
					<span v-for="error in errors.name">
						{{ error }}
					</span>
				</div>
			</div>
		</div>

		<div class="form-row">

			<form-select-location

				:locations="locations"
				:disabled="!locations"
				:selected-location="location"
				@update:location="updateLocation">

				<div v-if="errors.location" class="invalid-feedback">
					<span v-for="error in errors.location">
						{{ error }}
					</span>
				</div>

			</form-select-location>

			<form-select-database

				:databases="databases"
				:disabled="!databases"
				:selected-database="database"
				@update:database="updateDatabase">

				<div v-if="errors.database" class="invalid-feedback">
					<span v-for="error in errors.database">
						{{ error }}
					</span>
				</div>

			</form-select-database>

		</div>

		<div class="form-row">

			<form-select-sign-type

				:sign-types="signTypes"
				:disabled="!database || !signTypes"
				:selected-sign-type="signType"
				@update:sign-type="updateSignType">

				<div v-if="errors.sign_type" class="invalid-feedback">
					<span v-for="error in errors.sign_type">
						{{ error }}
					</span>
				</div>

			</form-select-sign-type>

		</div>

		<div class="form-row">

			<div v-if="loading" class="form-group col">
				<div class="d-flex align-items-center">
					<strong>Loading...</strong>
					<div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
				</div>
			</div>

			<form-select-area 

				v-if="signType == 1 && !loading"
				:areas="areas"
				:disabled="!areas || !signType"
				:selectedArea="area"
				@update:area="updateArea">

				<div v-if="errors.area" class="invalid-feedback">
					<span v-for="error in errors.area">
						{{ error }}
					</span>
				</div>

			</form-select-area>

		</div>

		<div class="form-row">

			<div class="form-group col">

				<button type="submit" class="btn btn-primary">Save</button>

			</div>

		</div>

	</form>

</template>

<script>

	export default {
		data: function () {
			return {
				description: this.selectedDescription,
				databases: this.selectedDatabases,
				location: this.selectedLocation,
				database: this.selectedDatabase,
				signType: this.selectedSignType,
				area: this.selectedArea,

				loading: false,
				areas: null,

			}
		},

		props: {

			// Required:
			errors: Array,
			action: String,
			method: String,
			locations: Array,
			signTypes: Array,
			
			// Optional:
			selectedDatabases: {
				type: Array,
				default: null,
			},

			selectedDescription: {
				type: String,
				default: '',

			},

			selectedLocation: {
				type: Number,
				default: 0,
			},

			selectedDatabase: {
				type: Number,
				default: 0,
			},

			selectedSignType: {
				type: Number,
				default: 0,
			},

			selectedArea: {
				type: String,
				default: '',

			},

		},

		mounted () {
			this.loadSignType();
		},

		computed: {
			getMethod: function () {
				switch (this.method) {
					case 'index':
					case 'create':
					case 'show':
					case 'edit':
						return 'GET';
						break;
					case 'store':
					case 'update':
					case 'destroy':
						return 'POST';
						break;
				}
			},
		},

		methods: {
			updateLocation: function (location) {
				this.location = location.id;
				this.databases = location.databases;
				this.updateDatabase(0);

			},

			updateDatabase: function (database) {
				this.database = database;
				this.updateSignType(0);

			},

			updateSignType: function (type) {
				this.signType = type;
				this.loadSignType();
				this.resetRequiredFields();

			},

			loadSignType: function () {

				if (this.signType === 1) {
			        this.loading = true;
			        axios.get('/api/catalog/' + this.database + '/areas')
			        .then((response) => {
			          this.areas = response.data.data;
			          this.loading = false;
			        })
			        .catch(function (error) {
			          console.log(error);
			        });
			      
			  	}

			},

			updateArea: function (area) {
				this.area = area;

			},

			resetRequiredFields: function () {
				this.updateArea('');

			},

		},

	}

</script>