@extends('layouts.app')

@section('title', 'Terlarang')
@section('code', '403')

@section('content')
<div class="page-error mt-5">
  <div class="page-inner">
    <h1>@lang('403')</h1>
    <div class="page-description">
        @lang('Anda tidak memiliki izin untuk mengakses halaman ini.')
    </div>
    <div class="page-search">
      <div class="mt-2">
        <a href="{{ route('dashboard') }}">@lang('Kembali ke Home')</a>
      </div>
    </div>
  </div>
</div>
@endsection
