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
@endsection
