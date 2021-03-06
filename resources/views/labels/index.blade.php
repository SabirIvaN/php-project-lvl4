@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center flex-wrap mt-1 mb-3">
        <h2>{{ __('labels.mainTitle') }}</h2>

        @auth
        <div class="btn-toolbar">
            <a class="btn btn-success" href="{{ route('labels.create') }}">{{ __('labels.add') }}</a>
        </div>
        @endauth
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">{{ __('labels.id') }}</th>
                <th scope="col">{{ __('labels.name') }}</th>
                <th scope="col" colspan="3">{{ __('labels.date') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($labels as $label)
            <tr>
                <th scope="row">{{ $label->id }}</th>
                <td>{{ $label->name }}</td>
                <td>{{ $label->created_at }}</td>
                @auth
                <td>
                    <a class="btn btn-primary" href="{{ route('labels.edit', $label) }}">{{ __('labels.edit') }}</a>
                </td>
                <td>
                    @can('delete', $label)
                    <a class="btn btn-danger" href="{{ route('labels.destroy', $label) }}" data-confirm="{{__('labels.confirm')}}" data-method="delete" rel="nofollow">{{__('labels.delete')}}</a>
                    @endcan
                </td>
                @endauth
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
