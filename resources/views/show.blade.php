@extends('layouts.site')

@section('content')
            <div class="col-lg-8 col-md-8">

                <!-- POST -->
                <div class="post beforepagination">
                    <div class="topwrap">
                        <div class="userinfo pull-left">
                            <div class="avatar">
                                <img src="{{asset('/images/avatar.jpg')}}" alt="">
                                <div class="status green">&nbsp;</div>
                            </div>

                            
                        </div>
                        <div class="posttext pull-left">
                        <h2>{{$topic->titre}}</h2>
                           <p>{{$topic->message}}</p> 
                    </div>
                        <div class="clearfix"></div>
                    </div>                              
                    <div class="postinfobot">

                       

                        <div class="clearfix"></div>
                    </div>
                    
                </div><!-- POST -->

                @foreach ($commentaires as $commentaire)
                <div class="post"></div>

                <div class="post">
                        <div class="topwrap">
                            <div class="userinfo pull-left">
                                <div class="avatar">
                                    <img src="{{asset('/images//avatar3.jpg')}}" alt="">
                                    <div class="status red">&nbsp;</div>
                                </div>

                                
                            </div>
                            <div class="posttext pull-left">
                            <p> {{$commentaire->message}}</p>
                                    </div>
                            <div class="clearfix"></div>
                        </div>                              
                        <div class="postinfobot">                  

                            <div class="clearfix"></div>
                        </div>
                </div>


                


             

              
                



           

                @endforeach
                <!-- POST -->
                @auth
                <div class="post">
                <form action="{{route('commentaire')}}" class="form" method="POST">
                @csrf
                        <div class="topwrap">
                            <div class="userinfo pull-left">
                                
                            <input type="hidden" name="id" value="{{$topic->id}}">
                                
                            </div>
                            <div class="posttext pull-left">
                                <div class="textwraper">
                                    <div class="postreply">Post a Reply</div>
                                    <textarea name="message" id="reply" placeholder="Type your message here"></textarea>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>                              
                        <div class="postinfobot">

                          

                          

                            <div class="pull-right postreply">
                                <div class="pull-left"><button type="submit" class="btn btn-primary">Post Reply</button></div>
                                <div class="clearfix"></div>
                            </div>


                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div><!-- POST -->
                @endauth


                
            </div>
               
@endsection