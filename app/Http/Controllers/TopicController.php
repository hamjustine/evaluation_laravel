<?php

namespace App\Http\Controllers;

use App\Topic;
use App\Commentaire;
use Illuminate\Http\Request;
use Validator;

class TopicController extends Controller
{
    public function __construct(){
         $this->middleware('auth')->except('index','show','search');
        }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = Topic::orderBy('created_at','desc')->get();
        return view('index', [
            'topics' => $topics,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'titre' => 'required|max:75',
            'message' => 'required',
        ]);
        $post = new Topic;
        $post->titre = $request->input('titre');
        $post->message = $request->input('message');
        $post->user_id=auth()->id();
        $post->save();
        return redirect()->route('home')->with(["status" =>"topic enregistré"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show(Topic $topic)
    {

        $commentaires = $topic->commentaires; 
        
        return view('show', ['topic'=>$topic, 'commentaires'=>$commentaires]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic)
    {
        return view('edit',['topic' => $topic]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Topic $topic)
    {
        $this->validate($request, [
            'titre' => 'required|max:75',
            'message' => 'required',
        ]);
        $topic->titre = $request->input('titre');
        $topic->message = $request->input('message');
        $topic->save();
        return redirect()->route('home')->with(["status" =>"topic modifié"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic)
    {
        $topic->delete();
        return redirect()->route('home')->with(["status" =>"topic supprimé"]);;
    }

    public function comment(Request $request)
    {
        $post = new Commentaire;
        $post->message = $request->message;
        $post->topic_id = $request->id;
        $post->save();
        return redirect()->route('home')->with(["status" =>"commentaire posté"]);
    }

    public function search(Request $request)
    {
        $param = $request->input('search');
        $result = Topic::where('titre','LIKE','%'.$param.'%')->get();
        return view('index', ['topics'=>$result,]);
    }
}
