@extends('dashboard')
@section('content')
<style>
 .flip {
  padding: 5px;
  text-align: center;
  background-color: #aab2bd;
  border: solid 1px #6f5f7f;
}

.panel {
  padding: 50px;
  display: none;
  border: solid 1px #6f5f7f;
}
</style>
</style>
<div class="content-wrapper">
  <div class="page-header">
    <h3 class="page-title">
      Assign Role Privileges
    </h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Assign Role Privilege</li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{url('privileges')}}">Assign</a></li>

      </ol>
    </nav>
  </div>
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
       @include('message')
       <div class="card-body">
        <!--  <h4 class="card-title">Data table</h4> -->
        <form method="post" action="{{ url('storeassignprivileges') }}">
          <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
          <div class="row">
            <div class="col-12">
              @foreach($allclients as $clients)  <!-- clientloop -->

              <div id="flip_{{$clients['id']}}" class="flip" onclick="toggle({{$clients['id']}})">{{$clients->name}}</div>
              <div id="panel_{{$clients['id']}}" class="panel">
                @foreach($allroles as $roles) <!-- roleloop -->

                <ul>
                  <li><h5>{{$roles['rolename']}}</h5></li>
                  @if(empty($role_privileges)) <!-- if rolepriv is empty -->
                  @foreach($pages as $page)   <!-- pagesloop -->
                  @if($page['parent_page']==0 && $page['url']!='#')
                  <label><input type="checkbox" name="pages_id[]" value="{{$clients['id']}}-{{$roles['id']}}-{{$page['id']}}" class="selectall"><font size="+1">{{$page['page_name']}}</font></label><br>
                  @elseif($page['parent_page'] ==0 && $page['url']== '#')
                  <label><font size="+1">&nbsp&nbsp
                  {{$page['page_name']}}</font></label><br>

                  @foreach($subpages as $subpage) <!-- subpagesloop -->
                  @if($subpage['parent_page']==$page['id'])
                  <ul>
                    <label><input type="checkbox" name="subpages_names[]" value="{{$clients['id']}}-{{$roles['id']}}-{{$subpage['id']}}" class="selectall"><font size="+1">{{$subpage['page_name']}}</font></label><br>
                  </ul>
                  @endif
                  @endforeach  <!-- end subpagesloop -->
                  @endif
                  @endforeach<!-- end pagesloop -->
                  @else <!-- else if rolepriv is not empty -->
                  @foreach($pages as $page)   <!-- pagesloop -->
                  <?php unset($checked)?>


                  @foreach($role_privileges as $privilege)

                  @if($privilege['client_id']==$clients['id'] && $privilege['roles_id']==$roles['id'] && $privilege['pages_id']==$page['id'])
                  <?php $checked[] = "checked";?>

                  @else
                  <?php $checked[] = "unchecked";?>

                  @endif
                  @endforeach

                  <?php// print_r($checked); ?>

                  @if($page['parent_page']==0 && $page['url']!='#')
                  @if(in_array("checked",$checked))
                  <label><input type="checkbox" name="pages_id[]" value="{{$clients['id']}}-{{$roles['id']}}-{{$page['id']}}" class="selectall" checked><font size="+1">{{$page['page_name']}}</font></label><br>
                  @else
                  <label><input type="checkbox" name="pages_id[]" value="{{$clients['id']}}-{{$roles['id']}}-{{$page['id']}}" class="selectall"><font size="+1">{{$page['page_name']}}</font></label><br>
                  @endif
                  @elseif($page['parent_page'] ==0 && $page['url']== '#')
                  <label><font size="+1">&nbsp&nbsp
                  {{$page['page_name']}}</font></label><br>


                  @foreach($subpages as $subpage) <!-- subpagesloop -->
                  <?php unset($checked1)?>
                  @foreach($role_privileges as $privilege)

                  @if($page['id']==$subpage['parent_page'])

                  @if($privilege['client_id']==$clients['id'] && $privilege['roles_id']==$roles['id']  &&
                  $privilege['pages_id']==$subpage['id'])

                  <?php $checked1[] = "checked";?>

                  @else

                  <?php $checked1[] = "unchecked";?>

                  @endif
                  @endif
                  @endforeach

                  @if($subpage['parent_page']==$page['id'])

                  @if(in_array("checked",$checked1))
                  <ul>
                    <label><input type="checkbox" name="subpages_names[]" value="{{$clients['id']}}-{{$roles['id']}}-{{$subpage['id']}}" class="selectall"checked><font size="+1" >{{$subpage['page_name']}}</font></label><br>
                  </ul>
                  @else
                  <ul>
                    <label><input type="checkbox" name="subpages_names[]" value="{{$clients['id']}}-{{$roles['id']}}-{{$subpage['id']}}" class="selectall"><font size="+1" >{{$subpage['page_name']}}</font></label><br>
                  </ul>

                  @endif
                  @endif
                  @endforeach  <!-- end subpagesloop -->
                  @endif
                  @endforeach<!-- end pagesloop -->

                  @endif <!-- end if rolepriv is empty -->
                </ul>

                @endforeach <!-- endroleloop -->
              </div><br>
              @endforeach  <!-- endclientloop -->
            </div>
          </div>
          <div class="row">
            <button type="submit" class="btn btn-primary mr-2">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- modal body -->
<!-- closed modal body -->
</div>
<script>

  function toggle($id)
  {
    var panel="#panel_"+$id;
    $(panel).slideToggle("slow");

  }

  function check($clientid,$roleid,$features_id)
  {
    var subf=".check_"+$clientid+"_"+$roleid+"_"+$features_id;
    //$(subf).attr('checked', true);


    if ($(".selectall").is(':checked')) {
     $(subf).attr('checked', true);
   } else {
     $(subf).attr('checked', false);
   }



 }
</script>
@endsection
