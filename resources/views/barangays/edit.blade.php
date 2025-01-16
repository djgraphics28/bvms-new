@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Barangay</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('barangays.index') }}">Barangays</a></li>
                        <li class="breadcrumb-item active">Edit Barangay</li>
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
                        <form action="{{ route('barangays.update', $barangay->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="picture">Barangay Image</label>
                                <input type="file" class="form-control-file" id="picture" name="picture"
                                    accept="image/*" onchange="previewImage(this)">
                                @error('picture')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mt-2">
                                <img id="preview" src="{{ $barangay->getFirstMediaUrl('barangay-image') }}" alt="Preview"
                                    style="max-width: 200px; display: {{ $barangay->getFirstMediaUrl('barangay-image') ? 'block' : 'none' }};">
                            </div>
                            <div class="form-group">
                                <label for="name">Barangay Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $barangay->name }}" required>
                            </div>

                            <div class="form-group">
                                <label>Location</label>
                                <div id="map" style="height: 400px;"></div>
                            </div>

                            <div class="form-group">
                                <label for="latitude">Latitude</label>
                                <input type="text" class="form-control" id="latitude" name="latitude"
                                    value="{{ $barangay->latitude }}" readonly required>
                            </div>

                            <div class="form-group">
                                <label for="longitude">Longitude</label>
                                <input type="text" class="form-control" id="longitude" name="longitude"
                                    value="{{ $barangay->longitude }}" readonly required>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Barangay</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
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
                    preview.src = '#';
                    preview.style.display = 'none';
                }
            }
            // JavaScript for image preview
            // document.getElementById('imageUpload').addEventListener('change', function(event) {
            //     const currentImage = document.getElementById('currentImage');
            //     const preview = document.getElementById('preview');
            //     const file = event.target.files[0]; // Get the uploaded file

            //     if (file) {
            //         const reader = new FileReader(); // FileReader to read the image
            //         reader.onload = function(e) {
            //             preview.src = e.target.result; // Set preview image source
            //             preview.style.display = 'block'; // Show the preview
            //             if (currentImage) {
            //                 currentImage.style.display = 'none'; // Hide the current image
            //             }
            //         };
            //         reader.readAsDataURL(file); // Read the file as a data URL
            //     }
            // });
        </script>
        <script async
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCGSdz2RsYpR2isrO9CpAUSQUgAf6pZKvg&callback=initMap"></script>
        <script>
            function initMap() {
                const defaultLocation = {
                    lat: {{ $barangay->latitude }},
                    lng: {{ $barangay->longitude }}
                };
                const map = new google.maps.Map(document.getElementById('map'), {
                    center: defaultLocation,
                    zoom: 13
                });

                let marker = new google.maps.Marker({
                    position: defaultLocation,
                    map: map,
                    draggable: true
                });

                google.maps.event.addListener(marker, 'dragend', function(event) {
                    document.getElementById('latitude').value = event.latLng.lat();
                    document.getElementById('longitude').value = event.latLng.lng();
                });

                // Click on map to move marker
                map.addListener('click', function(event) {
                    marker.setPosition(event.latLng);
                    document.getElementById('latitude').value = event.latLng.lat();
                    document.getElementById('longitude').value = event.latLng.lng();
                });
            }
        </script>
    @endpush
@endsection
