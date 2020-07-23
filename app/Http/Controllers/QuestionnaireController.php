<?php

namespace App\Http\Controllers;

use App\Questionnaire;
use Illuminate\Http\Request;
use App\Question;

class QuestionnaireController extends Controller
{

    public function __constructor()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('questionnaire.create');
    }

    public function show(Questionnaire $questionnaire)
    {   //LOAD method for lasy load two tables (question and answers) at same time to questionares

        
        $questionnaire->load('questions.answers.responses');
        // dd($questionnaire);
        return view('questionnaire.show', compact('questionnaire'));
    }

    public function store()
    {   
        $arr = $this->validationRules();
        // $arr['user_id'] = auth()->user()->id;
        // $data = Questionnaire::create($arr);
        //CALL REALATIONSHIP WITH USER THAT CAN CREATE MANY QUESTIONNAIRES // and be authenticated
        $data = auth()->user()->questionnaires()->create($arr);
        return redirect('/questionnaires/'.$data->id);
        
    }
    public function destroy(Questionnaire $questionnaire, Question $question)
    {   
        $questionnaire->delete();
        $question->answers()->delete();
        $question->delete();

        return redirect()->back();
    }

    public function validationRules()
    {
        return request()->validate([
            'title'=> 'required|max:50',
            'purpose'=> 'required|max:100'
        ]);
    }
}
