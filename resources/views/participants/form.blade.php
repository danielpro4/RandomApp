@extends('layouts.master')
@section('page-title')
    @parent
    - {{ $participant->exists ? 'Update' : 'Create'}} Participant
@stop
@section('main-panel-before')
    <form action="{{ request()->fullUrl() }}" method="POST" class="uk-form-horizontal">
        {{csrf_field()}}
        @stop
        @section('title')
            <div class="uk-flex uk-flex-between uk-flex-middle">
                <h5 class="uk-card-title uk-margin-remove">{{ $participant->exists ? 'Update' : 'Create'}} Participant</h5>
            </div>
        @stop
        @section('main-panel-content')

            <div class="uk-margin">
                <label class="uk-form-label">Firstname</label>
                <div class="uk-form-controls">
                    <input class="uk-input" placeholder="Firstname" name="firstname" id="firstname"
                           value="{{old('firstname', $participant->firstname)}}" type="text">
                    @if($errors->has('firstname'))
                        <div class="uk-text-danger">{{$errors->first('firstname')}}</div>
                    @endif
                </div>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label">Lastname</label>
                <div class="uk-form-controls">
                    <input class="uk-input" placeholder="Lastname" name="lastname" id="lastname"
                           value="{{old('lastname', $participant->lastname)}}" type="text">
                    @if($errors->has('lastname'))
                        <div class="uk-text-danger">{{$errors->first('lastname')}}</div>
                    @endif
                </div>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label">E-mail</label>
                <div class="uk-form-controls">
                    <input class="uk-input" placeholder="E-mail" name="email" id="email"
                           value="{{old('email', $participant->email)}}" type="text">
                    @if($errors->has('email'))
                        <div class="uk-text-danger">{{$errors->first('email')}}</div>
                    @endif
                </div>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label">Birth Day</label>
                <div class="uk-form-controls">
                    <input class="uk-input" placeholder="yyyy/mm/dd" name="birth" id="birth"
                           value="{{old('birth', $participant->birth)}}" type="text">
                    @if($errors->has('birth'))
                        <div class="uk-text-danger">{{$errors->first('birth')}}</div>
                    @endif
                </div>
            </div>

           <div class="uk-margin">
                <label class="uk-form-label">XP</label>
                <div class="uk-form-controls">
                    <input class="uk-input" placeholder="0" name="xp" id="xp"
                           value="{{old('xp', $participant->xp)}}" type="number">
                    @if($errors->has('xp'))
                        <div class="uk-text-danger">{{$errors->first('xp')}}</div>
                    @endif
                </div>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label">Active</label>
                <div class="uk-form-controls">
                    <input class="uk-radio" placeholder="0" name="active" id="active"
                           value="{{old('active', $participant->active)}}" type="checkbox">
                    @if($errors->has('active'))
                        <div class="uk-text-danger">{{$errors->first('active')}}</div>
                    @endif
                </div>
            </div>



        @stop
        @section('main-panel-footer')
            <button class="uk-button uk-button-primary uk-button-small" type="submit">Guardar</button>
        @stop

        @section('main-panel-after')
    </form>
@stop