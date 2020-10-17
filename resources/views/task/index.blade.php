@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center flex-wrap mt-1 mb-1">
        <h2>{{ __('task.mainTitle') }}</h2>

        <div class="btn-toolbar">
            <a class="btn btn-success" href="{{ route('task.create') }}">{{ __('task.add') }}</a>
        </div>
    </div>

    {{ Form::open(['url' => route('task.index'), 'method' => 'GET', 'class' => 'form-row']) }}

    <div class="form-group col-md-2">
        {{ Form::select('filter[status_id]', $statuses, request()->input('filter.status_id'), ['class' => 'form-control', 'placeholder' => 'All statuses'])  }}
    </div>

    <div class="form-group col-md-2">
        {{ Form::select('filter[created_by_id]', $creators, request()->input('filter.created_by_id'), ['class' => 'form-control', 'placeholder' => 'All creators'])  }}
    </div>

    <div class="form-group col-md-2">
        {{ Form::select('filter[assigned_to_id]', $assigners, request()->input('filter.assigned_to_id'), ['class' => 'form-control', 'placeholder' => ' All assigners'])  }}
    </div>

    <div class="form-group col-md-1">
        {{ Form::submit(__('task.apply'), ['class' => 'btn btn-primary']) }}
    </div>

    {{ Form::close() }}

    <table class="table">
        <thead>
            <tr>
                <th scope="col">{{ __('task.id') }}</th>
                <th scope="col">{{ __('task.name') }}</th>
                <th scope="col">{{ __('task.description') }}</th>
                <th scope="col">{{ __('task.status') }}</th>
                <th scope="col">{{ __('task.label') }}</th>
                <th scope="col">{{ __('task.creator') }}</th>
                <th scope="col">{{ __('task.assignee') }}</th>
                <th scope="col" colspan="3">{{ __('task.date') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
            <tr>
                <th scope="row">{{ $task->id }}</th>
                <td>{{ $task->name }}</td>
                <td>{{ $task->description }}</td>
                <td>
                    @if($task->status()->exists())
                    {{ $task->status->name }}
                    @endif
                </td>
                <td>
                    @foreach($task->labels as $label)
                    {{ $label->name .  " "}}
                    @endforeach
                </td>
                <td>{{ $task->createdBy->name }}</td>
                <td>
                    @if($task->assignedTo()->exists())
                    {{ $task->assignedTo->name }}
                    @endif
                </td>
                <td>{{ $task->created_at }}</td>
                <td>
                    @if(Auth::user())
                    @if(Auth::user()->id === $task->createdBy->id)
                    <a class="btn btn-primary" href="{{ route('task.edit', $task) }}">{{ __('task.edit') }}</a>
                    @endif
                    @endif
                </td>
                <td>
                    @if(Auth::user())
                    @if(Auth::user()->id === $task->createdBy->id)
                    <a class="btn btn-danger" href="{{ route('task.destroy', $task) }}" data-confirm="{{__('task.confirm')}}" data-method="delete" rel="nofollow">{{__('task.delete')}}</a>
                    @endif
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
