<!-- caredit.blade.php -->
@extends('layouts.app')
@section('title', 'BNPL')
@section('content_header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">BNPL Customer Edit</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item "><a href="#">BNPL</a></li>
              <li class="breadcrumb-item active">Edit</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <form method="post" action="{{action([App\Http\Controllers\BnplController::class, 'update'], $id)}}" >
        @csrf
        <div class="row" >
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Carcompany">Name Customer</label>
            <input type="text" class="form-control" name="ncustomer" value="{{$bnpl->ncustomer}}">
          </div>
        </div>
        <div class="row" >
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Carcompany">Phone Customer</label>
            <input type="text" class="form-control" name="phnumber" value="{{$bnpl->phnumber}}">
          </div>
        </div>
        <div class="row" >
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Carcompany">Image Customer</label>
            <input type="text" class="form-control" name="image" value="{{$bnpl->image}}">
          </div>
        </div>
        <div class="row" >
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Carcompany">NID Customer</label>
            <input type="text" class="form-control" name="nidcustomer" value="{{$bnpl->nidcustomer}}">
          </div>
        </div>
        <div class="row" >
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Carcompany">NID Image</label>
            <input type="text" class="form-control" name="nidimage" value="{{$bnpl->nidimage}}">
          </div>
        </div>
        <div class="row" >
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Carcompany">Gender</label>
            <input type="text" class="form-control" name="Gender" value="{{$bnpl->Gender}}">
          </div>
        </div>
        <div class="row" >
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Carcompany">Pincode</label>
            <input type="text" class="form-control" name="Pincode" value="{{$bnpl->Pincode}}">
          </div>
        </div>
        <div class="row" >
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Carcompany">Date Of Birth</label>
            <input type="text" class="form-control" name="DOB" value="{{$bnpl->DOB}}">
          </div>
        </div>
        <div class="row" >
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Carcompany">Date of NID</label>
            <input type="text" class="form-control" name="DON" value="{{$bnpl->DON}}">
          </div>
        </div>
        <div class="row" >
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Carcompany">Date of register</label>
            <input type="text" class="form-control" name="DRegis" value="{{$bnpl->DRegis}}">
          </div>
        </div>
        <div class="row" >
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Carcompany">Address</label>
            <input type="text" class="form-control" name="Address" value="{{$bnpl->Address}}">
          </div>
        </div>
        <div class="row" >
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Carcompany">Code</label>
            <input type="text" class="form-control" name="Code" value="{{$bnpl->Code}}">
          </div>
        </div>
        <div class="row" >
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Carcompany">CodeName</label>
            <input type="text" class="form-control" name="CodeName" value="{{$bnpl->CodeName}}">
          </div>
        </div>
        <div class="row" >
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Carcompany">DivisionType</label>
            <input type="text" class="form-control" name="DivisionType" value="{{$bnpl->DivisionType}}">
          </div>
        </div>
        <div class="row" >
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Carcompany">District</label>
            <input type="text" class="form-control" name="District" value="{{$bnpl->District}}">
          </div>
        </div>
        <div class="row" >
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Carcompany">TypeRelation</label>
            <input type="text" class="form-control" name="TypeRelation" value="{{$bnpl->TypeRelation}}">
          </div>
        </div>
        <div class="row" >
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Carcompany">PhoneRelation</label>
            <input type="text" class="form-control" name="PhoneRelation" value="{{$bnpl->PhoneRelation}}">
          </div>
        </div>
        <div class="row" >
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Carcompany">NameRelation</label>
            <input type="text" class="form-control" name="NameRelation" value="{{$bnpl->NameRelation}}">
          </div>
        </div>
        <div class="row" >
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Carcompany">Contract</label>
            <input type="text" class="form-control" name="Contract" value="{{$bnpl->Contract}}">
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <button type="submit" class="btn btn-success">Update</button>
          </div>
        </div>
        </form>
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
