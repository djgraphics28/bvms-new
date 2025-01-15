@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Barangays</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Barangays</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- Google Map -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div id="map" style="height: 400px; width: 100%;"></div>
            </div>
        </div>
    </div>

    <!-- Barangay List -->
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="card-title">List of Barangays</h3>
                            <a href="{{ route('barangays.create') }}" type="button" class="btn btn-primary"><i
                                    class="fa fa-plus"></i> Add</a>
                        </div>

                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Barangay Name</th>
                                    <th>Location</th>
                                    <th width="15%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($barangays as $barangay)
                                    <tr>
                                        <td>{{ $barangay->name }}</td>
                                        <td>{{ $barangay->latitude }}, {{ $barangay->longitude }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-info"
                                                onclick="focusLocation({{ $barangay->latitude }}, {{ $barangay->longitude }}, '{{ $barangay->name }}')">View
                                                on Map</button>
                                            <a href="{{ route('barangays.edit', $barangay->id) }}"
                                                class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('barangays.destroy', $barangay->id) }}" method="POST"
                                                style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this barangay?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script async
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCGSdz2RsYpR2isrO9CpAUSQUgAf6pZKvg&callback=initMap"></script>

        <script>
            let map;
            let markers = [];
            let infoWindows = [];

            function initMap() {
                // Initialize map with default center (you can set this to your city's coordinates)
                map = new google.maps.Map(document.getElementById('map'), {
                    center: {
                        lat: 15.9061,
                        lng: 120.5853
                    }, // Default Manila coordinates
                    zoom: 13
                });

                // Add markers for all barangays
                @foreach ($barangays as $barangay)
                    addMarker(
                        {{ $barangay->latitude }},
                        {{ $barangay->longitude }},
                        "{{ $barangay->name }}",
                        "{{ $barangay->image_url ?? 'default-image.jpg' }}",
                        "{{ $barangay->description ?? '' }}"
                    );
                @endforeach
            }

            function addMarker(lat, lng, title, imageUrl, description) {
                const marker = new google.maps.Marker({
                    position: {
                        lat: parseFloat(lat),
                        lng: parseFloat(lng)
                    },
                    map: map,
                    title: title,
                    icon: {
                        path: google.maps.SymbolPath.CIRCLE,
                        scale: 10,
                        fillColor: "#4285F4", 
                        fillOpacity: 1,
                        strokeWeight: 2,
                        strokeColor: "#FFFFFF"
                    }
                });

                const contentString = `
        <div style="max-width:300px">
            <h3>${title}</h3>
            <img src="${imageUrl}" style="width:100%;max-height:200px;object-fit:cover;margin:10px 0">
            <p>${description}</p>
            <p>Location: ${lat}, ${lng}</p>
        </div>
        `;

                const infoWindow = new google.maps.InfoWindow({
                    content: contentString
                });

                infoWindows.push(infoWindow);

                marker.addListener('click', () => {
                    // Close all open info windows
                    infoWindows.forEach(window => window.close());
                    // Open this marker's info window
                    infoWindow.open(map, marker);
                });

                markers.push(marker);
            }

            function focusLocation(lat, lng, title) {
                const position = {
                    lat: parseFloat(lat),
                    lng: parseFloat(lng)
                };
                map.setCenter(position);
                map.setZoom(20);

                // Find and open the corresponding marker's info window
                markers.forEach((marker, index) => {
                    if (marker.getTitle() === title) {
                        infoWindows[index].open(map, marker);
                    }
                });
            }
        </script>
    @endpush
@endsection
