@extends('admin.layouts.master')

@section('title')
    Model Cars
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
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3 class="card-title">Model Cars</h3>
                    <button class="btn btn-outline-primary btn-sm" id="addModelBtn">Add New Model</button>
                </div>
                <div class="card-body">
                    <table id="model_cars-table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Marke</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Table data will be populated dynamically -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add New Model Modal -->
    <div class="modal fade" tabindex="-1" id="addModelModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Model</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('model_cars.store') }}" id="addModelForm">
                        @csrf
                        <div class="form-group">
                            <label for="modelName">Model Name</label>
                            <input type="text" class="form-control" id="modelName" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="markeId">Select Marke</label>
                            <select name="marke_id" id="markeId" class="form-control" required>
                                <option value="">Select a Marke</option>
                                @foreach ($markes as $marke)
                                    <option value="{{ $marke->id }}">{{ $marke->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveModelBtn">Save Model</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Model Modal -->
    <div class="modal fade" tabindex="-1" id="editModelModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Model</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ url('model_cars') }}" id="editModelForm">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="editModelName">Model Name</label>
                            <input type="text" class="form-control" id="editModelName" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="editModelMarkeId">Select Marke</label>
                            <select name="marke_id" id="editModelMarkeId" class="form-control" required>
                                <option value="">Select a Marke</option>
                                @foreach ($markes as $marke)
                                    <option value="{{ $marke->id }}">{{ $marke->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="updateModelBtn">Update Model</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            var table = $('#model_cars-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('model_cars.index') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'marke',
                        name: 'marke'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // Open Add New Model Modal
            $('#addModelBtn').on('click', function() {
                $('#addModelModal').modal('show');
            });

            // Save New Model
            $('#saveModelBtn').on('click', function() {
                var formData = $('#addModelForm').serialize();

                // Send the request using jQuery AJAX
                $.ajax({
                    url: '{{ route('model_cars.store') }}',
                    method: 'POST',
                    data: formData,
                    success: function(data) {
                        $('#addModelModal').modal('hide');
                        Swal.fire({
                            title: 'Success!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: 'Okay'
                        }).then(() => {
                            table.ajax.reload(); // Reload DataTable
                        });
                    },
                    error: function(xhr, status, error) {
                        Swal.fire('Error!', 'There was an error adding the model.', 'error');
                    }
                });
            });

            // Edit Model
            $(document).on('click', '.editBtn', function() {
                var modelId = $(this).data('id');
                $.ajax({
                    url: '{{ url('model_cars') }}/' + modelId + '/edit',
                    method: 'GET',
                    success: function(data) {
                        $('#editModelName').val(data.name);
                        $('#editModelMarkeId').val(data.marke_id);
                        $('#editModelForm').attr('action', '{{ url('model_cars') }}/' +
                            modelId);
                        $('#editModelModal').modal('show');
                    },
                    error: function() {
                        Swal.fire('Error!', 'There was an error fetching the model details.',
                            'error');
                    }
                });
            });

            // Update Model
            $('#updateModelBtn').on('click', function() {
                var formData = $('#editModelForm').serialize();

                $.ajax({
                    url: $('#editModelForm').attr('action'),
                    method: 'PUT',
                    data: formData,
                    success: function(data) {
                        $('#editModelModal').modal('hide');
                        Swal.fire({
                            title: 'Updated!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: 'Okay'
                        }).then(() => {
                            table.ajax.reload(); // Reload DataTable
                        });
                    },
                    error: function() {
                        Swal.fire('Error!', 'There was an error updating the model.', 'error');
                    }
                });
            });

            // Delete Model
            $(document).on('click', '.deleteBtn', function() {
                var modelId = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This action cannot be undone.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ url('model_cars') }}/' + modelId,
                            method: 'DELETE',
                            success: function(data) {
                                Swal.fire({
                                    title: 'Deleted!',
                                    text: data.message,
                                    icon: 'success',
                                    confirmButtonText: 'Okay'
                                }).then(() => {
                                    table.ajax.reload(); // Reload DataTable
                                });
                            },
                            error: function() {
                                Swal.fire('Error!',
                                    'There was an error deleting the model.',
                                    'error');
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
