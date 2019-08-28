
<?php
use App\Models\pages;
use Illuminate\Support\Facades\Session;
?>
<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-profile">
      <div class="nav-link">

      </div>
    </li>
    <?php
if (isset($_REQUEST['clientid']) && isset($_REQUEST['roleid'])) {

	session::put(['clientid' => $_REQUEST['clientid'], 'roleid' => $_REQUEST['roleid']]);

	$clientid = session('clientid');
	$roleid = session('roleid');
	?>

     @if(isset($clientid) && isset($roleid))
     <?php
$data = App\Models\assign_role_privilege::where('assign_role_privileges.client_id', $clientid)->where('assign_role_privileges.roles_id', $roleid)->leftjoin('pages', 'pages.id', 'assign_role_privileges.pages_id')->select('assign_role_privileges.*', 'pages.page_name', 'pages.url', 'pages.parent_page', 'pages.id as pageid', 'pages.icon')->where('pages.status', 'Active')->get()->toArray();
	//dd($data);
	$i = 1;
	?>
     @foreach($data as $pagedata)

     @if($pagedata['parent_page']==0)
     <li class="nav-item">
      <a class="nav-link" href="{{$pagedata['url']}}">
        <i class="{{$pagedata['icon']}} "></i>
        <span class="menu-title">&nbsp&nbsp {{$pagedata['page_name']}}</span>
        <i class="menu-arrow"></i>
      </a>

    </li>
    @else
    @if($pagedata['parent_page'] !=0)
    <?php
$parent_pagename = App\Models\pages::select('page_name', 'url', 'icon')->where('id', $pagedata['parent_page'])->where('url', '#')->first();

	?>
    <li class="nav-item">
      @while($i <= 1)
      <a class="nav-link" data-toggle="collapse" href="#{{$pagedata['pageid']}}form-elements" aria-expanded="false" aria-controls="form-elements">
        <i class="fab fa-wpforms menu-icon"></i>
        <span class="menu-title"> {{$parent_pagename['page_name']}}</span>
        <i class="menu-arrow"></i>
      </a>
      <?php
$i++;
	?>
      @endwhile
      <?php

	$parentid = pages::join('assign_role_privileges', 'assign_role_privileges.pages_id', 'pages.id')->select('pages.*')->where('pages.parent_page', $pagedata['parent_page'])->where('pages.status', 'ACTIVE')->where('assign_role_privileges.client_id', $clientid)->where('assign_role_privileges.roles_id', $roleid)->get()->toArray();
	?>
      <div class="collapse" id="{{$pagedata['pageid']}}form-elements">
        <ul class="nav flex-column sub-menu">
          @foreach($parentid as $parent_data)

          <li class="nav-item"><a class="nav-link" href="{{url($parent_data['url'])}}
            ">{{$parent_data['page_name']}}</a></li>

            @endforeach

          </ul>
        </div>

      </li>
      @endif

      @endif


      @endforeach
      @endif
      <?php
} elseif (empty($_REQUEST['clientid']) && empty($_REQUEST['roleid']) && !empty(session()->has('clientid')) && !empty(session()->has('roleid'))) {
	$clientid = session('clientid');
	//dd($clientid);
	$roleid = session('roleid');
	?>
     @if(isset($clientid) && isset($roleid))
     <?php
$data = App\Models\assign_role_privilege::where('assign_role_privileges.client_id', $clientid)->where('assign_role_privileges.roles_id', $roleid)->leftjoin('pages', 'pages.id', 'assign_role_privileges.pages_id')->select('assign_role_privileges.*', 'pages.page_name', 'pages.url', 'pages.parent_page', 'pages.id as pageid', 'pages.icon')->where('pages.status', 'Active')->get()->toArray();
	$i = 1;
	?>
     @foreach($data as $pagedata)

     @if($pagedata['parent_page']==0 && $pagedata['url'] != '#')
     <li class="nav-item">
      <a class="nav-link" href="{{$pagedata['url']}}">
        <i class="{{$pagedata['icon']}}"></i>
        <span class="menu-title"> &nbsp&nbsp{{$pagedata['page_name']}}</span>
        <i class="menu-arrow"></i>

      </a>
    </li>
    @else
    @if($pagedata['parent_page'] !=0)
    <?php
$parent_pagename = App\Models\pages::select('page_name', 'url')->where('id', $pagedata['parent_page'])->where('url', '#')->where('status', 'Active')->first();
	//dd($parent_pagename['page_name']);

	?>
    @while($i <= 1)
    <li class="nav-item">

     <a class="nav-link" data-toggle="collapse" href="#{{$pagedata['pageid']}}form-elements" aria-expanded="false" aria-controls="form-elements">
      <i class="fab fa-wpforms menu-icon"></i>
      <span class="menu-title">{{$parent_pagename['page_name']}}</span>
      <i class="menu-arrow"></i>
    </a>

    <?php

	$parentid = pages::join('assign_role_privileges', 'assign_role_privileges.pages_id', 'pages.id')->select('pages.*')->where('pages.parent_page', $pagedata['parent_page'])->where('pages.status', 'ACTIVE')->where('assign_role_privileges.client_id', $clientid)->where('assign_role_privileges.roles_id', $roleid)->get();
	?>
    <div class="collapse" id="{{$pagedata['pageid']}}form-elements">
      <ul class="nav flex-column sub-menu">
        @foreach($parentid as $parent_data)


        <li class="nav-item"><a class="nav-link" href="{{url($parent_data['url'])}}
          ">{{$parent_data['page_name']}}</a></li>

          @endforeach

        </ul>
      </div>

    </li>
    <?php
$i++;
	?>
    @endwhile
    @endif

    @endif
    @endforeach
    @endif
    <?php

} else {

	if (empty($_REQUEST['clientid']) && empty($_REQUEST['roleid']) && empty(session()->has('clientid')) && empty(session()->has('roleid'))) {
		$page = App\Models\pages::all();
		$i = 1;
		//dd($page);
		?>
    @foreach($page as $page_name)
    @if($page_name['parent_page']=='0' && $page_name['url'] != '#')

    <li class="nav-item">
      <a class="nav-link" href="{{$page_name['url']}}">
        <i class="{{$page_name['icon']}}"></i>
        <span class="menu-title"> &nbsp&nbsp{{$page_name['page_name']}}</span>
        <i class="menu-arrow"></i>
      </a>
    </li>
    @elseif($page_name['parent_page']=='0' && $page_name['url'] == '#')

    <li class="nav-item">

      <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
        <i class="fab fa-wpforms menu-icon"></i>
        <span class="menu-title">&nbsp&nbsp{{$page_name['page_name']}}</span>
        <i class="menu-arrow"></i>
      </a>
      @elseif($page_name['parent_page']!='0' && $page_name['url'] != '#')
      <?php
$subpage_data = App\Models\pages::where('parent_page', '!=', '0')->where('status', 'Active')->get();
		?>


      <div class="collapse" id="form-elements">
        <ul class="nav flex-column sub-menu">

         @while($i <= 1)

         @foreach($subpage_data as $subpageData)
         <li class="nav-item"><a class="nav-link" href="{{url($subpageData['url'])}}
          ">{{$subpageData['page_name']}}</a></li>
          <?php $i++;?>
          @endforeach
          @endwhile
        </ul>

      </div>
    </li>
    @endif
    @endforeach
    <?php
}
}
?>


</ul>
</nav>