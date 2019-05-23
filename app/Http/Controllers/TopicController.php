<?php

namespace App\Http\Controllers;

use App\Topic;
use Illuminate\Http\Request;
use Validator;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = Topic::limit(6)->get();
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
        $validator = Validator::make($request->all(),[
            'titre' => 'required|max:75',
            'message' => 'required'
        ])->validate();
        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        $post = new Topic;
        $post->titre = $request->input('titre');
        $post->message = $request->input('message');
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
        $validator = Validator::make($request->all(),[
            'titre' => 'required|max:75',
            'message' => 'required'
        ]);
        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
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
        return redirect()->route('index');
    }

    public function comment(Request $request, $id)
    {
        $post = new Commentaire;
        $post->titre = $request->input('message');
        $post->topic_id = $id;
        $post->save();
        return view('index');
    }

    public function search(Request $request)
    {
        $result = Topic::where('titre', '=', " $request->input('search')" )->get();
        return view('index', ['topics'=>$result,]);
    }
}
