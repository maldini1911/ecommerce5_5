@include('admin.layouts.header')
@include('admin.layouts.nav')


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        @if(session('lang') == "ar")

          {{trans('admin.dashboard')}}
        
        @else

            Dashboard
        @endif
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    @include('admin.layouts.message')
    @yield('content')

</section>
</div>

@include('admin.layouts.footer')