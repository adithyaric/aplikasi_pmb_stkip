{{-- @extends('errors::minimal') --}}

@section('title', __('Page Expired'))
{{-- @section('code', '419') --}}
{{-- @section('message', __('Page Expired')) --}}

<h1>Page Expired</h1>
<a href="{{ route('login') }}" class="btn btn-primary">Go to Login</a>
