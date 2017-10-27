@extends('layouts.master')
@section('page-title')
    @parent
    - Usuario
@stop
@section('title')
    <div class="uk-flex uk-flex-between uk-flex-middle">
        <h5 class="uk-card-title uk-margin-remove">Details of the participant</h5>
        <status-button :data-task="{{ $participant }}" :data-exists="{{ $participant->exists ? 1 : 0 }}"></status-button>
    </div>
@stop
@section('main-panel-content')
    <ul class="uk-list uk-list-striped">
        <li>
            <span class="uk-text-muted uk-float-right">Firstname</span>
            <span class="uk-float-left">{{str_limit($participant->firstname, 80)}}</span>
        </li>
        <li>
            <span class="uk-text-muted uk-float-right">Lastname</span>
            <span class="uk-float-left">{{$participant->lastname}}</span>
        </li>
        <li>
            <span class="uk-text-muted uk-float-right">Email</span>
            <span class="uk-float-left">{{$participant->email}}</span>
        </li>
        <li>
            <span class="uk-text-muted uk-float-right">Active</span>
            <span class="uk-float-left">{{$participant->active}}</span>
        </li>
    </ul>
@stop
@section('main-panel-footer')
    <div class="uk-flex uk-flex-between uk-flex-middle">
        <span>
            <a href="{{ route('participant.edit', $participant) }}" class="uk-button uk-button-primary uk-button-small">Edit</a>
            <form class="uk-display-inline" action="{{route('participant.delete', $participant)}}" method="post">
                {{ csrf_field() }}
                {{ method_field('delete') }}
                <button type="submit" class="uk-button uk-button-danger uk-button-small">Delete</button>
            </form>
        </span>
        <a href="" class="uk-button uk-button-primary uk-button-small">Execute</a>
    </div>
@stop
@section('additional-panels')

@stop