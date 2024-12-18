@extends('admin.layouts.master')

@section('title', 'Add Car')

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
                    <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="image">Car Image</label>
                            <input type="file" name="image[]" id="image" class="form-control" multiple>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="marke_id">Car Marke</label>
                                <select name="marke_id" id="marke_id" class="form-control">
                                    <option value="" disabled selected>Select Marke</option>
                                    @foreach ($markes as $marke)
                                        <option value="{{ $marke->id }}">{{ $marke->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="model_id">Car Model</label>
                                <select name="model_id" id="model_id" class="form-control">
                                    <option value="" disabled selected>Select Model</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="year">Year</label>
                                <input type="number" name="year" id="year" class="form-control"
                                    placeholder="e.g., 2024" min="1900" max="{{ date('Y') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="engine_type">Engine Type</label>
                                <input type="text" name="engine_type" id="engine_type" class="form-control"
                                    placeholder="Petrol/Diesel/Electric">
                            </div>

                            <div class="col-md-4">
                                <label for="color">Color</label>
                                <input type="text" name="color" id="color" class="form-control"
                                    placeholder="e.g., Red">
                            </div>

                            <div class="col-md-4">
                                <label for="seats">Seats</label>
                                <input type="number" name="seats" id="seats" class="form-control"
                                    placeholder="e.g., 5" min="1">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="doors">Doors</label>
                                <input type="number" name="doors" id="doors" class="form-control"
                                    placeholder="e.g., 4" min="1">
                            </div>

                            <div class="col-md-4">
                                <label for="price">Price</label>
                                <input type="number" name="price" id="price" step="0.01" class="form-control"
                                    placeholder="e.g., 20000">
                            </div>

                            <div class="col-md-4">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="available">Available</option>
                                    <option value="sold">Sold</option>
                                    <option value="reserved">Reserved</option>
                                </select>
                            </div>
                        </div>

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
                let markeId = $(this).val();
                let modelSelect = $('#model_id');

                modelSelect.html(
                    '<option value="" disabled selected>Loading...</option>'); // Loading indicator

                $.ajax({
                    url: `/get-models/${markeId}`,
                    method: 'GET',
                    success: function(data) {
                        modelSelect.html(
                            '<option value="" disabled selected>Select Model</option>'
                        ); // Reset options
                        data.forEach(function(model) {
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
