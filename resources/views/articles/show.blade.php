@extends('layouts.app')

@section('title', $article->name)

@section('content')
    <div class="col s12 ">
        <div class="row">
            <img src="{{ $article->img }}" alt="{{ $article->name }}">
            <h2 >{{ $article->name or '' }}</h2>
            <div class="flow-text min-height-300"> {!! html_entity_decode($article->content) !!}</div>
        </div>
    </div>
    <div class="col s12 comments">
        @foreach( $comments as $comment)
            <div class="col s12 m5 ">
                <div class="row card-panel">
                    @if (Auth::user()->isAdmin())
                        <div class="right">
                            <a href="#" class="editComment green-color" id="{{ $comment->id }}">Edit</a>
                            <a href="#" class="deleteComment red-color" id="{{ $comment->id }}">Delete</a>
                        </div>
                    @endif
                    <h5>{{ $comment->user->name }}</h5>

                    <p class="commentContent">{{ $comment->content }}</p>
                </div>
            </div>
        @endforeach
        <div class="divider margin-top-20"></div>
        <div class="row margin-top-20">
            <form class="col s6" method="POST">
                {{ csrf_field() }}
                <h5>Leave a comment</h5>
                <div class="row">
                    <div class="input-field col s12">
                        <textarea id="textarea" name="text" class="materialize-textarea {{ $errors->has('text') ? ' invalid' : '' }}" data-length="120">{{ old('text') }}</textarea>
                        <label for="textarea">Text</label>
                        @if ($errors->has('text'))
                            <span class="helper-text">{{ $errors->first('text') }}</span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input type="submit" class="btn" value="Save">
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection