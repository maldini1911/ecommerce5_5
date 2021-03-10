<header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

       @include('admin.layouts.menu')

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{url('/')}}/design/admin/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Islam Adel</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>

      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header"></li>

<!-- Start Dashboard -->
    <li class="treeview {{acitve_menu('settings')[0]}}">
  
  <a href="#">
    <i class="fa fa-dashboard"></i><span> {{trans('admin.dashboard')}}</span>
  </a>

  <ul class="treeview-menu" style="{{acitve_menu('settings')[1]}}">

        <li><a href="{{url('dashboard')}}"><i class="fa fa-circle-o"></i>  {{trans('admin.dashboard')}}</a></li>
        <li><a href="{{url('settings')}}"><i class="fa fa-cogs"></i>  {{trans('admin.settings')}}</a></li>
</ul>
<!-- End Dashboard -->

<!-- Start Admins -->
        <li class="treeview {{acitve_menu('admins')[0]}}">
  
          <a href="#">
            <i class="fa fa-dashboard"></i><span> {{trans('admin.admin')}}</span>
          </a>

          <ul class="treeview-menu" style="{{acitve_menu('admins')[1]}}">

            <li><a href="{{url('admins')}}"><i class="fa fa-circle-o"></i> {{trans('admin.master')}}</a></li>
        </ul>
  <!-- End Admins -->
    
  <!-- Strt Users -->    
  <li class="treeview {{acitve_menu('users')[0]}}">
  
  <a href="#">
    <i class="fa fa-users"></i> <span>{{trans('admin.users')}}</span></a>
  <ul class="treeview-menu" style="{{acitve_menu('users')[1]}}">

  <li><a href="{{url('users')}}"><i class="fa fa-users"></i> {{trans('admin.users')}}</a></li>
  <li><a href="{{url('users')}}?level=user"><i class="fa fa-users"></i> {{trans('admin.user')}}</a></li>
  <li><a href="{{url('users')}}?level=company"><i class="fa fa-users"></i> {{trans('admin.company')}}</a></li>
  <li><a href="{{url('users')}}?level=vendor"><i class="fa fa-users"></i> {{trans('admin.vendor')}}</a></li>
</ul>
<!-- End Users -->
      
  <!-- Start Countryes -->    
  <li class="treeview {{acitve_menu('countries')[0]}}">
  
  <a href="#">
    <i class="fa fa-flag"></i> <span>{{trans('admin.countries')}}</span></a>
  <ul class="treeview-menu" style="{{acitve_menu('countries')[1]}}">

  <li><a href="{{url('countries')}}"><i class="fa fa-flag"></i> {{trans('admin.countries')}}</a></li>
  <li><a href="{{url('countries/create')}}"><i class="fa fa-plus"></i> {{trans('admin.add')}}</a></li>
</ul>
  <!-- End Countryes -->  

<!-- Start Cities -->    
<li class="treeview {{acitve_menu('cities')[0]}}">
  
  <a href="#">
    <i class="fa fa-flag"></i> <span>{{trans('admin.cities')}}</span>
  </a>
<ul class="treeview-menu" style="{{acitve_menu('cities')[1]}}">

  <li><a href="{{url('cities')}}"><i class="fa fa-flag"></i> {{trans('admin.cities')}}</a></li>
  <li><a href="{{url('cities/create')}}"><i class="fa fa-plus"></i> {{trans('admin.add')}}</a></li>
</ul>
<!-- End Cities -->  

<!-- Start States -->    
<li class="treeview {{acitve_menu('states')[0]}}">
  
  <a href="#">
    <i class="fa fa-flag"></i> <span>{{trans('admin.states')}}</span>
  </a>
<ul class="treeview-menu" style="{{acitve_menu('states')[1]}}">

  <li><a href="{{url('states')}}"><i class="fa fa-flag"></i> {{trans('admin.states')}}</a></li>
  <li><a href="{{url('states/create')}}"><i class="fa fa-plus"></i> {{trans('admin.add')}}</a></li>
</ul>
<!-- End States -->  

<!-- Start Departments -->    
<li class="treeview {{acitve_menu('departments')[0]}}">
  
  <a href="#">
    <i class="fa fa-list"></i> <span>{{trans('admin.departments')}}</span>
  </a>
<ul class="treeview-menu" style="{{acitve_menu('departments')[1]}}">

  <li><a href="{{url('departments')}}"><i class="fa fa-list"></i> {{trans('admin.departments')}}</a></li>
  <li><a href="{{url('departments/create')}}"><i class="fa fa-plus"></i> {{trans('admin.add')}}</a></li>
</ul>
<!-- End Departments -->  

<!-- Start TradeMarks -->    
<li class="treeview {{acitve_menu('trademarks')[0]}}">
  
  <a href="#">
    <i class="fa fa-cube"></i> <span>{{trans('admin.trademarks')}}</span>
  </a>
