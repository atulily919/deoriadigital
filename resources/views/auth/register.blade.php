@extends('dashboard')
@section('content')


<div class="content-wrapper">
  <div class="page-header">
    <h3 class="page-title">
      Client Features
    </h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
       <li class="breadcrumb-item">Central Clients</li>
       <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('/register')}}"> Registration</a></li>
       <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('showregister')}}">Show Central Clients</a></li>
     </ol>
   </nav>
 </div>
 <div class="row">
  <div class="col-12 grid-margin stretch-card">
    <div class="card">
     <div class="card-header">{{ __('Register') }}</div>
     <div class="card-body">

       @if (count($errors) > 0)
       <div class = "alert alert-danger">
        <ul>
         @foreach ($errors->all() as $error)
         <li style="color: red">{{ $error }}</li>
         @endforeach
       </ul>
     </div>
     @endif
     <form method="POST" action="{{ route('register') }}">
      @csrf
      <div class="form-group">
        <label for="name">{{ __('Name') }}</label>
        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

        @if ($errors->has('name'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('name') }}</strong>
        </span>
        @endif
      </div>

      <div class="form-group">
        <label for="email">{{ __('E-Mail Address') }}</label>
        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

        @if ($errors->has('email'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
      </div>

      <div class="form-group">
        <label for="password">{{ __('Password') }}</label>

        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

        @if ($errors->has('password'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('password') }}</strong>
        </span>
        @endif
      </div>

      <div class="form-group">
        <label for="password-confirm">{{ __('Confirm Password') }}</label>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
      </div>

      <button type="submit" class="btn btn-primary">
        {{ __('Register') }}
      </button>
    </form>
  </div>
  <!-- /.card-body -->
</div>

</section>
<!-- right col -->
</div>
<!-- /.row (main row) -->

<!-- /.content -->
</div>
@endsection