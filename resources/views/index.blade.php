@extends('layouts.site')

@section('content')
<div class="col-lg-8 col-md-8">

             <!-- POST -->
             @foreach ($topics as $topic)
        <div class="post">
                <div class="wrap-ut pull-left">
                    <div class="userinfo pull-left">
                        <div class="avatar">
                            <img src="{{ asset('/images/avatar.jpg')}}" alt="">
                            <div class="status green">&nbsp;</div>
                        </div>

                        
                    </div>
                    <div class="posttext pull-left">
                    
                    <h2><a href="{{route('topics.show', ['topic'=>$topic->id])}}">{{$topic->titre}}</a></h2>
                        <p>{{$topic->message}}</p>
                    </div>
                    <div class="clearfix">
                            <form action="{{route('topics.edit', ['topic'=>$topic->id])}}" method="GET" class="form">
                            @csrf
                            <div class="pull-right"><button class="btn btn-default" type="submit">Modifier</button></div>

                            </form>

                            <form action="#" method="#" class="form">
                                    
                                    <div class="pull-right"><button class="btn btn-default" type="submit">Supprimer</button></div>
        
                                    </form>


                    </div>
                </div>
                <div class="postinfo pull-left">
                    <div class="comments">
                        <div class="commentbg">
                            560
                            <div class="mark"></div>
                        </div>
                        
                    </div>
                    
                </div>
                <div class="clearfix"></div>
            </div><!-- POST -->
            @endforeach
       
       

    </div>


@endsection