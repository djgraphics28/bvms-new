@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Device</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('devices.index') }}">Devices</a></li>
                        <li class="breadcrumb-item active">Edit Device</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('devices.update', $device->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Code</label>
                                <input type="text" class="form-control" id="name" name="code" value="{{ $device->code }}" required>
                            </div>

                            <div class="form-group">
                                <label for="picture">Device Image</label>
                                <input type="file" class="form-control-file" id="picture" name="picture" accept="image/*" onchange="previewImage(this)">
                            </div>

                            <div class="mt-2">
                                <img id="preview" src="{{ $device->getFirstMediaUrl('device-image') }}" alt="Preview"
                                    style="max-width: 200px; display: {{ $device->getFirstMediaUrl('device-image') ? 'block' : 'none' }};">
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Update Device</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('preview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }

                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = '{{ $device->picture ? asset($device->picture) : "#" }}';
                preview.style.display = '{{ $device->picture ? "block" : "none" }}';
            }
        }
    </script>
@endsection
