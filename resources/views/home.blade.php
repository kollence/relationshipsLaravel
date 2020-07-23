@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-2">
                <div class="card-header">{{ __('Dashboard') }} <div class="float-right"><small>{{$userinfo[0]}} - {{$userinfo[1]}}</small></div></div>
                    
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="/questionnaires/create" class="btn btn-dark">Create new questionnaires</a>
                </div>
                
            </div>
            @forelse($questionnaires as $k => $questionnaire)
            
            <div class="card mb-2">
                <div class="card-header">
                
                        <h3 class="card-title">
                           <b>{{$k + 1}}.</b> {{$questionnaire->title}} <div class="float-right text-center"><a href="{{ $questionnaire->path() }}" id="copy-{{$questionnaire->id}}" style="margin: 3px;" class="btn btn-primary btn-sm float-right">Edit</a>
                            <form action="{{ $questionnaire->path() }}" method="post" style="display: inline;" class="p-0 mt-0">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger m-0">Delete</button>
                                </form>
                            </div>
                           
                        </h3>
                        
                    <h6  class="card-subtitle mb-2 text-muted">
                        {{$questionnaire->purpose}}
                    </h6>
                    
                </div>
                <div class="card-body">
                        <small>Start Answering</small>
                        <div>
                            <a href="{{$questionnaire->publicPath()}}">
                            {{$questionnaire->publicPath()}}
                            </a>
                            <button class="btn btn-default float-right" onclick="test({{$questionnaire->id}});" id="copied-{{$questionnaire->id}}">Copy Link</button>
                        </div>
                        
                    </div>
            </div>
            @empty
                <h1>None questionnaires are created</h1>
            @endforelse
        </div>
    </div>
    <script>
        function test(id){
            const href = document.getElementById('copy-'+id).href;
            // console.log(href.select());
            // alert(href)
            // href.createTextRange();
            // href.select();
            
            // href.setSelectionRange(0, 99999)
            document.execCommand("copy", href);
            document.getElementById('copied-'+id).innerHTML = 'Copied'
        }
    </script>
</div>
@endsection
