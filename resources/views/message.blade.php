<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>Document</title>
</head>

<body>

    @include('template.template')
    @auth
    <div class="wrapper">
        <div class="containers">
            <div class="left">
                <div class="top mb-3">
                    <div class="row ml-2">
                        <img src="https://www.flaticon.com/svg/static/icons/svg/3135/3135715.svg" style="height: 50px"
                            alt="">
                        <h5 class="font-weight-bold ml-2 mt-3">{{Auth::user()->name}}</h5>
                    </div>
                </div>
                <ul class="people">
                    <form action="/contact/{{Auth::user()->id}}" method="post">
                        @csrf
                        <h6>Ceux qui peuvent t'aider :</h6>

                        @foreach ($user as $item)

                        @if (Auth::user()->Html_css=="non" && $item->Html_css=="oui" || Auth::user()->Javascript=="non"
                        && $item->Javascript=="oui" || Auth::user()->React_JS=="non" && $item->React_JS=="oui" ||
                        Auth::user()->Laravel=="non" && $item->Laravel=="oui")

                        <li class="person" style="list-style-type: none; width: 85%;">
                            <button type="submit" name="contact" class="bg-transparent"
                                style="border: none; outline:none;" value="{{$item->id}}"> {{$item->name}}
                            </button>
                        </li>
                        @endif


                        @endforeach
                        <h6 class="mt-5">Les personnes qui t'ont contacter :</h6>

                        @foreach ($msg->unique('user_id') as $item)

                                @if (Auth::user()->id==$item->send_id)

                                    <li class="person" style="list-style-type: none; width: 85%;">
                                        <button type="submit" name="contact" class="bg-transparent text-bold"
                                            style="border: none; outline:none;" value="{{$item->user_id}}"> {{$item->user->name}}
                                        </button>
                                    </li>

                                @endif

                           
                        @endforeach

                    </form>

                </ul>
            </div>
            <div class="right">
                @foreach ($user as $item)
                @if (Auth::user()->contact==$item->id)
                <div class="top"><span>To : <span class="name">{{$item->name}}</span></span></div>
                @endif
                @endforeach

                <div class="chat" style="overflow: auto; height: 75%; padding: 0px 20px 20px;">
                    @foreach ($msg as $item)
                    <div class="row">
                        @if ( Auth::user()->id==$item->user_id && Auth::user()->contact==$item->send_id ||
                        Auth::user()->id==$item->send_id && Auth::user()->contact==$item->user_id)
                        <div class="col-6">
                            @if (Auth::user()->id==$item->send_id)
                                <h4 class="bubble you mt-3 text-dark">{{$item->message}}</h4>
                            @endif
                        </div>
                        <div class="col-6">
                            @if (Auth::user()->id==$item->user_id)
                                <h4 class="bubble me mt-3">
                                    {{$item->message}}
                                </h4>
                            @endif
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>

                <div class="write">
                    <form action="/message1" enctype="multipart/form-data" method="post">
                        @csrf

                        <input type="text" name="message">
                        <select name="send_id" class="d-none">
                            <option value="{{Auth::user()->contact}}">Karis</option>
                        </select>
                        <button type="submit" class="btn "
                            style="margin-top: 2px; margin-left: 5px;background-color: #DEB5AE;">Envoyer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endauth

</body>

</html>