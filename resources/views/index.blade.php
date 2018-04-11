@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="col s12">
        <div class="row">
            @foreach ($articles as $article)
                <div class="col s12 m6 l6 ">
                    <div class="card">

                        @if (!Auth::guest() && ($article->user->id == Auth::user()->id || Auth::user()->isAdmin()))
                            <div class="adminButtons">
                                <a href="/edit-article/{{ $article->slug }}" class="green-color" >Edit</a>
                                <a href="#" class="deleteArticle red-color" id="{{ $article->id }}">Delete</a>
                            </div>
                        @endif
                        <div class="card-image">
                            <img src="{{ $article->img }}" alt="{{ $article->name }}">

                        </div>
                        <div class="card-content">
                            <h4 class="card-title">{{ $article->name }}</h4>
                            <p> {!!  str_limit(html_entity_decode($article->content) , 60 , '...') !!}</p>
                            <p> {{ Carbon\Carbon::parse($article->created_at)->format('d/m/Y') }} by {{ $article->user->name }}</p>
                        </div>
                        <div class="card-action">
                            <a href="/articles/{{ $article->slug }}">Read more...</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="row">
    <div class="col offset-s5 ">
        <div class="nav-wrapper">
                 {!! $articles->render() !!}
        </div>
    </div>
    </div>

@endsection