<ul class="treeview-menu" style="{{acitve_menu('trademarks')[1]}}">

  <li><a href="{{url('trademarks')}}"><i class="fa fa-cube"></i> {{trans('admin.trademarks')}}</a></li>
  <li><a href="{{url('trademarks/create')}}"><i class="fa fa-plus"></i> {{trans('admin.add')}}</a></li>
</ul>
<!-- End TradeMarks -->  

<!-- Start Manufacturers -->    
<li class="treeview {{acitve_menu('manufacturers')[0]}}">
  
  <a href="#">
    <i class="fa fa-cube"></i> <span>{{trans('admin.manufacturers')}}</span>
  </a>
<ul class="treeview-menu" style="{{acitve_menu('manufacturers')[1]}}">

  <li><a href="{{url('manufacturers')}}"><i class="fa fa-cube"></i> {{trans('admin.manufacturers')}}</a></li>
  <li><a href="{{url('manufacturers/create')}}"><i class="fa fa-plus"></i> {{trans('admin.add')}}</a></li>
</ul>
<!-- End Manufacturers -->  

<!-- Start Shippings -->    
<li class="treeview {{acitve_menu('shippings')[0]}}">
  
  <a href="#">
    <i class="fa fa-cube"></i> <span>{{trans('admin.shippings')}}</span>
  </a>
<ul class="treeview-menu" style="{{acitve_menu('shippings')[1]}}">

  <li><a href="{{url('shippings')}}"><i class="fa fa-cube"></i> {{trans('admin.shippings')}}</a></li>
  <li><a href="{{url('shippings/create')}}"><i class="fa fa-plus"></i> {{trans('admin.add')}}</a></li>
</ul>
<!-- End Shippings -->  

<!-- Start Malls -->    
<li class="treeview {{acitve_menu('malls')[0]}}">
  
  <a href="#">
    <i class="fa fa-cube"></i> <span>{{trans('admin.malls')}}</span>
  </a>
<ul class="treeview-menu" style="{{acitve_menu('malls')[1]}}">

  <li><a href="{{url('malls')}}"><i class="fa fa-cube"></i> {{trans('admin.malls')}}</a></li>
  <li><a href="{{url('malls/create')}}"><i class="fa fa-plus"></i> {{trans('admin.add')}}</a></li>
</ul>
<!-- End Malls --> 

<!-- Start Colors -->    
<li class="treeview {{acitve_menu('colors')[0]}}">
  
  <a href="#">
    <i class="fa fa-cube"></i> <span>{{trans('admin.colors')}}</span>
  </a>
<ul class="treeview-menu" style="{{acitve_menu('colors')[1]}}">

  <li><a href="{{url('colors')}}"><i class="fa fa-cube"></i> {{trans('admin.colors')}}</a></li>
  <li><a href="{{url('colors/create')}}"><i class="fa fa-plus"></i> {{trans('admin.add')}}</a></li>
</ul>
<!-- End Colors --> 

<!-- Start Sizes -->    
<li class="treeview {{acitve_menu('sizes')[0]}}">
  
  <a href="#">
    <i class="fa fa-cube"></i> <span>{{trans('admin.sizes')}}</span>
  </a>
<ul class="treeview-menu" style="{{acitve_menu('sizes')[1]}}">

  <li><a href="{{url('sizes')}}"><i class="fa fa-cube"></i> {{trans('admin.sizes')}}</a></li>
  <li><a href="{{url('sizes/create')}}"><i class="fa fa-plus"></i> {{trans('admin.add')}}</a></li>
</ul>
<!-- End Sizes --> 

<!-- Start Weights -->    
<li class="treeview {{acitve_menu('weights')[0]}}">
  
  <a href="#">
    <i class="fa fa-cube"></i> <span>{{trans('admin.weights')}}</span>
  </a>
<ul class="treeview-menu" style="{{acitve_menu('weight')[1]}}">

  <li><a href="{{url('weights')}}"><i class="fa fa-cube"></i> {{trans('admin.weights')}}</a></li>
  <li><a href="{{url('weights/create')}}"><i class="fa fa-plus"></i> {{trans('admin.add')}}</a></li>
</ul>
<!-- End Weights --> 

<!-- Start Products -->    
<li class="treeview {{acitve_menu('products')[0]}}">
  
  <a href="#">
    <i class="fa fa-tag"></i> <span>{{trans('admin.products')}}</span>
  </a>
<ul class="treeview-menu" style="{{acitve_menu('products')[1]}}">

  <li><a href="{{url('products')}}"><i class="fa fa-tag"></i> {{trans('admin.products')}}</a></li>
  <li><a href="{{url('products/create')}}"><i class="fa fa-plus"></i> {{trans('admin.add')}}</a></li>
</ul>
<!-- End Products  --> 

  </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
