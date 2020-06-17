<form-base form-action="{{ $action }}" form-method="{{ $method }}" :form-errors="{{ $errors->toJson() }}">
			
	<form-base-row>
		<form-base-input name="short_name" id="short_name" type="text" placeholder="Short Name" value="{{ $location->short_name ?? '' }}" class="col-3" required>
			Short Name
		</form-base-input>
		<form-base-input name="long_name" id="long_name" type="text" placeholder="Long Name" value="{{ $location->long_name ?? '' }}" class="col" required>
			Long Name
		</form-base-input>
	</form-base-row>

	<form-base-row>
		<form-base-input name="address1" id="address1" type="text" placeholder="Address 1" value="{{ $location->address1 ?? '' }}" class="col" required>
			Address 1
		</form-base-input>
	</form-base-row>

	<form-base-row>
		<form-base-input name="address2" id="address2" type="text" placeholder="Address 2" value="{{ $location->address2 ?? '' }}" class="col">
			Address 2
		</form-base-input>
	</form-base-row>

	<form-base-row>
		<form-base-input name="city" id="city" type="text" placeholder="City" value="{{ $location->city ?? '' }}" class="col" required>
			City
		</form-base-input>

		<form-base-input name="state" id="state" type="text" placeholder="State" value="{{ $location->state ?? '' }}" class="col" required>
			State
		</form-base-input>

		<form-base-input name="zip_code" id="zip_code" type="text" placeholder="Zip Code" value="{{ $location->zip_code ?? '' }}" class="col" pattern="^([0-9]{5}(?:-[0-9]{4})?)$" required>
			Zip Code
		</form-base-input>
	</form-base-row>

	<form-base-row>
		<form-base-submit class="col" :is-primary="true" cancel-action="/locations">Save</form-base-submit>
	</form-base-row>

</form-base>