@include('admin.layouts.admin_partials.head')

<body>
<div id="app">

  <!--start wrapper-->
  <div class="wrapper">
    <!--start top header-->
    @include('admin.layouts.admin_partials.header')
       <!--end top header-->

       <!--start sidebar -->
       @include('admin.layouts.admin_partials.left_sidebar')
       <!--end sidebar -->

       <!--start content-->
          <main class="page-content">
            @hasSection('breadcrumbs')
              @yield('breadcrumbs')
            @else
              <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">@yield('pageTitle', config('app.name'))</div>
                <div class="breadcrumb-actions ms-auto">
                  @yield('page-actions')
                </div>
              </div>
            @endif

            @yield('content')

          </main>
       <!--end page main-->


       <!--start overlay-->
        <div class="overlay nav-toggle-icon"></div>
       <!--end overlay-->

        <!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->

  </div>
  <!--end wrapper-->

</div>
@include('admin.layouts.admin_partials.scripts')

</body>

</html>
