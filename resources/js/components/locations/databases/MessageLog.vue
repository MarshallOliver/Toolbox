<template>

	<div class="container">

		<div class="row">
			<div class="col">
				<h1>{{ logLocation.long_name }} {{ logDatabase.catalog }} - Message Log</h1>
			</div>
		</div>

		<form-base form-action="#" form-method="POST" on-submit="prevent">
			
			<form-base-row>
				<form-base-input name="message" id="message" type="text" placeholder="Message Text" class="col-8">
					Message Text
				</form-base-input>
				<form-base-input name="startdate" id="startdate" type="date" :value="startDate" class="col">
					Start Date
				</form-base-input>
				<form-base-input name="starttime" id="starttime" type="time" :value="startTime" class="col">
					Start Time
				</form-base-input>
			</form-base-row>

			<form-base-row>
				<div class="col-8">
					<form-base-row>
						<form-base-input name="program" id="program" type="text" placeholder="Program" :value="program" class="col" disabled>
							Program
						</form-base-input>
						<form-base-input name="station" id="station" type="text" placeholder="Station Number" :value="station" class="col" disabled>
							Station
						</form-base-input>
						<form-base-input name="employee" id="employee" type="text" placeholder="Employee" :value="employee" class="col" disabled>
							Employee
						</form-base-input>
					</form-base-row>
				</div>
				<form-base-input name="enddate" id="enddate" type="date" :value="endDate" class="col">
					End Date
				</form-base-input>
				<form-base-input name="endtime" id="endtime" type="time" :value="endTime" class="col">
					End Time
				</form-base-input>
			</form-base-row>

		</form-base>

		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th scope="col" class="col-2">MsgDateTime</th>
					<th scope="col" class="col-2">Program</th>
					<th scope="col" class="col-1">Station</th>
					<th scope="col" class="col-1">Employee</th>
					<th scope="col">Message</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="message in messageLog">
					<td>{{ message.message_date_time | dateTime }}</td>
					<td>{{ message.program_name }}</td>
					<td>{{ message.station_no }}</td>
					<td>{{ message.emp_no }}</td>
					<td>{{ message.message_text }}</td>
				</tr>						
			</tbody>
		</table>

		<div v-if="lastPage <=5" class="btn-group" role="group" aria-label="Message log navigation links">
			<button v-on:click.prevent="updateCurrentPage(1)" type="button" class="btn" :class="[currentPage == 1 ? 'btn-dark' : 'btn-secondary']">First</button>
			<button v-if="lastPage >= 2" v-on:click.prevent="updateCurrentPage(2)" type="button" class="btn" :class="[currentPage == 2 ? 'btn-dark' : 'btn-secondary']">{{ lastPage == 2 ? 'Last' : '2' }}</button>
			<button v-if="lastPage >= 3" v-on:click.prevent="updateCurrentPage(3)" type="button" class="btn" :class="[currentPage == 3 ? 'btn-dark' : 'btn-secondary']">{{ lastPage == 3 ? 'Last' : '3' }}</button>
			<button v-if="lastPage >=4" v-on:click.prevent="updateCurrentPage(4)" type="button" class="btn" :class="[currentPage == 4 ? 'btn-dark' : 'btn-secondary']">{{ lastPage == 4 ? 'Last' : '4' }}</button>
			<button v-if="lastPage >= 5" v-on:click.prevent="updateCurrentPage(5)" type="button" class="btn" :class="[currentPage == 5 ? 'btn-dark' : 'btn-secondary']">{{ lastPage == 5 ? 'Last' : '5' }}</button>
		</div>
		
		<div v-else class="d-flex justify-content-between btn-group" role="group" aria-label="Message log navigation links">
			<div class="btn-group mr-2" role="group" aria-label="First 5 Pages">
				<button v-on:click.prevent="updateCurrentPage(1)" type="button" class="btn" :class="[currentPage == 1 ? 'btn-dark' : 'btn-secondary']">First</button>
				<button v-if="currentPage <= 3 && lastPage > 1" v-on:click.prevent="updateCurrentPage(2)" type="button" class="btn" :class="[currentPage == 2 ? 'btn-dark' : 'btn-secondary']">2</button>
				<button v-if="currentPage <= 3 && lastPage > 2" v-on:click.prevent="updateCurrentPage(3)" type="button" class="btn" :class="[currentPage == 3 ? 'btn-dark' : 'btn-secondary']">3</button>
				<button v-if="currentPage <= 3 && lastPage > 3" v-on:click.prevent="updateCurrentPage(4)" type="button" class="btn" :class="[currentPage == 4 ? 'btn-dark' : 'btn-secondary']">4</button>
				<button v-if="currentPage <= 3 && lastPage > 4" v-on:click.prevent="updateCurrentPage(5)" type="button" class="btn" :class="[currentPage == 5 ? 'btn-dark' : 'btn-secondary']">5</button>
			</div>
			<div v-if="(currentPage > 3) && (lastPage - currentPage >= 3)" class="btn-group mr-2" role="group" aria-label="Nearest 5 Pages">
				<button v-on:click.prevent="updateCurrentPage(currentPage - 2)" type="button" class="btn btn-secondary">{{ currentPage - 2 }}</button>
				<button v-on:click.prevent="updateCurrentPage(currentPage - 1)" type="button" class="btn btn-secondary">{{ currentPage - 1 }}</button>
				<button v-on:click.prevent="updateCurrentPage(currentPage)" type="button" class="btn btn-dark">{{ currentPage }}</button>
				<button v-on:click.prevent="updateCurrentPage(currentPage + 1)" type="button" class="btn btn-secondary">{{ currentPage + 1 }}</button>
				<button v-on:click.prevent="updateCurrentPage(currentPage + 2)" type="button" class="btn btn-secondary">{{ currentPage + 2 }}</button>
			</div>
			<div class="btn-group" role="group" aria-label="Last 5 Pages">
				<button v-if="lastPage - currentPage < 3" v-on:click.prevent="updateCurrentPage(lastPage - 4)" type="button" class="btn" :class="[currentPage == lastPage - 4 ? 'btn-dark' : 'btn-secondary']">{{ lastPage - 4 }}</button>
				<button v-if="lastPage - currentPage < 3" v-on:click.prevent="updateCurrentPage(lastPage - 3)" type="button" class="btn" :class="[currentPage == lastPage - 3 ? 'btn-dark' : 'btn-secondary']">{{ lastPage - 3 }}</button>
				<button v-if="lastPage - currentPage < 3" v-on:click.prevent="updateCurrentPage(lastPage - 2)" type="button" class="btn" :class="[currentPage == lastPage - 2 ? 'btn-dark' : 'btn-secondary']">{{ lastPage - 2 }}</button>
				<button v-if="lastPage - currentPage < 3" v-on:click.prevent="updateCurrentPage(lastPage - 1)" type="button" class="btn" :class="[currentPage == lastPage - 1 ? 'btn-dark' : 'btn-secondary']">{{ lastPage - 1 }}</button>
				<button v-on:click.prevent="updateCurrentPage(lastPage)" type="button" class="btn" :class="[currentPage == lastPage ? 'btn-dark' : 'btn-secondary']">Last</button>
			</div>
		</div>

	</div>	

