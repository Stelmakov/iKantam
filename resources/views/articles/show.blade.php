@extends('layouts.app')

@section('title', $article->name)

@section('content')
    <div class="col s12 ">
        <div class="row">
            <img src="{{ $article->img }}"  class="responsive-img" alt="{{ $article->name }}">
            <h2 >{{ $article->name or '' }}</h2>
            <div class="flow-text min-height-300"> {!! html_entity_decode($article->content) !!}</div>
            <div class="right">
                <p> {{ Carbon\Carbon::parse($article->created_at)->format('d/m/Y') }} by {{ $article->user->name }}</p>
            </div>
        </div>
    </div>

    <div class="col s12 comments margin-bottom-40">
        @if (!Auth::guest())
            <div class="row margin-top-20 margin-bottom-40">
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
                            <input name="_check" type="hidden" value="{{ time() }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="submit" class="btn" value="Save">
                        </div>
                    </div>
                </form>
            </div>
        @endif
        @foreach( $comments as $comment)
            <div class="col s12 m5 ">
                <div class="row card-panel">
                    @if (!Auth::guest() && Auth::user()->isAdmin())
                        <div class="right">
                            <a href="#" class="editComment green-color" id="{{ $comment->id }}">Edit</a>
                            <a href="#" class="deleteComment red-color" id="{{ $comment->id }}">Delete</a>
                        </div>
                    @endif
                    <div class="right"> {{ Carbon\Carbon::parse($comment->created_at)->format('d/m/Y') }}</div>
                    <h5>{{ $comment->user->name }}</h5>

                    <p class="commentContent">{{ $comment->content }}</p>
                </div>
            </div>
        @endforeach
    </div>

@endsection