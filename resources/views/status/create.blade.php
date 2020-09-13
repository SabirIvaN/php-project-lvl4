@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mt-1 mb-3">{{ __('status.adderTitle') }}</h2>
    <form class="form-row" action="{{ route('status.store') }}" method="POST">
        @csrf
        <div class="form-group col-md-12">
            <label for="name">{{ __('status.name') }}</label>
            <input class="form-control mr-2" id="name" name="name" type="text">
        </div>
        <div class="form-group col-md-12">
            <button class="btn btn-primary" type="submit">{{ __('status.save') }}</button>
        </div>
    </form>
</div>
@endsection
