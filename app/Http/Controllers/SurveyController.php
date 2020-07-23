<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Questionnaire;
class SurveyController extends Controller
{
    public function show(Questionnaire $questionnaire, $slug)
    {
        $questionnaire->load('questions.answers');
        return view('surveys.show', compact('questionnaire'));
    }

    public function store(Questionnaire $questionnaire)
    {
        // dd(request()->all());
        // QUESTIONNAIRE hasMany survey create
        $survey = $questionnaire->surveys()->create($this->myValidation()['survey']);
        // SURVEY Model istance true method survey are called method responses and createMany with hasMany responses
        $survey->responses()->createMany($this->myValidation()['responses']);

        return 'thanks';
    }





    public function myValidation()
    {
        return request()->validate([
            'responses.*.answer_id'=> 'required',
            'responses.*.question_id' => 'required',
            'survey.name' => 'required',
            'survey.email' => 'email|required',
        ]);
    }
}
