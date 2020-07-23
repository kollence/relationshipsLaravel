@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>{{$questionnaire->title}}</h1>
            
            <form action="/surveys/{{$questionnaire->id}}-{{Str::slug($questionnaire->title)}}" method="post" onsubmit="(event) => {event.preventDefault()})">
                @csrf
                @foreach($questionnaire->questions as $key => $question)
                    <div class="card mb-1">
                        <div class="card-header"><b>{{$key + 1}}.</b>  {{ $question->question}}</div>

                        <div class="card-body">
                            
                            @error('responses.'.$key.'.answer_id')
                             <small class="text-danger"> {{$message}} </small>
                            @enderror
                            
                            <ul class="list-group">
                                @foreach($question->answers as $answer)
                                    
                                    <li class="list-group-item">
                                        <label for="answer{{$answer->id}}">
                                            <input  type="radio" name="responses[{{$key}}][answer_id]" id="answer{{$answer->id}}" class="mr-2" value="{{$answer->id}}"
                                            
                                            {{ (old('responses.'.$key.'.answer_id') == $answer->id) ? 'checked=&quot;checked&quot;' : '' }}
                                            >
                                            {{$answer->answer}}
                                            <input type="hidden" name="responses[{{$key}}][question_id]" value="{{$question->id}}" />
                                        </label>    
                                    </li>
                                    
                                @endforeach
                            </ul>
                        </div>
                        
                    </div>
                    
                @endforeach
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">Your Information</div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="survey[name]"  class="form-control" id="name" placeholder="enter name">
                            <small id="nameHelp" class="form-text text-muted">Your name.</small>
                            @error('name')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="survey[email]" class="form-control" id="email" placeholder="enter email">
                            <small id="emailHelp" class="form-text text-muted">Your email</small>
                            @error('email')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                   <button type="submit" class="btn btn-primary">Submit</button> 
                </div>
                
            </form>
            
            
            <!-- <div class="card">
                <div class="card-header">Create new questionnaire</div>

                <div class="card-body">
                    <form action="/questionnaires" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title"  class="form-control" id="title" placeholder="Title">
                        <small id="titleHelp" class="form-text text-muted">Give your questionnaire a title that attracts attention.</small>
                        @error('title')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="purpose">Purpose</label>
                        <input type="text" name="purpose" class="form-control" id="purpose" placeholder="Purpose">
                        <small id="purposeHelp" class="form-text text-muted">Giving a purpose will attract response</small>
                        @error('purpose')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Create Questionnaire</button>
                    </form>
                </div>
            </div> -->
        </div>
    </div>
</div>
@endsection

