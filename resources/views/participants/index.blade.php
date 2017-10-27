@extends("layouts.master")
@section('page-title')
    @parent
    - Participants
@stop
@section('title')
    <div class="uk-flex uk-flex-between uk-flex-middle">
        <h4 class="uk-card-title uk-margin-remove">Participants</h4>
        <form class="uk-display-inline uk-search uk-search-default">
            <span class="uk-icon uk-search-icon">
                <icon name="search" :scale="100">
                    <svg version="1.1" role="presentation" width="17.857142857142858" height="17.857142857142858"
                         viewBox="0 0 20 20" class="svg-icon active" style="font-size: 100em;">
                        <path d="M2 9a7 7 0 1 0 14 0a7 7 0 1 0 -14 0z" fill="none" stroke="#000"></path>
                        <path d="M14,14 L18,18 L14,14 Z" fill="none" stroke="#000"></path>
                    </svg>
                </icon>
            </span>

            <input class="uk-search-input" type="search" placeholder="Search...">
        </form>
    </div>
@stop
@section('main-panel-content')
    <table class="uk-table uk-table-responsive uk-table-divider" cellpadding="0" cellspacing="0" class="mb1">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>E-mail</th>
                <th>Score</th>
                <th>Last Update</th>
            </tr>
        </thead>
        <tbody>
            @forelse($participants as $participant)
                <tr class="">
                    <td>
                        <a href="{{route('participant.view', $participant)}}">
                            {{str_limit($participant->id, 30)}}
                        </a>
                    </td>
                    <td>{{$participant->firstname}}</td>
                    <td>{{$participant->lastname}}</td>
                    <td>{{$participant->email}}</td>
                    <td>{{$participant->xp}}</td>
                    <td>{{$participant->updated_at}}</td>
                </tr>
            @empty
                <tr>
                    <td class="uk-text-center" colspan="4">
                        <img class="uk-svg" width="50" height="50" src="/imgs/funnel.svg">
                        <p>No Users Found.</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
@stop

@section('main-panel-footer')
    <a class="uk-button uk-button-primary uk-button-small" href="{{route('participant.create')}}">Nuevo participante</a>
@stop