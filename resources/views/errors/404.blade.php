<!DOCTYPE html>
<html>
<head>
    <!-- Standard Meta -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <!-- Site Properties -->
    <title>Página no encontrada | Laravel Chat</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('semantic/dist/semantic.min.css') }}">

    <style type="text/css">
    body {
      background-color: #DADADA;
    }
    </style>

    </script>
</head>

<body>


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
                          <a class="header">Stormtrooper</a>
                          <div class="meta">
                            <span class="date">Registrado ayer</span>
                          </div>
                        </div>
                        <div class="extra content">
                            <a>
                                <i class="user circle icon"></i>
                                StormTrooper
                            </a>
                        </div>
                      </div>
                    </div>
                </div>
                <div class="twelve wide column">
                    <div class="ui segment" style="padding: 1.5em 1.5em;">
                        <h2 class="ui dividing header">
                            La página que estas buscando no existe.
                        </h2>
                        <img class="ui medium rounded image" src="{{asset('img/darth-vader-face-palm.jpg')}}">
                        <br>
                        <a href="{{route('inicio')}}" class="ui teal button">Ir al Inicio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
</body>
</html>
