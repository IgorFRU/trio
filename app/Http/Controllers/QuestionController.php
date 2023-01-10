<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array (
            'questionsNew' => Question::new()->orderBy('id', 'DESC')->get(),
            'questionsOld' => Question::old()->get(),
        );

        return view('admin.questions.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
    }

    public function ajaxGet(Request $request) {
        return Question::where('id', $request->id)->firstOrFail();
    }

    public function ajaxUpdate(Request $request) {
        $question = Question::where('id', $request->id)->firstOrFail();

        $question->update([
            'name' => $request->name,
            'question' => $request->question,
        ]);

        return $request->question;
    }

    public function ajaxAnswer(Request $request) {
        $question = Question::where('id', $request->id)->firstOrFail();
        
        $question->update([
            'answer' => $request->answer,
            'published' => $request->published,
        ]);

        return 'success';
    }
}
