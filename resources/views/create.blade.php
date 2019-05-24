@extends('layouts.site')

@section('content')

            <div class="col-lg-8 col-md-8">

                <!-- POST -->
                <div class="post beforepagination">
                                                 
                    <div class="postinfobot">

                       

                        <div class="clearfix"></div>
                    </div>
                </div><!-- POST -->


                <div class="post"></div>


                


             

              
                



           
                @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

                <!-- POST -->
                <div class="post">
                <form action="{{route('topics.store')}}" class="form" method="POST">
                @csrf
                        <div class="topwrap">
                            <div class="userinfo pull-left">
                                

                                
                            </div>
                            <div class="posttext pull-left">
                                    <div class="">
                                            <div class="postreply">Poster un Topic</div>
                                            <input name="titre" id="reply" placeholder="Votre titre"></textarea>
                                    </div>

                                <div class="textwraper">
                                    <div class="postreply">Poster un Topic</div>
                                    <textarea name="message" id="reply" placeholder="Votre message"></textarea>
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


            </div>
               
@endsection