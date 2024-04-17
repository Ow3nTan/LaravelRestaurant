@extends('admin.layouts.admin_layout')
{{-- <x-header data="Website Settings" /> --}}


@section('content')
    @php
        $pageTitle = 'Website Settings';
    @endphp 

    <div class="card">
        <div class="card-header">
            Website Settings
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('website_settings.update') }}">
                @csrf
                <div class="panel-X">
                    <div class="panel-header-X">
                        <div class="main-title">
                            Settings
                        </div>
                    </div>
                    <div class="save-header-X">
                        <div style="display:flex">
                            <div class="icon">
                                <i class="fa fa-sliders-h"></i>
                            </div>
                            <div class="title-container">Website details</div>
                        </div>
                        <div class="button-controls">
                            <button type="submit" name="save_settings" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                    <div class="panel-body-X">
                        @foreach ($options as $option)
                            <div class="form-group">
                                <label for="{{ $option->option_name }}">{{ $option->option_name }}</label>
                                <input type="text" value="{{ old($option->option_name, $option->option_value) }}" name="{{ $option->option_name }}" class="form-control">
                                @error($option->option_name)
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        @endforeach
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if(session('success'))
        <script type="text/javascript">
            swal("Success", "{{ session('success') }}", "success");
        </script>
    @endif
@endsection
