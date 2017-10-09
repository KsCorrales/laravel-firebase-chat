@extends('app.layout')

@section('title', 'Inicio | Laravel Chat')

@section('content')
    <div class="ui main container" style="margin-top:65px;">
        <div class="ui grid">
            <div class="row">
                <div class="four wide column">
                    <div class="ui cards">
                      <div class="card">
                        <div class="image">
                          <img src="{{asset('img/avatar/default.jpg')}}">
                        </div>
                        <div class="content">
                          <a class="header">{{ Auth::user()->name }}</a>
                          <div class="meta">
                            <span class="date">Registrado {{Auth::user()->created_at->diffForHumans()}}</span>
                          </div>
                        </div>
                        <div class="extra content">
                            <a>
                                <i class="user circle icon"></i>
                                {{ Auth::user()->username }}
                            </a>
                        </div>
                      </div>
                    </div>
                </div>
                <div class="twelve wide column">
                    <div class="ui segment" style="padding: 1.5em 1.5em;">
                        <h2 class="ui dividing header">
                            Usuarios: 
                        </h2>
                        <div class="ui two columns grid cards ">
                            @foreach($users as $user)
                                <div class="card">
                                    <div class="content">

                                        @if($user->isNew())
                                            <div class="ui yellow right ribbon label">
                                                <i class="star icon"></i> New User
                                            </div>
                                        @else
                                            <div class="ui teal right ribbon label">
                                                <i class="user circle icon"></i> User
                                            </div>
                                        @endif
                                        
                                        <div class="header">
                                          <img class="left floated mini ui image" src="{{asset('img/avatar/default.jpg')}}">
                                          {{$user->name}}
                                        </div>
                                        <div class="meta">
                                          Registrado {{$user->created_at->diffForHumans()}}
                                        </div>
                                        <div class="description">
                                          
                                        </div>
                                    </div>
                                    <div class="extra content">
                                        <div class="ui">
                                            <a href="{{route('chat',[$user->username])}}" class="ui fluid basic teal button"><i class="talk outline icon"></i> Chatear</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{$users->links()}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection