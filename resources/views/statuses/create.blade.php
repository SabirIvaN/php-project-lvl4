@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mt-1 mb-3">{{ __('statuses.adderTitle') }}</h2>
    {{ Form::open(['url' => route('statuses.store'), 'method' => 'POST', 'class' => 'form-row']) }}

    @include('statuses.form')

    {{ Form::close() }}
</div>
@endsection
