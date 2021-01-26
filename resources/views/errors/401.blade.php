@extends('layouts.app')

@section('title', 'Tidak resmi')
@section('code', '401')

@section('content')
<div class="page-error mt-5">
  <div class="page-inner">
    <h1>@lang('401')</h1>
    <div class="page-description">
        @lang('kesalahan dalam memasukkan ID pengguna dan kata sandi yang membuat kredensial menjadi tidak valid karena alasan
                    tertentu.')
    </div>
    <div class="page-search">
      <div class="mt-2">
        <a href="{{ route('dashboard') }}">@lang('Kembali ke Home')</a>
      </div>
    </div>
  </div>
</div>
@endsection
