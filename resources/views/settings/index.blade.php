@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Settings</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Settings</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="v-pills-logo-tab" data-toggle="pill" href="#v-pills-logo" role="tab" aria-controls="v-pills-logo" aria-selected="true">Logo Site</a>
                        <a class="nav-link" id="v-pills-sms-tab" data-toggle="pill" href="#v-pills-sms" role="tab" aria-controls="v-pills-sms" aria-selected="false">SMS Config</a>
                        <a class="nav-link" id="v-pills-email-tab" data-toggle="pill" href="#v-pills-email" role="tab" aria-controls="v-pills-email" aria-selected="false">Email Config</a>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="tab-content" id="v-pills-tabContent">
                        <!-- Logo Site Tab -->
                        <div class="tab-pane fade show active" id="v-pills-logo" role="tabpanel" aria-labelledby="v-pills-logo-tab">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Logo Settings</h3>
                                </div>
                                <div class="card-body">
                                    <form action="#" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label>Site Logo</label>
                                            <input type="file" class="form-control" name="logo">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <!-- SMS Config Tab -->
                        <div class="tab-pane fade" id="v-pills-sms" role="tabpanel" aria-labelledby="v-pills-sms-tab">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">SMS Configuration</h3>
                                </div>
                                <div class="card-body">
                                    <form action="#" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label>SMS Gateway</label>
                                            <input type="text" class="form-control" name="sms_gateway">
                                        </div>
                                        <div class="form-group">
                                            <label>API Key</label>
                                            <input type="text" class="form-control" name="sms_api_key">
                                        </div>
                                        <div class="form-group">
                                            <label>Sender ID</label>
                                            <input type="text" class="form-control" name="sms_sender_id">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Email Config Tab -->
                        <div class="tab-pane fade" id="v-pills-email" role="tabpanel" aria-labelledby="v-pills-email-tab">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Email Configuration</h3>
                                </div>
                                <div class="card-body">
                                    <form action="#" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label>SMTP Host</label>
                                            <input type="text" class="form-control" name="smtp_host">
                                        </div>
                                        <div class="form-group">
                                            <label>SMTP Port</label>
                                            <input type="text" class="form-control" name="smtp_port">
                                        </div>
                                        <div class="form-group">
                                            <label>SMTP Username</label>
                                            <input type="text" class="form-control" name="smtp_username">
                                        </div>
                                        <div class="form-group">
                                            <label>SMTP Password</label>
                                            <input type="password" class="form-control" name="smtp_password">
                                        </div>
                                        <div class="form-group">
                                            <label>From Address</label>
                                            <input type="email" class="form-control" name="mail_from_address">
                                        </div>
                                        <div class="form-group">
                                            <label>From Name</label>
                                            <input type="text" class="form-control" name="mail_from_name">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
