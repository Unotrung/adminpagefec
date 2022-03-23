@extends('layouts.app')

@section('title', 'Notifications')

@section('content')
<style>
    body{
    margin-top:20px;
}

[class*="noty_theme__unify--v1"] {
  box-shadow: 0 2px 15px 0 rgba(0, 0, 0, 0.15);
  border-radius: 4px;
  padding: 1.57143rem;
}

.noty_theme__unify--v1--dark {
  background-color: #2e3c56;
}

.noty_theme__unify--v1--light {
  background-color: #fff;
  box-shadow: 0 2px 15px 0 rgba(0, 0, 0, 0.05);
}

.noty_type__success.noty_theme__unify--v1 {
  background-color: #1cc9e4;
}

.noty_type__info.noty_theme__unify--v1 {
  background-color: #1d75e5;
}

.noty_type__error.noty_theme__unify--v1 {
  background-color: #e62154;
}

.noty_type__warning.noty_theme__unify--v1 {
  background-color: #e6a821;
}

.noty_body {
  font-weight: 400;
  font-size: 1rem;
  color: #fff;
}

[class*="noty_theme__unify--v1"] .noty_body {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
  -webkit-align-items: center;
      -ms-flex-align: center;
          align-items: center;
}

.noty_theme__unify--v1--light .noty_body {
  color: #41464B;
}

.noty_body__icon {
  position: relative;
  display: inline-block;
  color: #fff;
  text-align: center;
  border-radius: 50%;
}

.noty_body__icon::before {
  display: block;
}

.noty_body__icon > i {
  position: relative;
  top: 50%;
  display: block;
  -webkit-transform: translateY(-50%);
      -ms-transform: translateY(-50%);
          transform: translateY(-50%);
  z-index: 2;
}

.noty_theme__unify--v1 .noty_body__icon {
  background-color: rgba(245, 249, 249, 0.2);
}

.noty_theme__unify--v1--dark .noty_body__icon {
  background-color: rgba(245, 249, 249, 0.1);
}

.noty_theme__unify--v1--dark.noty_type__success .noty_body__icon {
  color: #1cc9e4;
}

.noty_theme__unify--v1--dark.noty_type__info .noty_body__icon {
  color: #1d75e5;
}

.noty_theme__unify--v1--dark.noty_type__error .noty_body__icon {
  color: #e62154;
}

.noty_theme__unify--v1--dark.noty_type__warning .noty_body__icon {
  color: #e6a821;
}

.noty_theme__unify--v1--light.noty_type__success .noty_body__icon {
  background-color: rgba(28, 201, 228, 0.15);
  color: #1cc9e4;
}

.noty_theme__unify--v1--light.noty_type__info .noty_body__icon {
  background-color: rgba(29, 117, 229, 0.15);
  color: #1d75e5;
}

.noty_theme__unify--v1--light.noty_type__error .noty_body__icon {
  background-color: rgba(230, 33, 84, 0.15);
  color: #e62154;
}

.noty_theme__unify--v1--light.noty_type__warning .noty_body__icon {
  background-color: rgba(230, 168, 33, 0.15);
  color: #e6a821;
}

[class*="noty_theme__unify--v1"] .noty_close_button {
  top: 14px;
  right: 14px;
  width: 0.85714rem;
  height: 0.85714rem;
  line-height: 0.85714rem;
  background-color: transparent;
  font-weight: 300;
  font-size: 1.71429rem;
  color: #fff;
  border-radius: 0;
}

.noty_theme__unify--v1--light .noty_close_button {
  color: #cad6d6;
}

.noty_progressbar {
  height: 0.5rem !important;
}

.noty_theme__unify--v1 .noty_progressbar {
  background-color: rgba(0, 0, 0, 0.08) !important;
}

.noty_theme__unify--v1--dark.noty_type__success .noty_progressbar {
  background-color: #1cc9e4;
}

.noty_theme__unify--v1--dark.noty_type__info .noty_progressbar {
  background-color: #1d75e5;
}

.noty_theme__unify--v1--dark.noty_type__error .noty_progressbar {
  background-color: #e62154;
}

