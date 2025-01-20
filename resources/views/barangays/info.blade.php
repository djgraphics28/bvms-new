@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $barangay->name }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('barangays.index') }}">Barangays</a></li>
                        <li class="breadcrumb-item active">{{ $barangay->name }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link active" href="#info" data-toggle="tab">Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#admin-users" data-toggle="tab">Admin Users <span
                                        class="badge {{ $adminUsers->count() > 0 ? 'badge-primary' : 'badge-secondary' }}">{{ $adminUsers->count() ?: 0 }}</span></a>
                            <li class="nav-item">
                                <a class="nav-link" href="#drivers" data-toggle="tab">Drivers <span
                                    class="badge {{ $drivers->count() > 0 ? 'badge-primary' : 'badge-secondary' }}">{{ $drivers->count() ?: 0 }}</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#vehicles" data-toggle="tab">Vehicles <span
                                    class="badge {{ $vehicles->count() > 0 ? 'badge-primary' : 'badge-secondary' }}">{{ $vehicles->count() ?: 0 }}</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#incident-reports" data-toggle="tab">Incident Reports <span
                                    class="badge {{ $incidents->count() > 0 ? 'badge-primary' : 'badge-secondary' }}">{{ $incidents->count() ?: 0 }}</span></a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="info">
                                <div class="form-group">
                                    <label for="picture">Barangay Image</label>
                                    <div class="mt-2">
                                        <img id="preview" src="{{ $barangay->getFirstMediaUrl('barangay-image') }}"
                                            alt="Preview"
                                            style="max-width: 200px; display: {{ $barangay->getFirstMediaUrl('barangay-image') ? 'block' : 'none' }};">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name">Barangay Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ $barangay->name }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Location</label>
                                    <div id="map" style="height: 400px;"></div>
                                </div>

                                <div class="form-group">
                                    <label for="latitude">Latitude</label>
                                    <input type="text" class="form-control" id="latitude" name="latitude"
                                        value="{{ $barangay->latitude }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="longitude">Longitude</label>
                                    <input type="text" class="form-control" id="longitude" name="longitude"
                                        value="{{ $barangay->longitude }}" readonly>
                                </div>
                            </div>
                            <div class="tab-pane" id="admin-users">
                                <h3>Admin Users</h3>
                                @if ($adminUsers->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Role</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($adminUsers as $admin)
                                                    <tr>
                                                        <td>{{ $admin->name }}</td>
                                                        <td>{{ $admin->email }}</td>
                                                        <td>{{ $admin->role }}</td>
                                                        <td>{{ $admin->status }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="text-center py-5">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <line x1="12" y1="8" x2="12" y2="12"></line>
                                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                        </svg>
                                        <p class="mt-3">No admin users found</p>
                                    </div>
                                @endif
                            </div>
                            <div class="tab-pane" id="drivers">
                                <h3>Drivers</h3>
                                @if ($drivers->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>License No.</th>
                                                    <th>Contact</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($drivers as $driver)
                                                    <tr>
                                                        <td>{{ $driver->name }}</td>
                                                        <td>{{ $driver->license_number }}</td>
                                                        <td>{{ $driver->contact }}</td>
                                                        <td>{{ $driver->status }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="text-center py-5">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <line x1="12" y1="8" x2="12" y2="12"></line>
                                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                        </svg>
                                        <p class="mt-3">No drivers found</p>
                                    </div>
                                @endif
                            </div>
                            <div class="tab-pane" id="vehicles">
                                <h3>Vehicles</h3>
                                @if ($vehicles->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Plate Number</th>
                                                    <th>Type</th>
                                                    <th>Model</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($vehicles as $vehicle)
                                                    <tr>
                                                        <td>{{ $vehicle->plate_number }}</td>
                                                        <td>{{ $vehicle->type }}</td>
                                                        <td>{{ $vehicle->model }}</td>
                                                        <td>{{ $vehicle->status }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="text-center py-5">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <line x1="12" y1="8" x2="12" y2="12"></line>
                                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                        </svg>
                                        <p class="mt-3">No vehicles found</p>
                                    </div>
                                @endif
                            </div>
                            <div class="tab-pane" id="incident-reports">
                                <h3>Incident Reports</h3>
                                @if ($incidents->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Type</th>
                                                    <th>Location</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($incidents as $incident)
                                                    <tr>
                                                        <td>{{ $incident->date }}</td>
                                                        <td>{{ $incident->type }}</td>
                                                        <td>{{ $incident->location }}</td>
                                                        <td>{{ $incident->status }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="text-center py-5">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <line x1="12" y1="8" x2="12" y2="12"></line>
                                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                        </svg>
                                        <p class="mt-3">No incident reports found</p>
                                    </div>
                                @endif
                            </div>
                        </div>
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
                    zoom: 15
                });

                let marker = new google.maps.Marker({
                    position: defaultLocation,
                    map: map,
                    draggable: false
                });

                // Remove click and drag listeners since this is view-only
                // google.maps.event.addListener(marker, 'dragend', function(event) {
                //     document.getElementById('latitude').value = event.latLng.lat();
                //     document.getElementById('longitude').value = event.latLng.lng();
                // });

                // // Click on map to move marker 
                // map.addListener('click', function(event) {
                //     marker.setPosition(event.latLng);
                //     document.getElementById('latitude').value = event.latLng.lat();
                //     document.getElementById('longitude').value = event.latLng.lng();
                // });
            }
        </script>
    @endpush
@endsection
