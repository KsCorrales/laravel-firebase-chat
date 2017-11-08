<!DOCTYPE html>
<html>
<head>
    <!-- Standard Meta -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Site Properties -->
    <title>Registro</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('semantic/dist/semantic.min.css') }}">

    <style type="text/css">
        body {
          background-color: #DADADA;
        }
        body > .grid {
          height: 100%;
        }
        .image {
          margin-top: -100px;
        }
        .column {
          max-width: 450px;
        }
    </style>
</head>
<body>

<div id="appRegister" class="ui middle aligned center aligned grid">
  <div class="column">
    <h2 class="ui teal image header">
      <div class="content">
        Registro
      </div>
    </h2>
    <form v-on:submit.prevent="signUpUser" class="ui large form" method="POST" action="{{ route('register') }}">

      {{ csrf_field() }}

      <div class="ui stacked segment">

        <div class="field">
          <div class="ui left icon input">
            <i class="user icon"></i>
            <input type="text" v-model="registerData.name" placeholder="Nombre Completo" value="{{old('name')}}">
          </div>
        </div>

        <div class="field">
          <div class="ui left icon input">
            <i class="envelope icon"></i>
            <input type="text" v-model="registerData.email" placeholder="Correo eletrónico" value="{{old('email')}}">
          </div>
        </div>

        <div class="field">
          <div class="ui left icon input">
            <i class="user circle icon"></i>
            <input type="text" v-model="registerData.username" placeholder="Nombre de Usuario" value="{{old('username')}}">
          </div>
        </div>

        <div class="field">
          <div class="ui left icon input">
            <i class="lock icon"></i>
            <input type="password" v-model="registerData.password" placeholder="Contraseña">
          </div>
        </div>

        <button type="submit" :class="['ui fluid large teal submit button', {'loading': loading}]" :disabled="loading">Entrar</button>

      </div>

        <div v-if="formErrors" class="ui error message" style="display:block;">
            <ul v-for="errors in formErrors">
                <li v-for="error in errors" style="text-align: left;">@{{ error }}</li>
            </ul>
        </div>

        <div v-if="successRegister" class="ui success message" style="display:block;">
                <i class="checkmark icon"></i> @{{ successRegister }}
        </div>

    </form>

    <div class="ui message">
      ¿Ya estás registrado? <a href="{{route('entrar')}}">Iniciar Sesión</a>
    </div>
  </div>
</div>


<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
<script src="{{ asset('semantic/dist/semantic.min.js') }}"></script>
<script src="{{ asset('js/myapp.js') }}"></script>
<script>
    var vm = new Vue({
        el: '#appRegister',
        data: {
            registerData: {},
            formErrors: null,
            successRegister: null,
            loading: false
        },
        methods:{

            signUpUser(){

                this.loading = true;
                this.formErrors = null;
                this.successRegister = null;

                axios.post('register', querystring.stringify(this.registerData),{
                    headers: { 
                        "X-CSRF-TOKEN": document.head.querySelector('meta[name="csrf-token"]').content,
                        "Content-Type": "application/x-www-form-urlencoded"
                    }
                })
                .then((response) => {

                    this.loading = false;
                    this.successRegister = response.data.success;
                    this.registerData = {};
                            
                }).catch(function (error) {

                    this.loading = false;
                    if (error.response.status == 422) {
                        this.formErrors = error.response.data;
                    }else{
                        console.log('Error: ' + error);
                    }
                  
                }.bind(this));
            }
        }
    });
</script>

</body>

</html>
