<!DOCTYPE html>
<html lang="lang=" {{ str_replace('_', '-', app()->getLocale()) }}"">

<x-header />
@stack('style')
<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <x-navbar />
      <x-sidebar />
        <div class="main-content">
          <section class="section">
            @if(!Route::is('dashboard'))
              <x-breadcrumb />
            @endif
            @yield('content')
            <x-loader />
          </section>
        <div>
      <x-footer />
    </div>
  </div>

  <x-script />
  <x-script-util />
  @stack('script')
</body>

</html>
