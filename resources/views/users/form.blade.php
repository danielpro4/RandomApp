@extends('layouts.master')
@section('page-title')
    @parent
    - {{ $user->exists ? 'Update' : 'Create'}} Update
@stop
@section('main-panel-before')
    <form action="{{ request()->fullUrl() }}" method="POST" class="uk-form-horizontal">
        {{csrf_field()}}
        @stop
        @section('title')
            <div class="uk-flex uk-flex-between uk-flex-middle">
                <h5 class="uk-card-title uk-margin-remove">{{ $user->exists ? 'Actualizar' : 'Crear'}} Usuario</h5>
            </div>
        @stop
        @section('main-panel-content')
            <div class="uk-margin">
                <label class="uk-form-label">Nombre</label>
                <div class="uk-form-controls">
                    <input class="uk-input" placeholder="Escribir nombre de usuario, e.g. Daniel" name="name" id="name"
                           value="{{old('name', $user->name)}}" type="text">
                    @if($errors->has('name'))
                        <div class="uk-text-danger">{{$errors->first('name')}}</div>
                    @endif
                </div>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label">Correo Electrónico</label>
                <div class="uk-form-controls">
                    <input class="uk-input" placeholder="Escribir email de usuario, e.g. daniel.perez.atanacio@gmail.com" name="email" id="email"
                           value="{{old('email', $user->email)}}" type="text">
                    @if($errors->has('email'))
                        <div class="uk-text-danger">{{$errors->first('email')}}</div>
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