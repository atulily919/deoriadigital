<!DOCTYPE html>
<html lang="en">

<head>
  <style type="text/css">
.form-control
{
width: 70% !important;
}
div#example2_paginate a{
     padding: 4px 0px 0px 10px;
    cursor: -webkit-grab;
}
a#example2_previous {
    color: black;

}
 .card.card-statistics{
    background:linear-gradient(85deg, #2262A3, #41AFD6) !important;
    }
</style>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Central Organisation</title>
  <link rel="stylesheet" href="{{ asset('/vendors/iconfonts/font-awesome/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('/vendors/css/vendor.bundle.addons.css') }}">
  <link href="{{ asset('/css/jquery.multiselect.css') }}" rel="stylesheet">
   <link href="{{asset('/css/bootstrap-datetimepicker.css')}}" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
  <link rel="shortcut icon" href="{{ asset('/images/favicon.png') }}" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
 </script>
  <script src="{{ asset('js/jquery.table2excel.js') }}"></script>
  <script src="https://cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>


 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
</head>
<body class="sidebar-light">

  <div class="container-scroller">
    @include('partials.navbar')
      <div class="container-fluid page-body-wrapper">
        @include('partials.leftpanel')
        <div class="main-panel">
           @yield('content')
           @include('partials.footer')
        </div>
      </div>
  </div>



  <script src="{{ asset('js/jquery.multiselect.js') }}"></script>
  <script src="{{ asset('js/multiselect.js') }}"></script>
  <script src="{{ asset('/vendors/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('/vendors/js/vendor.bundle.addons.js') }}"></script>
  <script src="{{ asset('/js/off-canvas.js') }}"></script>
  <script src="{{ asset('/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('/js/misc.js') }}"></script>
  <script src="{{ asset('/js/settings.js') }}"></script>
  <script src="{{ asset('/js/todolist.js') }}"></script>
  <script src="{{ asset('js/dashboard.js') }}"></script>
  <script src="{{ asset('js/form-repeater.js') }}"></script>



</body>

</html>