.noty_theme__unify--v1--dark.noty_type__warning .noty_progressbar {
  background-color: #e6a821;
}

.noty_theme__unify--v1--light.noty_type__success .noty_progressbar {
  background-color: rgba(28, 201, 228, 0.15);
}

.noty_theme__unify--v1--light.noty_type__info .noty_progressbar {
  background-color: rgba(29, 117, 229, 0.15);
}

.noty_theme__unify--v1--light.noty_type__error .noty_progressbar {
  background-color: rgba(230, 33, 84, 0.15);
}

.noty_theme__unify--v1--light.noty_type__warning .noty_progressbar {
  background-color: rgba(230, 168, 33, 0.15);
}

  .g-mb-25 {
    margin-bottom: 1.78571rem !important;
  }
    </style>
@section('content_header')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Notifications</h1>
        <a href="{{route('roles.add')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus"></i> Add New
        </a>
    </div>
@stop
@section('content')   
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Notifications</h6>
        </div>
        <div class="card-body">
        <div class="container">
   <div class="row">
      <div class="col-md-6">
         <!-- Success -->
         <div class="g-brd-around g-brd-gray-light-v7 g-rounded-4 g-pa-15 g-pa-20--md g-mb-30">
            <h3 class="d-flex align-self-center text-uppercase g-font-size-12 g-font-size-default--md g-color-black g-mb-20">Success</h3>
            <div class="noty_bar noty_type__success noty_theme__unify--v1 g-mb-25">
               <div class="noty_body">
                  <div class="g-mr-20">
                     <div class="noty_body__icon">
                        <i class="hs-admin-check"></i>
                     </div>
                  </div>
                  <div>Hi, welcome to Voolo. This is example of Toastr notification box.</div>
               </div>
            </div>
            <div class="noty_bar noty_type__success noty_theme__unify--v1 noty_close_with_click noty_close_with_button g-mb-25">
               <div class="noty_body">
                  <div class="g-mr-20">
                     <div class="noty_body__icon">
                        <i class="hs-admin-check"></i>
                     </div>
                  </div>
                  <div>Hi, welcome to Voolo. This is example of Toastr notification box.</div>
               </div>
               <div class="noty_close_button">×</div>
            </div>
            <div class="noty_bar noty_type__success noty_theme__unify--v1 noty_close_with_click noty_has_progressbar noty_has_timeout">
               <div class="noty_body">
                  <div class="g-mr-20">
                     <div class="noty_body__icon">
                        <i class="hs-admin-check"></i>
                     </div>
                  </div>
                  <div>Hi, welcome to Voolo. This is example of Toastr notification box.</div>
               </div>
               <div class="noty_progressbar" style="width: 70%;"></div>
            </div>
         </div>
         <!-- End Success -->
      </div>
      <div class="col-md-6">
         <!-- Info -->
         <div class="g-brd-around g-brd-gray-light-v7 g-rounded-4 g-pa-15 g-pa-20--md g-mb-30">
            <h3 class="d-flex align-self-center text-uppercase g-font-size-12 g-font-size-default--md g-color-black g-mb-20">Info</h3>
            <div class="noty_bar noty_type__info noty_theme__unify--v1 g-mb-25">
               <div class="noty_body">
                  <div class="g-mr-20">
                     <div class="noty_body__icon">
                        <i class="hs-admin-info"></i>
                     </div>
                  </div>
                  <div>Hi, welcome to Voolo. This is example of Toastr notification box.</div>
               </div>
            </div>
            <div class="noty_bar noty_type__info noty_theme__unify--v1 noty_close_with_click noty_close_with_button g-mb-25">
               <div class="noty_body">
                  <div class="g-mr-20">
                     <div class="noty_body__icon">
                        <i class="hs-admin-info"></i>
                     </div>
                  </div>
                  <div>Hi, welcome to Voolo. This is example of Toastr notification box.</div>
               </div>
               <div class="noty_close_button">×</div>
            </div>
            <div class="noty_bar noty_type__info noty_theme__unify--v1 noty_close_with_click noty_has_progressbar noty_has_timeout">
               <div class="noty_body">
                  <div class="g-mr-20">
                     <div class="noty_body__icon">
                        <i class="hs-admin-info"></i>
                     </div>
                  </div>
                  <div>Hi, welcome to Voolo. This is example of Toastr notification box.</div>
               </div>
               <div class="noty_progressbar" style="width: 70%;"></div>
            </div>
         </div>
         <!-- End Info -->
      </div>
   </div>
   <div class="row">
      <div class="col-md-6">
         <!-- Error -->
         <div class="g-brd-around g-brd-gray-light-v7 g-rounded-4 g-pa-15 g-pa-20--md g-mb-30">
            <h3 class="d-flex align-self-center text-uppercase g-font-size-12 g-font-size-default--md g-color-black g-mb-20">Error</h3>
            <div class="noty_bar noty_type__error noty_theme__unify--v1 g-mb-25">
               <div class="noty_body">
                  <div class="g-mr-20">
                     <div class="noty_body__icon">
                        <i class="hs-admin-alert"></i>
                     </div>
                  </div>
                  <div>Hi, welcome to Unify. This is example of Toastr notification box.</div>
               </div>
            </div>
            <div class="noty_bar noty_type__error noty_theme__unify--v1 noty_close_with_click noty_close_with_button g-mb-25">
               <div class="noty_body">
                  <div class="g-mr-20">
                     <div class="noty_body__icon">
                        <i class="hs-admin-alert"></i>
                     </div>
                  </div>
                  <div>Hi, welcome to Voolo. This is example of Toastr notification box.</div>
               </div>
               <div class="noty_close_button">×</div>
            </div>
            <div class="noty_bar noty_type__error noty_theme__unify--v1 noty_close_with_click noty_has_progressbar noty_has_timeout">
               <div class="noty_body">
                  <div class="g-mr-20">
                     <div class="noty_body__icon">
                        <i class="hs-admin-alert"></i>
                     </div>
                  </div>
                  <div>Hi, welcome to Voolo. This is example of Toastr notification box.</div>
               </div>
               <div class="noty_progressbar" style="width: 70%;"></div>
            </div>
         </div>
         <!-- End Error -->
      </div>
      <div class="col-md-6">
         <!-- Warning -->
         <div class="g-brd-around g-brd-gray-light-v7 g-rounded-4 g-pa-15 g-pa-20--md g-mb-30">
            <h3 class="d-flex align-self-center text-uppercase g-font-size-12 g-font-size-default--md g-color-black g-mb-20">Warning</h3>
            <div class="noty_bar noty_type__warning noty_theme__unify--v1 g-mb-25">
               <div class="noty_body">
                  <div class="g-mr-20">
                     <div class="noty_body__icon">
                        <i class="hs-admin-bolt"></i>
                     </div>
                  </div>
                  <div>Hi, welcome to Voolo. This is example of Toastr notification box.</div>
               </div>
            </div>
            <div class="noty_bar noty_type__warning noty_theme__unify--v1 noty_close_with_click noty_close_with_button g-mb-25">
               <div class="noty_body">
                  <div class="g-mr-20">
                     <div class="noty_body__icon">
                        <i class="hs-admin-bolt"></i>
                     </div>
                  </div>
                  <div>Hi, welcome to Voolo. This is example of Toastr notification box.</div>
               </div>
               <div class="noty_close_button">×</div>
            </div>
            <div class="noty_bar noty_type__warning noty_theme__unify--v1 noty_close_with_click noty_has_progressbar noty_has_timeout">
               <div class="noty_body">
                  <div class="g-mr-20">
                     <div class="noty_body__icon">
                        <i class="hs-admin-bolt"></i>
                     </div>
                  </div>
                  <div>Hi, welcome to Voolo. This is example of Toastr notification box.</div>
               </div>
               <div class="noty_progressbar" style="width: 70%;"></div>
            </div>
         </div>
         <!-- End Warning -->
      </div>
   </div>
</div>
        </div>
    </div>

</div>


@endsection