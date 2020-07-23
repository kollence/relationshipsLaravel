@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-1">
                <div class="card-header">{{ $questionnaire->title}}</div>

                <div class="card-body">
                    {{$questionnaire->purpose}}
                
                </div>
                <div class="card-body">
                    <a href="/questionnaires/{{$questionnaire->id}}/questions/create" class="btn btn-primary">Create Question</a>
                    <a href="/surveys/{{$questionnaire->id}}-{{Str::slug($questionnaire->title)}}" class="btn btn-primary">Survey</a>
                </div>
            </div>
            @forelse($questionnaire->questions as $question)
            <div class="card mb-1">
                <div class="card-header">{{ $question->question}}
                <div class="float-right">
                <form action="/questionnaires/{{$questionnaire->id}}/questions/{{$question->id}}" method="post">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                    
                    </form>
                </div>
                
                </div>

                <div class="card-body">
                <ul class="list-group">
                <div>
                    <div class="float-right"><small>users picked</small></div>
                </div>
                @forelse($question->answers as $answer)
                <li class="list-group-item">
                    <span>{{$answer->answer}}</span>
                    <span class="float-right"> 
                    {{ ($question->responses->count() != 0) ? floor(($answer->responses->count() * 100) / $question->responses->count()) : ''}} %
                    </span>
                </li>
                @empty
                <h1>None answers created</h1>
                @endforelse
                
                </ul>
                
                </div>
                <div class="card-footer">
                    
                </div>
                
            </div>
            @empty
            <h1>Nothing Created Yet</h1>
            @endforelse
        </div>
    </div>
</div>
@endsection
