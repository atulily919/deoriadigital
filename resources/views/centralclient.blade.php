
<!DOCTYPE html>
<html lang="en">

<head>
  <style type="text/css">
    .form-control
    {
      width: 70% !important;
    }

    label.badge.badge-outline-success.badge-pill #clientData {
      background: none;
      border: none;
      color: white;
      font-size: 15px;
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
  <link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
</head>
<body>

  <div class="container-scroller">
    @include('partials.navbar')
    <div class="container-fluid page-body-wrapper">

      <div class="main-panel">
        <div class="content-wrapper" style="width:125%">

          <div class="page-header">
            <h3 class="page-title">Dashboard</h3>
          </div>
          <div class="row grid-margin">
            <div class="col-12">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                   <?php
if (session()->has('clientid') && session()->has('roleid')) {
	Session::forget('clientid');
	Session::forget('roleid');
}
//dd($privileges);
?>
                   @if(count($privileges) > 0)
                   @foreach($privileges as $privilege)
                   <form action="/home" method="get">
                    <input type="hidden" name="clientid" value="{{$privilege[0]['clientname']['id']}}">
                    <input type="hidden" name="roleid" value="{{$privilege[0]['rolename']['id']}}">

                    <div class="statistics-item">

                      <h2>{{$privilege[0]['clientname']['name']}}</h2>
                      <label class="badge badge-outline-success badge-pill"><button type="submit" id="clientData">{{$privilege[0]['rolename']['rolename']}}</button></label>

                    </div>
                  </form>

                  @endforeach
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>
  @include('partials.footer')
</div>
</div>
</div>
</div>

<!-- content-wrapper ends -->



<script src="{{ asset('js/multiselect.js') }}"></script>
<script src="{{ asset('/vendors/js/vendor.bundle.base.js') }}"></script>
<script src="{{ asset('/vendors/js/vendor.bundle.addons.js') }}"></script>
<script src="{{ asset('/js/off-canvas.js') }}"></script>
<script src="{{ asset('/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('/js/misc.js') }}"></script>
<script src="{{ asset('/js/settings.js') }}"></script>
<script src="{{ asset('/js/todolist.js') }}"></script>
<script src="{{ asset('js/dashboard.js') }}"></script>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

</script>

</html>