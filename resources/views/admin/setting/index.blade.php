@extends('layouts.admin_master')
@section('content')
    @php
        $activeTab = session('active_tab', 'account');
    @endphp
    <div class="row">
        <div class="col-12">
            <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                <h4 class="page-title">Manage Setting</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">

                    <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
                        <li class="nav-item">
                            <a href="#account" data-bs-toggle="tab" aria-expanded="false"
                                class="nav-link rounded-0 @if ('account' == $activeTab) active @endif">
                                Account
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#password" data-bs-toggle="tab" aria-expanded="false"
                                class="nav-link rounded-0 @if ('password' == $activeTab) active @endif">
                                Password
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade @if ('account' == $activeTab) show active @endif " id="account"
                            role="tabpanel">


                            <div class="card">
                            
                                <div class="card-body">
                                    <form action="{{ route('setting.update', $setting) }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="active_tab" value="account">
                                        <div class="row">
                                            <div class="col-md-8">

                                                <div class="text-center">
                                                    <label for="favicon" style="position: relative">
                                                        <input class="d-none" type="file" name="favicon" id="favicon">
                                                        <img class="border" style="width: 200px"
                                                            src='{{ asset("assets/setting/$setting->favicon") }}'
                                                            alt="">
                                                        <div style="position: absolute; top: 5px; left: 5px" class="btn">
                                                            <i class="fa-regular fa-pen-to-square"></i>
                                                        </div>
                                                    </label>
                                                    <p class="">Favicon</p>
                                                </div>

                                            </div>
                                            <div class="col-md-4">
                                                <div class="text-center">
                                                    <label for="logo" style="position: relative">
                                                        <input class="d-none" type="file" name="logo" id="logo">
                                                        <img class="border"
                                                            src='{{ asset("assets/setting/$setting->logo") }}'
                                                            alt="" style="width: 200px">
                                                        <div style="position: absolute; top: 5px; left: 5px" class="btn">
                                                            <i class="fa-regular fa-pen-to-square"></i>
                                                        </div>
                                                    </label>
                                                    <p class="">Logo</p>
                                                </div>
                                            </div>
                                        </div>

                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-3 col-md-6">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" value="{{ $setting->name }}"
                                            id="name" name="name" placeholder="Name">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email"
                                            value="{{ Auth::user()->email }}" name="email" placeholder="Email">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="inputAddress">Address</label>
                                        <input type="text" class="form-control" name="address"
                                            value="{{ $setting->address }}" id="inputAddress" placeholder="1234 Main St">
                                    </div>

                                    <div class="form-row">
                                        <div class="mb-3 col-md-6">
                                            <label for="inputCity">City</label>
                                            <input type="text" class="form-control" name="city"
                                                value="{{ $setting->city }}" id="inputCity">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="inputState">State</label>
                                            <input type="text" class="form-control"value="{{ $setting->state }}"
                                                name="state" id="inputState">
                                        </div>
                                        <div class="mb-3 col-md-2">
                                            <label for="inputZip">Zip</label>
                                            <input type="text" class="form-control" name="zip"
                                                value="{{ $setting->zip }}" id="inputZip">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                    </form>

                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade @if ('password' == $activeTab) show active @endif " id="password"
                            role="tabpanel">
                            <div class="card">
                                <div class="card-body">

                                    <form action="{{ route('password.change') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="active_tab" value="password">
                                        <div class="mb-3 col-md-6">
                                            <label for="current_password">Current password</label>
                                            <input type="password" name="current_password" class="form-control"
                                                id="current_password">
                                        </div>
                                        <div class="mb-3 mb-3 col-md-6">
                                            <label for="new_password">New password</label>
                                            <input type="password" name="new_password" class="form-control"
                                                id="new_password">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="confirm_password">Confirm password</label>
                                            <input type="password"name="new_password_confirmation" class="form-control"
                                                id="new_password_confirmation">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
@endsection

@section('scripts')
   
@endsection


















