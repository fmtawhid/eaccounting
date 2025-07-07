{{-- resources/views/admin/user/profile.blade.php --}}
@extends('layouts.admin_master')

@section('content')
    <div class="container bg-white py-2 shadow-sm shadow-lg">
        <div class="profile-container">
            <div class="row mt-3">
                <div class="col-4 text-center">
                    <div class="profile-header">
                        <img src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim($user->email))) }}?d=mm&s=130"
                             alt="Profile Picture" style="width: 130px;">
                    </div>
                </div>
                <div class="col-8">
                    <h3>{{ $user->name }}</h3>
                    <h4 class="text-muted">Email: {{ $user->email }}</h4>
                    <h4 class="text-muted">Roles: {{ $user->getRoleNames()->implode(', ') }}</h4>

                    <div class="">
                        <a href="{{ route('user.profile', ['id' => $user->id]) }}" class="btn btn-primary">View Profile</a>
                    </div>
                </div>
            </div>
            <hr>

            <ul class="nav nav-tabs" role="tablist" style="padding-bottom: 15px">
                <li class="mx-2 @if ($activeTab == 'basic-info') active @endif">
                    <a href="#basic-info" role="tab" data-toggle="tab">Basic Information</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane mt-3 mx-2 active" id="basic-info">
                    <div class="bg-white p-6 rounded-lg">
                        <h3 class="text-2xl font-semibold text-gray-700 mb-4 border-b-2 pb-2">User Information</h3>

                        <div class="row">
                            <div class="col-6">
                                <div class="p-6 bg-gray-50 rounded-lg">
                                    <h4 class="text-xl font-semibold text-gray-700 mb-4">Basic Information</h4>
                                    <p class="text-gray-600 mb-2"><strong>Name:</strong> {{ $user->name }}</p>
                                    <p class="text-gray-600 mb-2"><strong>Email:</strong> {{ $user->email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
