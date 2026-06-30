<x-app-layout>
    
    <main>
      <div class="container-small">
        <h1 class="car-details-page-title">Add new car</h1>
        <form
          action="{{ route('car.store') }}"
          method="POST"
          enctype="multipart/form-data"
          class="card add-new-car-form"
        >
          @csrf
          <div class="form-content">
            <div class="form-details">
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label>Maker</label>
                    <select id="makerSelect" name="maker_id">
                      <option value="">Maker</option>
                      @foreach($makers as $maker)
                        <option value="{{ $maker->id }}" @selected(old('maker_id') == $maker->id)>{{ $maker->name }}</option>
                      @endforeach
                    </select>
                    @error('maker_id')<p class="error-message">{{ $message }}</p>@enderror
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label>Model</label>
                    <select id="modelSelect" name="model_id">
                      <option value="" style="display: block">Model</option>
                      @foreach($models as $model)
                        <option value="{{ $model->id }}" data-parent="{{ $model->maker_id }}" style="display: none" @selected(old('model_id') == $model->id)>
                          {{ $model->name }}
                        </option>
                      @endforeach
                    </select>
                    @error('model_id')<p class="error-message">{{ $message }}</p>@enderror
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label>Year</label>
                    <select name="year">
                      <option value="">Year</option>
                      @for($y = date('Y'); $y >= 1990; $y--)
                        <option value="{{ $y }}" @selected(old('year') == $y)>{{ $y }}</option>
                      @endfor
                    </select>
                    @error('year')<p class="error-message">{{ $message }}</p>@enderror
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>Car Type</label>
                <div class="row">
                  @foreach($carTypes as $carType)
                    <div class="col">
                      <label class="inline-radio">
                        <input type="radio" name="car_type_id" value="{{ $carType->id }}" @checked(old('car_type_id') == $carType->id) />
                        {{ $carType->name }}
                      </label>
                    </div>
                  @endforeach
                </div>
                @error('car_type_id')<p class="error-message">{{ $message }}</p>@enderror
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label>Price</label>
                    <input type="number" name="price" placeholder="Price" value="{{ old('price') }}" />
                    @error('price')<p class="error-message">{{ $message }}</p>@enderror
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label>Vin Code</label>
                    <input name="vin" placeholder="Vin Code" value="{{ old('vin') }}" />
                    @error('vin')<p class="error-message">{{ $message }}</p>@enderror
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label>Mileage (ml)</label>
                    <input name="mileage" placeholder="Mileage" value="{{ old('mileage') }}" />
                    @error('mileage')<p class="error-message">{{ $message }}</p>@enderror
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>Fuel Type</label>
                <div class="row">
                  @foreach($fuelTypes as $fuelType)
                    <div class="col">
                      <label class="inline-radio">
                        <input type="radio" name="fuel_type_id" value="{{ $fuelType->id }}" @checked(old('fuel_type_id') == $fuelType->id) />
                        {{ $fuelType->name }}
                      </label>
                    </div>
                  @endforeach
                </div>
                @error('fuel_type_id')<p class="error-message">{{ $message }}</p>@enderror
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label>State/Region</label>
                    <select id="stateSelect" name="state_id">
                      <option value="">State/Region</option>
                      @foreach($states as $state)
                        <option value="{{ $state->id }}" @selected(old('state_id') == $state->id)>{{ $state->name }}</option>
                      @endforeach
                    </select>
                    @error('state_id')<p class="error-message">{{ $message }}</p>@enderror
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label>City</label>
                    <select id="citySelect" name="city_id">
                      <option value="" style="display: block">City</option>
                      @foreach($cities as $city)
                        <option value="{{ $city->id }}" data-parent="{{ $city->state_id }}" style="display: none" @selected(old('city_id') == $city->id)>
                          {{ $city->name }}
                        </option>
                      @endforeach
                    </select>
                    @error('city_id')<p class="error-message">{{ $message }}</p>@enderror
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label>Address</label>
                    <input name="address" placeholder="Address" value="{{ old('address') }}" />
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label>Phone</label>
                    <input name="phone" placeholder="Phone" value="{{ old('phone') }}" />
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col">
                    <label class="checkbox">
                      <input type="checkbox" name="air_conditioning" value="1" @checked(old('air_conditioning')) />
                      Air Conditioning
                    </label>

                    <label class="checkbox">
                      <input type="checkbox" name="power_windows" value="1" @checked(old('power_windows')) />
                      Power Windows
                    </label>

                    <label class="checkbox">
                      <input type="checkbox" name="power_door_locks" value="1" @checked(old('power_door_locks')) />
                      Power Door Locks
                    </label>

                    <label class="checkbox">
                      <input type="checkbox" name="abs" value="1" @checked(old('abs')) />
                      ABS
                    </label>

                    <label class="checkbox">
                      <input type="checkbox" name="cruise_control" value="1" @checked(old('cruise_control')) />
                      Cruise Control
                    </label>

                    <label class="checkbox">
                      <input type="checkbox" name="bluetooth_connectivity" value="1" @checked(old('bluetooth_connectivity')) />
                      Bluetooth Connectivity
                    </label>
                  </div>
                  <div class="col">
                    <label class="checkbox">
                      <input type="checkbox" name="remote_start" value="1" @checked(old('remote_start')) />
                      Remote Start
                    </label>

                    <label class="checkbox">
                      <input type="checkbox" name="gps_navigation" value="1" @checked(old('gps_navigation')) />
                      GPS Navigation System
                    </label>

                    <label class="checkbox">
                      <input type="checkbox" name="heated_seats" value="1" @checked(old('heated_seats')) />
                      Heated Seats
                    </label>

                    <label class="checkbox">
                      <input type="checkbox" name="climate_control" value="1" @checked(old('climate_control')) />
                      Climate Control
                    </label>

                    <label class="checkbox">
                      <input type="checkbox" name="rear_parking_sensors" value="1" @checked(old('rear_parking_sensors')) />
                      Rear Parking Sensors
                    </label>

                    <label class="checkbox">
                      <input type="checkbox" name="leather_seats" value="1" @checked(old('leather_seats')) />
                      Leather Seats
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>Detailed Description</label>
                <textarea name="description" rows="10">{{ old('description') }}</textarea>
              </div>
              <div class="form-group">
                <label class="checkbox">
                  <input type="checkbox" name="published" value="1" @checked(old('published')) />
                  Published
                </label>
              </div>
            </div>
            <div class="form-images">
              <div class="form-image-upload">
                <div class="upload-placeholder">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    style="width: 48px"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                    />
                  </svg>
                </div>
                <input id="carFormImageUpload" type="file" name="images[]" multiple />
              </div>
              <div id="imagePreviews" class="car-form-images"></div>
            </div>
          </div>
          <div class="p-medium" style="width: 100%">
            <div class="flex justify-end gap-1">
              <button type="reset" class="btn btn-default">Reset</button>
              <button class="btn btn-primary">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </main>

</x-app-layout>
