<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Questionnaire;
use App\Question;

class QuestionController extends Controller
{

    // public function __constructor()
    // {
    //     $this->middleware('auth');
    // }
    public function create(Questionnaire $questionnaire)
    {
        return view('question.create', compact('questionnaire'));
    }

    public function store(Questionnaire $questionnaire)
    {
        //TWO ENTERIES FOR DATABASE IN ON METHOD STORE
        // Questionnaire Model to create with realationship created in Model then for Questioners create just valid['questions']
        $storeing = $questionnaire->questions()->create($this->myValidation()['question']);
        // Access Questionnaire Model and createMany valid['answers']
        $storeing->answers()->createMany($this->myValidation()['answers']);

        return redirect('/questionnaires/'.$questionnaire->id);
    }
    public function destroy(Questionnaire $questionnaire, Question $question)
    {
        // dd($question);
        $question->answers()->delete();
        $question->delete();

        return redirect($questionnaire->path());
    }

    public function myValidation()
    {
        return request()->validate([
            'question.question'=> 'required',
            'answers.*.answer'=> 'required',
        ]);
    }
}
