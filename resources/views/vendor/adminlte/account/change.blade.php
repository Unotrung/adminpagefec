
<x-guest-layout>
@extends('layouts.app')
@section('title', 'Account')
@section('content_header')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Change Password</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Change Password</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
@stop
@section('content')
        <!-- Validation Errors -->
       <!-- <x-auth-validation-errors class="mb-4" :errors="$errors" /> -->
       <div class="container-fluid">
        <div class="card">
          <div class="card-header">
        <form method="POST" action="{{ route('password.edit') }}">
            @csrf
            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ csrf_token() }}">

            <!-- Email Address -->
            <div class="mt-4" style="width:30%; display:none;">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="text" name="email" value="{{Auth::user()->email}}" required />
            </div>

             <!-- Old Password -->
             <div class="mt-4" style="width:30%; display:block;margin-left: auto;margin-right: auto;">
                <x-label for="current_password" :value="__('Current Password')" />

                <x-input id="current_password" class="block mt-1 w-full" type="password" name="current_password" required />
            </div>

            <!-- Password -->
            <div class="mt-4" style="width:30%; display:block;margin-left: auto;margin-right: auto;">
                <x-label for="password" :value="__('New Password')" />

                <x-input id="password" class="block mt-1 w-full @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="current-password"/>
                @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mt-4" style="width:30%; display:block;margin-left: auto;margin-right: auto;">
                <x-label for="password" :value="__('Confirm New Password')" />

                <x-input id="password" class="block mt-1 w-full @error('password') is-invalid @enderror"
                                    type="password"
                                    name="password_confirmation" required autocomplete="current-password"/>
            </div>

            <div class="mt-4" style="width:18%; margin-left: auto;margin-right: auto;">
                <x-button>
                    {{ __('Change Password') }}
                </x-button>
            </div>
        </form>
      </div>
    </div>
</div>
</x-guest-layout>
@endsection
