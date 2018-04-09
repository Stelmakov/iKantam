@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="col s12 m8 ">
        <div class="row">
            @foreach ($articles as $article)
                <div class="col s6  ">
                    <div class=" card-panel grey lighten-5 z-depth-1">
                        <div class="row valign-wrapper">
                            <div class="col s4">
                                <img src="{{ $article->img }}" alt="{{ $article->name }}" class=" responsive-img"> <!-- notice the "circle" class -->
                            </div>
                            <div class="col s8">
                                <div class="col s12">
                                    <h5>{{ $article->name }}</h5>
                                    <span class="black-text center">
                                    {!!  str_limit(html_entity_decode($article->content) , 40 , '...') !!}
                                    </span>
                                </div>
                                <div class="col s12">
                                    <p> {{ Carbon\Carbon::parse($article->created_at)->format('d/m/Y') }} by {{ $article->user->name }}</p>
                                    <a href="/articles/{{ $article->slug }}">Read more...</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="col offset-s3">
        {!! $articles->render() !!}
    </div>

@endsection