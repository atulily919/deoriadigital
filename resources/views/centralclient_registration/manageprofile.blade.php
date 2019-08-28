@extends('dashboard')
@section('content')
<div class="content-wrapper">
  <div class="page-header">
    <h3 class="page-title">
      Central Client Registration
    </h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Central Clients</li>
        <li class="breadcrumb-item active" aria-current="page"><a href="">User Profile</a></li>
      </ol>
    </nav>
  </div>
  <div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-header">
          {{ __('User Profile') }}
        </div>
        <div class="card-body">

         @include('message')
          <form method="POST" action="{{url('userprofile/'.$user_detail['id'])}}">
            @csrf
            <div class="form-group">
              <label for="name">{{ __('Name') }}</label>
              <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name',$user_detail['name']) }}" required autofocus>

              @if ($errors->has('name'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
              </span>
              @endif
            </div>

            <div class="form-group">
              <label for="email">{{ __('E-Mail Address') }}</label>
              <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email',$user_detail['email']) }}" required>

              @if ($errors->has('email'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
              </span>
              @endif
            </div>

            <div class="form-group">
              <label for="name">{{ __('Status') }}</label>
              <select class="form-control" name="status">
              <option value="{{$user_detail->Status}}" class="form-control">{{$user_detail->Status}}</option>
               @if($user_detail->Status== 'Active')
              <option value="Inactive" class="form-control">Inactive</option>
              @else
              <option value="Active" class="form-control">Active</option>
              @endif
              </select>
             </div>

          <button type="submit" class="btn btn-primary">
            {{ __('Update Profile') }}
          </button>

          <button type="button" id="reset_pw" class="btn btn-primary password_reset" data-toggle="modal" data-target="#myModal">
            {{ __('Reset Password') }}
          </button>
      </form>

      </div>
    </div>
  </div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel-3">Reset Password</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                                <input type="hidden" id="pass_reset" value="{{$user_detail['id']}}" name="user_id">
                                    <div class="form-group">
                                        <label for="name">New Password</label>
                                        <input type="password" class="form-control" name="new_password" id="newpassword" required="true" size="400">
                                    </div>
                                  <button type="button" id="resetpassword" class="btn btn-primary">Reset</button>
                    </div>

                </div>
        </div>
    </div>
</div>
</div> <!-- /.content -->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="/js/jquery.multiselect.js"></script>

<script type="text/javascript">
  jQuery(document).ready(function($) {
   $('#resetpassword').click(function(event) {
     var id=$('#pass_reset').val();
     var password=$('#newpassword').val();
     var url="{{ URL::to('/userprofileresetpassword')}}";
    $.ajax({
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
      url: url,
      type: 'POST',
      data: {'id': id,'password':password},
       success:function(data){
        alert('Password Updated Successfully');
        location.reload();

       }
    })
   });
  });

</script>
@endsection