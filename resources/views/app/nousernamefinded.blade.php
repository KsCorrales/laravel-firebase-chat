@extends('app.layout')

@section('title', 'Usuario No encontrado | Laravel Chat')

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
                            Usuario "{{ $userName }}" no encontrado.
                        </h2>
                        <img class="ui medium rounded image" src="{{asset('img/darth-vader-face-palm.jpg')}}">
                        <br>
                        <a href="{{route('inicio')}}" class="ui teal button">Ir al Inicio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection