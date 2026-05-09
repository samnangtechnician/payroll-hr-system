  <!-- Bootstrap bundle JS (CDN fallback) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('assets/backend/assets/js/bootstrap.bundle.min.js') }}"></script>
  <!--plugins-->
  <script src="{{ asset('assets/backend/assets/js/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/backend/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
  <script src="{{ asset('assets/backend/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
  <script src="{{ asset('assets/backend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
  <script src="{{ asset('assets/backend/assets/js/pace.min.js') }}"></script>
  <!--app-->
  <script src="{{ asset('assets/backend/assets/js/app.js') }}"></script>

  <x-flasher />

  @stack('scripts')
