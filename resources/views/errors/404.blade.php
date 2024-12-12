{{-- @extends('errors::minimal') --}}

@section('title', __('Not Found'))
{{-- @section('code', '404') --}}
{{-- @section('message', __('Not Found')) --}}

<h1>Not Found</h1>
<a href="{{ route('login') }}" class="btn btn-primary">Go to Login</a>
