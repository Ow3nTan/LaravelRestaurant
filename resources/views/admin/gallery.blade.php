@extends('admin.layouts.admin_layout')

{{-- <x-header data="Image Gallery" /> --}}

@section('content')
    @php
        $pageTitle = 'Image Gallery';
    @endphp


    <div class="card">
        <div class="card-header">
            {{ $pageTitle }}
        </div>
        <div class="card-body">
            <button class="btn btn-success btn-sm" style="margin-bottom: 10px;" data-bs-toggle="modal"
                data-bs-target="#add_new_image">
                <i class="fa fa-plus"></i> Add Image
            </button>


            <!-- Add New Image Modal -->
            <div class="modal fade" id="add_new_image" tabindex="-1" aria-labelledby="addNewImageLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addNewImageLabel">Add New Image</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="image_name_input">Image Name</label>
                                    <input type="text" class="form-control" id="image_name_input" name="image_name"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="add_gallery_imageUpload">Image</label>
                                    <input type="file" class="form-control" id="add_gallery_imageUpload"
                                        name="gallery_image" accept=".png, .jpg, .jpeg" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-info">Add Image</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Image Name</th>
                        <th scope="col">Image</th>
                        <th scope="col">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($images as $image)
                        <tr>
                            <td>{{ $image->image_id }}</td>
                            <td>{{ $image->image_name }}</td>
                            <td><img src="{{ Storage::url($image->path) }}" class="img-fluid img-thumbnail"
                                    alt="{{ $image->name }}"></td>
                            <td>
                                <!-- Delete Button -->
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $image->image_id }}">
                                    <i class="fa fa-trash"></i> Delete
                                </button>

                                <!-- Modals for Deleting Images -->
                                <div class="modal fade" id="deleteModal{{ $image->image_id }}" tabindex="-1"
                                    aria-labelledby="deleteModalLabel{{ $image->image_id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Delete Image</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete this image?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <form method="POST"
                                                    action="{{ route('gallery.destroy', $image->image_id) }}"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script type="text/javascript">
        // UPLOAD ADD IMAGE GALLERY

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#add_gallery_imagePreview').css('background-image', 'url(' + e.target.result + ')');
                    $('#add_gallery_imagePreview').hide();
                    $('#add_gallery_imagePreview').fadeIn(650);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#add_gallery_imageUpload").change(function() {
            readURL(this);
        });

        $('#add_image_bttn').click(function() {
            var image_name = $("#image_name_input").val();
            var image = $("#add_gallery_imageUpload").val();

            if ($.trim(image_name) == "") {
                $('#required_image_name').css('display', 'block');
            } else {
                $.ajax({
                    url: "{{ route('gallery.store') }}",
                    method: "POST",
                    data: {
                        image_name: image_name,
                        image: image,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        $('#add_image_result').html(data);
                    },
                    error: function(xhr, status, error) {
                        alert('AN ERROR HAS BEEN ENCOUNTERED WHILE TRYING TO EXECUTE YOUR REQUEST');
                    }
                });
            }
        });

        $(document).on('click', '.delete_image_bttn', function() {
            var image_id = $(this).data('id');
            var do_ = "Delete";

            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this image!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "ajax_files/gallery_ajax.php",
                            method: "POST",
                            data: {
                                image_id: image_id,
                                do: do_
                            },
                            success: function(response) {
                                swal("Poof! Your image has been deleted!", {
                                    icon: "success",
                                });
                                location.reload();
                            },
                            error: function(xhr, status, error) {
                                swal("Oops!", "An error occurred: " + xhr.responseText, "error");
                            }
                        });
                    }
                });
        });
    </script>
@endsection
