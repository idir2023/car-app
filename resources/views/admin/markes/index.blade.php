@extends('admin.layouts.master')

@section('title')
    Markes
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
                    <h3 class="card-title">Markes</h3>
                    <div>
                        <button class="btn btn-outline-primary btn-sm" id="addMarkeBtn">Add New Marke
                            <i class="fas fa-plus"></i>
                        </button>
                        <button class="btn btn-outline-success btn-sm" id="importMarkeBtn">Import Excel Markes
                            <i class="fas fa-upload"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="markes-table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be dynamically loaded -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Import Form Modal -->
    <div class="modal fade" tabindex="-1" id="importMarkeModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Markes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('excel.import') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="file">Upload Excel File</label>
                            <input type="file" class="form-control" name="file" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Import</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Add New Marke Modal -->
    <div class="modal fade" tabindex="-1" id="addMarkeModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Marke</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('markes.store') }}" id="addMarkeForm">
                        @csrf
                        <div class="form-group">
                            <label for="markeName">Marke Name</label>
                            <input type="text" class="form-control" id="markeName" name="name" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveMarkeBtn">Save Marke</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Marke Modal -->
    <div class="modal fade" tabindex="-1" id="editMarkeModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Marke</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ url('markes') }}" id="editMarkeForm">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="editMarkeName">Marke Name</label>
                            <input type="text" class="form-control" id="editMarkeName" name="name" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="updateMarkeBtn">Update Marke</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#markes-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,

                ajax: '{{ route('markes.index') }}', // The route that returns the data
                columns: [
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // Open Add New Marke Modal
            $('#addMarkeBtn').on('click', function() {
                $('#addMarkeModal').modal('show');
            });

            // Open Add New Marke Modal
            $('#importMarkeBtn').on('click', function() {
                $('#importMarkeModal').modal('show');
            });

            // Save New Marke when "Save Marke" button is clicked
            $('#saveMarkeBtn').on('click', function() {
                var formData = $('#addMarkeForm').serialize();

                // Send the request using jQuery AJAX
                $.ajax({
                    url: '{{ route('markes.store') }}',
                    method: 'POST',
                    data: formData,
                    success: function(data) {
                        $('#addMarkeModal').modal('hide');
                        Swal.fire({
                            title: 'Success!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: 'Okay'
                        }).then(() => {
                            $('#markes-table').DataTable().ajax
                                .reload(); // Reload the DataTable
                        });
                    },
                    error: function() {
                        Swal.fire('Error!', 'There was an error adding the Marke.', 'error');
                    }
                });
            });

            // Edit Marke Button - Show Edit Modal
            $(document).on('click', '.editBtn', function() {
                var markeId = $(this).data('id');
                // Fetch the Marke details for editing using AJAX
                $.ajax({
                    url: '{{ url('markes') }}/' + markeId + '/edit',
                    method: 'GET',
                    success: function(data) {
                        if (data.message) {
                            Swal.fire('Error!', data.message, 'error');
                        } else {
                            $('#editMarkeName').val(data.name);
                            $('#editMarkeForm').attr('action', '{{ url('markes') }}/' +
                                markeId);
                            $('#editMarkeModal').modal('show');
                        }
                    },

                    error: function() {
                        Swal.fire('Error!', 'There was an error fetching the Marke details.',
                            'error');
                    }
                });
            });

            // Update Marke when "Update Marke" button is clicked
            $('#updateMarkeBtn').on('click', function() {
                var formData = $('#editMarkeForm').serialize();

                // Send the request using jQuery AJAX
                $.ajax({
                    url: $('#editMarkeForm').attr('action'),
                    method: 'PUT',
                    data: formData,
                    success: function(data) {
                        $('#editMarkeModal').modal('hide');
                        Swal.fire({
                            title: 'Updated!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: 'Okay'
                        }).then(() => {
                            $('#markes-table').DataTable().ajax
                                .reload(); // Reload the DataTable
                        });
                    },
                    error: function() {
                        Swal.fire('Error!', 'There was an error updating the Marke.', 'error');
                    }
                });
            });

            // Confirm Delete Marke using jQuery
            $(document).on('click', '.deleteBtn', function() {
                var markId = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Send delete request using AJAX
                        $.ajax({
                            url: '{{ url('markes') }}/' + markId,
                            method: 'DELETE',
                            data: {
                                '_token': '{{ csrf_token() }}',
                            },
                            success: function() {
                                Swal.fire('Deleted!', 'The Marke has been deleted.',
                                    'success');
                                $('#markes-table').DataTable().ajax
                                    .reload(); // Reload the DataTable after deletion
                            },
                            error: function() {
                                Swal.fire('Error!',
                                    'There was an error deleting the Marke.',
                                    'error');
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
