@extends('admin.layouts.master')

@section('title', 'Edit Car')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <!-- Display validation errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Display success message -->
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <!-- Car form -->
                    <form action="{{ route('cars.update', $car->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        @forelse ($car->images as $image)
                        <div class="form-group">
                            <img src="{{ asset('storage/' . $image->image_path) }}" class="car-image" width="50" alt="">
                            <label for="image">Car Image</label>
                            <input type="file" name="image[]" id="image" value="{{ old('image', $image->image_path) }}" class="form-control" multiple>
                        </div>
                        @empty
                        <div class="form-group">
                            <label for="image">Car Image</label>
                            <input type="file" name="image[]" id="image" class="form-control" multiple>
                        </div>
                        @endforelse

                        <div class="row form-group">
                            <!-- Car Marke -->
                            <div class="col-md-4">
                                <label for="marke_id">Car Marke</label>
                                <select name="marke_id" id="marke_id" class="form-control">
                                    <option value="" disabled selected>Select Marke</option>
                                    @foreach ($markes as $marke)
                                        <option value="{{ $marke->id }}"
                                            {{ $car->marke_id == $marke->id ? 'selected' : '' }}>
                                            {{ $marke->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Car Model -->
                            <div class="col-md-4">
                                <label for="model_id">Car Model</label>
                                <select name="model_id" id="model_id" class="form-control">
                                    <option value="" disabled selected>Select Model</option>
                                    @foreach ($models as $model)
                                        <option value="{{ $model->id }}"
                                            {{ $car->model_id == $model->id ? 'selected' : '' }}>
                                            {{ $model->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Year -->
                            <div class="col-md-4">
                                <label for="year">Year</label>
                                <input type="number" name="year" id="year" class="form-control"
                                    placeholder="e.g., 2024" value="{{ old('year', $car->year) }}" min="1900"
                                    max="{{ date('Y') }}">
                            </div>
                        </div>

                        <div class="row form-group">
                            <!-- Engine Type -->
                            <div class="col-md-4">
                                <label for="engine_type">Engine Type</label>
                                <input type="text" name="engine_type" id="engine_type" class="form-control"
                                    placeholder="Petrol/Diesel/Electric"
                                    value="{{ old('engine_type', $car->engine_type) }}">
                            </div>

                            <!-- Color -->
                            <div class="col-md-4">
                                <label for="color">Color</label>
                                <input type="text" name="color" id="color" class="form-control"
                                    placeholder="e.g., Red" value="{{ old('color', $car->color) }}">
                            </div>

                            <!-- Seats -->
                            <div class="col-md-4">
                                <label for="seats">Seats</label>
                                <input type="number" name="seats" id="seats" class="form-control"
                                    placeholder="e.g., 5" value="{{ old('seats', $car->seats) }}" min="1">
                            </div>

                        </div>

                        <div class="row form-group">
                            <!-- Doors -->
                            <div class="col-md-4">
                                <label for="doors">Doors</label>
                                <input type="number" name="doors" id="doors" class="form-control"
                                    placeholder="e.g., 4" value="{{ old('doors', $car->doors) }}" min="1">
                            </div>

                            <!-- Price -->
                            <div class="col-md-4">
                                <label for="price">Price</label>
                                <input type="number" name="price" id="price" step="0.01" class="form-control"
                                    placeholder="e.g., 20000" value="{{ old('price', $car->price) }}">
                            </div>

                            <!-- Status -->
                            <div class="col-md-4">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="available" {{ $car->status == 'available' ? 'selected' : '' }}>Available
                                    </option>
                                    <option value="sold" {{ $car->status == 'sold' ? 'selected' : '' }}>Sold</option>
                                    <option value="reserved" {{ $car->status == 'reserved' ? 'selected' : '' }}>Reserved
                                    </option>
                                </select>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary btn-sm">Save Car</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#marke_id').change(function() {
                const markeId = $(this).val();
                const modelSelect = $('#model_id');

                modelSelect.html(
                    '<option value="" disabled selected>Loading...</option>'); // Loading indicator

                $.ajax({
                    url: `/get-models/${markeId}`,
                    method: 'GET',
                    success: function(models) {
                        modelSelect.html(
                            '<option value="" disabled selected>Select Model</option>'
                        ); // Reset options
                        models.forEach(function(model) {
                            modelSelect.append(
                                `<option value="${model.id}">${model.name}</option>`
                            );
                        });
                    },
                    error: function() {
                        alert('Unable to load models. Please try again.');
                        modelSelect.html(
                            '<option value="" disabled selected>Select Model</option>');
                    }
                });
            });
        });
    </script>
@endsection
