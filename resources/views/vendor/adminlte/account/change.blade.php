
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
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
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

                <x-input id="current_password" class="block mt-1 w-full @error('current_password') is-invalid @enderror" type="password" name="current_password" />
                <span class="invalid-feedback" role="alert">
                  @error('current_password')
                  <strong>{{ "Current password is not correct" }}</strong>
                  @enderror
                </span>
              </div>
              
            <!-- Password -->
            <div class="mt-4" style="width:30%; display:block;margin-left: auto;margin-right: auto;">
                <x-label for="password" :value="__('New Password')" />

                <x-input id="password" class="block mt-1 w-full @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="current-password"/>
            </div>

            <!-- Confirm Password -->
            <div class="mt-4" style="width:30%; display:block;margin-left: auto;margin-right: auto;">
                <x-label for="password" :value="__('Confirm New Password')" />

                <x-input id="password" class="block mt-1 w-full @error('password') is-invalid @enderror"
                                    type="password"
                                    name="password_confirmation" required autocomplete="current-password"/>
                @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mt-4" style="width:30%; display:block;margin-left: auto;margin-right: auto;" id="otp_text">
              <x-label for="otp" :value="__('OTP')" />
              
              <x-input id="otp" class="block mt-1 w-full" type="text" name="otp" required />
              
            </div>

            <div class="mt-4" style="width:10%; margin-left: auto;margin-right: auto;" >
                <x-button style="background-color: green">
                    {{ __('Save') }}
                </x-button>
            </div>
        </form>
      </div>
    </div>
</div>
</x-guest-layout>
@endsection


@section('js')
<script>
$(document).ready(function(){
  $('#otp_text').hide();
});

</script>
@stop