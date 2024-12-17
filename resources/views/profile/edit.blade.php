@extends('admin.layouts.master')

@section('title')
    Edit Profile
@endsection

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container-xl">
            <!-- Profile Information Section -->

            <div class="mb-4">
                <div class="p-4 bg-white shadow-sm rounded-lg">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
            <!-- Update Password Section -->
            <div class="row">

                <div class="mb-4 col-md-6">
                    <div class="p-4 bg-white shadow-sm rounded-lg">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <!-- Delete User Section -->
                <div class="mb-4 col-md-6">
                    <div class="p-4 bg-white shadow-sm rounded-lg">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
