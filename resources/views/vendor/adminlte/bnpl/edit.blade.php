<!-- caredit.blade.php -->
@extends('layouts.app')
@section('title', 'BNPL')
@section('content_header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">BNPL Edit</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item "><a href="#">BNPL</a></li>
              <li class="breadcrumb-item active">Edit</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@stop

@section('content')

@php
$config = [
    "cancelButtonClasses" => "btn-danger",
];
@endphp

{{-- Minimal --}}
<x-adminlte-input name="name" type="text" placeholder="" label="Name" fgroup-class="col-md-6" disable-feedback value="{{ $bnpl->name }}"/>


{{-- Email type --}}
<x-adminlte-input name="phone" type="text" placeholder="" label="Phone" fgroup-class="col-md-6" disable-feedback value="{{ $bnpl->phone }}"/>
<x-adminlte-input name="sex" type="text" placeholder="" label="Giới tính" fgroup-class="col-md-6" disable-feedback value="{{ $bnpl->sex }}"/>
<x-adminlte-input name="birthday" type="text" placeholder="" label="Ngày Sinh" fgroup-class="col-md-6" disable-feedback value="{{ $bnpl->birthday }}"/>
<x-adminlte-input name="citizenId" type="text" placeholder="" label="Số CCDC" fgroup-class="col-md-6" disable-feedback value="{{ $bnpl->citizenId }}"/>
<x-adminlte-input name="issueDate" type="text" placeholder="" label="Ngày cấp" fgroup-class="col-md-6" disable-feedback value="{{ $bnpl->issueDate }}"/>
<x-adminlte-input name="city" type="text" placeholder="" label="Thành Phố" fgroup-class="col-md-6" disable-feedback value="{{ $bnpl->city }}"/>
<x-adminlte-input name="district" type="text" placeholder="" label="Quận" fgroup-class="col-md-6" disable-feedback value="{{ $bnpl->district }}"/>
<x-adminlte-input name="ward" type="text" placeholder="" label="Phường" fgroup-class="col-md-6" disable-feedback value="{{ $bnpl->ward }}"/>
<x-adminlte-input name="street" type="text" placeholder="" label="Đường" fgroup-class="col-md-6" disable-feedback value="{{ $bnpl->street }}"/>
<x-adminlte-input name="personal_title_ref" type="text" placeholder="" label="Quan hệ người tham chiếu" fgroup-class="col-md-6" disable-feedback value="{{ $bnpl->personal_title_ref }}"/>
<x-adminlte-input name="name_ref" type="text" placeholder="" label="Tên người tham chiếu" fgroup-class="col-md-6" disable-feedback value="{{ $bnpl->name_ref }}"/>
<x-adminlte-input name="phone_ref" type="text" placeholder="" label="Số điện thoại" fgroup-class="col-md-6" disable-feedback value="{{ $bnpl->phone_ref }}"/>

        <x-adminlte-button class="mr-auto" theme="success" label="Update"/>
        <x-adminlte-button theme="danger" label="Cancel" data-dismiss="modal"/>
@stop
