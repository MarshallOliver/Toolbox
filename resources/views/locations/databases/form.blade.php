<form-base form-action="{{ $action }}" form-method="{{ $method }}" :form-errors="{{ $errors->toJson() }}">
			
	<form-base-row>
		<form-base-input name="host" id="host" type="text" placeholder="Host IP Address" value="{{ $database->host ?? '' }}" class="col" required>
			Host
		</form-base-input>
		<form-base-input name="catalog" id="catalog" type="text" placeholder="Catalog" value="{{ $database->catalog ?? '' }}" class="col" required>
			Catalog
		</form-base-input>
		<form-base-input name="port" id="port" type="text" placeholder="Port Number" value="{{ $database->port ?? '' }}" class="col-2" required>
			Port
		</form-base-input>
	</form-base-row>

	<form-base-row>
		<form-base-input name="username" id="username" type="text" placeholder="Username" value="{{ $database->username ?? '' }}" class="col" required>
			Username
		</form-base-input>
	</form-base-row>

	<form-base-row>
		<form-base-input name="password" id="password" type="password" placeholder="Password" value="{{ $database->password ?? '' }}" autocomplete="off" class="col" required>
			Password
		</form-base-input>
	</form-base-row>

	<form-base-row>
		<form-base-submit class="col" :is-primary="true" cancel-action="/locations/{{ $location->id ?? $database->location_id }}/edit">Save</form-base-submit>
	</form-base-row>

</form-base>