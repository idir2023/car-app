@extends('admin.layouts.master')

@section('title')
    Manage Cars
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- Display Success Message -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        <div class="col-md-12">
            <!-- Card Container -->
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3 class="card-title">Manage Cars</h3>
                    <a href="{{ route('cars.create') }}" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-plus"></i> Add New Car
                    </a>
                </div>

                <div class="card-body">
                    <!-- Cars Table -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="carsTable">
                            <thead class="bg-light">
                                <tr>
                                    <th>#</th>
                                    <th>Brand</th>
                                    <th>Model</th>
                                    <th>Year</th>
                                    <th>Engine Type</th>
                                    <th>Color</th>
                                    <th>Seats</th>
                                    <th>Doors</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($cars as $car)
                                    <tr>
                                        <td class="car-image-cell">
                                            <!-- Dynamically load image here -->
                                            <img class="car-image" src="{{ asset('storage/' . ($car->images->first()->image_path ?? 'default.jpg')) }}" alt="Car Image" width="50">
                                        </td>
                                        <td>{{ $car->marke->name ?? 'N/A' }}</td>
                                        <td>{{ $car->modelCar->name ?? 'N/A' }}</td>
                                        <td>{{ $car->year ?? 'N/A' }}</td>
                                        <td>{{ $car->engine_type ?? 'N/A' }}</td>
                                        <td>{{ $car->color ?? 'N/A' }}</td>
                                        <td>{{ $car->seats ?? 'N/A' }}</td>
                                        <td>{{ $car->doors ?? 'N/A' }}</td>
                                        <td>${{ number_format($car->price, 2) }}</td>
                                        <td>
                                            <span
                                                class="badge bg-{{ $car->status === 'available' ? 'success' : ($car->status === 'reserved' ? 'warning' : 'danger') }}">
                                                {{ ucfirst($car->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('cars.edit', $car->id) }}"
                                                    class="btn btn-sm btn-outline-primary" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('cars.destroy', $car->id) }}" method="POST"
                                                    class="d-inline" id="deleteCarForm{{ $car->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                                        title="Delete" onclick="confirmDelete({{ $car->id }})">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="11" class="text-center text-muted">No cars available.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#carsTable').DataTable({
                responsive: true,
                autoWidth: true,
                processing: true,
                order: [
                    [0, 'asc']
                ]
            });
        });

        function confirmDelete(carId) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'danger',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteCarForm' + carId).submit();
                }
            });
        }
    </script>
@endsection
