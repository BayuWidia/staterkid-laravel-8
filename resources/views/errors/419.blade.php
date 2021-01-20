@extends('layouts.app')

@section('title', 'Kadaluarsa')
@section('code', '419')

@section('content')
<div class="page-error mt-5">
  <div class="page-inner">
    <h1>@lang('419')</h1>
    <div class="page-description">
        @lang('Maaf sesi Anda telah berakhir, segarkan dan coba lagi.')
    </div>
    <div class="page-search">
      <div class="mt-2">
        <a href="{{ route('welcome') }}">@lang('Kembali ke Home')</a>
      </div>
    </div>
  </div>
</div>
@endsection
