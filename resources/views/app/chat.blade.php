@extends('app.layout')

@section('title', 'Chat | Laravel Chat')

@section('content')
    <div id="app" class="ui main container" style="margin-top:65px;">
        <div class="ui grid">
            <div class="row">
                <div class="three wide column">
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
                                {{Auth::user()->username}}
                            </a>
                        </div>
                      </div>
                    </div>
                </div>

                <div class="ten wide column">
                    <div class="ui segment" style="padding: 1.5em 1.5em;">
                        <div class="ui comments">
                            <h3 class="ui dividing header"><i class="talk outline icon"></i> Mensajes</h3>
                            <div id="comments-container" style="max-height: 55vh;overflow-y: scroll;padding-right:10px;padding-bottom: 40px;">
                                <div v-if="historyMessages.length > 0" v-for="message in historyMessages" v-cloak>

                                <div v-if="!isMe(message.userId)" class="sixteen wide column">
                                    <div class="comment">
                                        <a class="avatar">
                                          <img src="{{asset('img/avatar/default.jpg')}}">
                                        </a>
                                        <div class="content">
                                          <a class="author">@{{ getUserName(message.userId) }}</a>
                                          <div class="metadata">
                                            <span class="date">@{{ humanize(message.date)  }}</span>
                                          </div>
                                          <div class="text">
                                            <p>@{{ message.text }}</p>
                                          </div>
                                        </div>
                                    </div>
                                </div>

                                <div v-else class="sixteen wide column">
                                    <div  class="comment" style="text-align: right;">
                                        <a class="avatar" style="float:right;">
                                          <img src="{{asset('img/avatar/default.jpg')}}">
                                        </a>
                                        <div class="content" style="margin-left:0;margin-right: 3.5em;">
                                          <div class="metadata">
                                            <span class="date">@{{ humanize(message.date) }}</span>
                                          </div>
                                          <a class="author">Tú</a>
                                          
                                          <div class="text">
                                            <p>@{{ message.text }}</p>
                                          </div>
                                        </div>
                                      </div>
                                </div>
                            </div>
                        </div>

                          <div v-show="historyMessages.length < 1">
                              <p><small>No Hay Mensajes, envía el primero para iniciar la conversación.</small></p>
                          </div>
                          

                          <form @submit.prevent="sendMessage()" class="ui reply form">
                            <div class="field">
                                <input v-model="message.text" placeholder="Escribe tu mensaje" type="text">
                            </div>
                            <button type="submit" class="ui blue labeled submit icon button">
                              <i class="send outline icon"></i> Enviar
                            </button>
                          </form>
                        </div>
                    </div>
                </div>

                <div class="three wide column">
                    <div class="ui cards">
                      <div class="card">
                        <div class="image">
                            <img src="{{asset('img/avatar/default.jpg')}}">
                        </div>
                        <div class="content">
                            <a class="header">{{ $receptorUser->name }}</a>
                            <div class="meta">
                                <span class="date">Registrado {{$receptorUser->created_at->diffForHumans()}}</span>
                            </div>
                        </div>
                        <div class="extra content">
                            <a>
                                <i class="user circle icon"></i>
                                {{$receptorUser->username}}
                            </a>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/myapp.js') }}"></script>
    <script src="https://www.gstatic.com/firebasejs/4.5.0/firebase.js"></script>
    <script>

    // Detectar si el usuario esta en la pestaña
    var windowFocus=true;

    function onBlur() {
        windowFocus=false;
    };
    function onFocus(){
        windowFocus=true;
    };
     
    if (/*@cc_on!@*/false) { // check for Internet Explorer
        document.onfocusin = onFocus;
        document.onfocusout = onBlur;
    } else {
        window.onfocus = onFocus;
        window.onblur = onBlur;
    }
    //////

    // FIREBASE CONFIGURATION
    var config = {
      apiKey: "***",
      authDomain: "***",
      databaseURL: "***",
      projectId: "***",
      storageBucket: "",
      messagingSenderId: "***"
    };
    firebase.initializeApp(config);

    const database = firebase.database();

    var vm = new Vue({
        el: '#app',
        data: {
            message: {
                userId: '{{Auth::user()->id}}',
                text: '',
                date: null
            },
            historyMessages: [],
            firstLoad: false
        },
        computed: {
            
        },
        mounted(){
            database.ref('/chats/{{$chat->id}}')
                .on('value', snapshot => this.loadMessages(snapshot.val()))
        },
        methods:{

            loadMessages(messages){
                this.historyMessages = [];
                for(let key in messages) {
                    this.historyMessages.push({
                        userId: messages[key].userId,
                        text: messages[key].text,
                        date: messages[key].date
                    });
                }
                this.showNotification(this.historyMessages.slice(-1).pop());
                this.firstLoad = true;
                document.querySelector('#comments-container').scrollTop =  document.querySelector('#comments-container').scrollHeight - document.querySelector('#comments-container').clientHeight;
            },

            sendMessage(){
                if(this.message.text.length > 0){
                    database.ref('/chats/{{$chat->id}}').push({
                        userId: this.message.userId,
                        text: this.message.text,
                        date: moment().format()
                    })
                    .then(() => {
                        this.message.text = '';
                    });
                }else {
                    alert('Primero debes escribir algo antes de enviar');
                }
            },

            getUserName(id){
                if(id == this.message.userId) {
                    return "Tú";
                }else {
                    return "{{ $receptorUser->name }}";
                }
            },

            isMe(id) {
                if(id == this.message.userId) {
                    return true;
                }else {
                    return false;
                }
            },

            humanize(date) {
                return moment(date).format('DD-MM-YY h:mma');
            },

            showNotification(message){
                if(this.firstLoad && message.userId != this.message.userId && !windowFocus) {
                    pushjs.create(this.getUserName(message.userId), {
                        body: message.text,
                        timeout: 4000,
                        onClick: function () {
                            window.focus();
                            this.close();
                        }
                    });
                }
                
            }
        }
    });
</script>
@endsection