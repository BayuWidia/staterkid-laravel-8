<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('theme/modules/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('theme/modules/fontawesome/css/all.min.css') }}">
  <!-- Plugins -->
  <link rel="stylesheet" href="{{ asset('theme/modules/bootstrap-social/bootstrap-social.css') }}">
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('theme/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('theme/css/components.css') }}">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{ asset('theme/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('theme/modules/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
  <link rel="stylesheet" href="{{ asset('theme/modules/select2/dist/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('theme/modules/selectric/public/selectric.css') }}">
  <link rel="stylesheet" href="{{ asset('theme/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
  <link rel="stylesheet" href="{{ asset('theme/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">

  <link rel="stylesheet" href="{{ asset('theme/modules/jqvmap/dist/jqvmap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('theme/modules/summernote/summernote-bs4.css') }}">
  <link rel="stylesheet" href="{{ asset('theme/modules/owlcarousel2/dist/assets/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{ asset('theme/modules/owlcarousel2/dist/assets/owl.theme.default.min.css') }}">
</head>