</template>

<script>

	import DebugMixin from 'mixins/DebugMixin';
	import moment from 'moment';

	export default {
		data: function () {
			return {
				messageText: '',
				startDate: '2020-06-24',
				startTime: '00:00',
				endDate: '2020-06-24',
				endTime: '23:59',
				messageLog: [],
				program: null,
				station: null,
				employee: null,
				requestedPage: 1,
				currentPage: 1,
				lastPage: 1,
				isLoading: true,

			}
		},

		props: {
			logLocation: {
				type: Object,
				default: null,

			},

			logDatabase: {
				type: Object,
				default: null,

			},

		},

		computed: {
			startDateTime: function () {
				return moment(this.startDate + ' ' + this.startTime).format('YYYY-MM-DD HH:mm:ss');

			},

			endDateTime: function () {
				return moment(this.endDate + ' ' + this.endTime).format('YYYY-MM-DD HH:mm:ss');

			},

			uri: function () {
				return '/api/catalog/' + this.logDatabase.id + '/messagelog?filter[messagelog][message_date_time][gte]=' + this.startDateTime + '&filter[messagelog][message_date_time][lte]=' + this.endDateTime + '&filter[messagelog][message_text][like]=' + this.messageText + '&page=' + this.requestedPage;

			},

		},

		methods: {
			getMessageLog: function () {
				this.isLoading = true;
				return axios.get(this.uri)
				.then((response) => {
					this.messageLog = response.data.data;
					this.lastPage = response.data.meta.last_page;
					this.debugLevel(['messageLog successfully loaded: ' + moment().format('YYYY-MM-DD HH:mm:ss'), this.messageLog, this.uri]);
					this.isLoading = false;
				})
				.catch((error) => {
					this.debugLevel(['Error in getMessageLog: ' + moment().format('YYYY-MM-DD HH:mm:ss'), this.uri, error]);
				});

			},

			updateMessageText: function (value) {
				this.messageText = value;
				this.updateCurrentPage(1);

			},

			updateStartDate: function (value) {
				this.startDate = value;
				this.updateCurrentPage(1);

			},

			updateStartTime: function (value) {
				this.startTime = value;
				this.updateCurrentPage(1);

			},

			updateEndDate: function (value) {
				this.endDate = value;
				this.updateCurrentPage(1);

			},

			updateEndTime: function (value) {
				this.endTime = value;
				this.updateCurrentPage(1);

			},

			updateProgram: function (value) {
				this.program = value;
				this.updateCurrentPage(1);

			},

			updateStation: function (value) {
				this.station = value;
				this.updateCurrentPage(1);

			},

			updateEmployee: function (value) {
				this.employee = value;
				this.updateCurrentPage(1);

			},

			updateCurrentPage: async function (value) {
				this.requestedPage = value;
				await this.getMessageLog();
				this.currentPage = this.requestedPage;

			}

		},

		filters: {
			dateTime: function (value) {
				return moment(value).format('YYYY-MM-DD HH:mm:ss');
			}

		},

		mounted: function () {
			this.$root.$on('update:message', this.updateMessageText);
			this.$root.$on('update:startdate', this.updateStartDate);
			this.$root.$on('update:starttime', this.updateStartTime);
			this.$root.$on('update:enddate', this.updateEndDate);
			this.$root.$on('update:endtime', this.updateEndTime);
			this.$root.$on('update:program', this.updateProgram);
			this.$root.$on('update:station', this.updateStation);
			this.$root.$on('update:employee', this.updateEmployee);

			this.getMessageLog();

		},

		mixins: [DebugMixin],

	}

</script>