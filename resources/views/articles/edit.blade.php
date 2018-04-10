@extends('layouts.app')

@section('title', 'Edit article')

@section('content')
    <div class="row">
        <form class="col s6 offset-s3" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="input-field col s12">
                    <input id="name" name="name" type="text" value="{{ $article->name or '' }}" class="validate {{ $errors->has('name') ? ' invalid' : '' }}">
                    <label for="name">Article name</label>
                    @if ($errors->has('name'))
                        <span class="helper-text">{{ $errors->first('name') }}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <textarea id="content" name="text" type="text" class="materialize-textarea validate {{ $errors->has('text') ? ' invalid' : '' }}" >{!!   $article->content or '' !!}</textarea>
                    <label for="content">Content</label>
                    @if ($errors->has('text'))
                        <span class="helper-text">{{ $errors->first('text') }}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="slug" name="slug" type="text" value="{{  $article->slug or '' }}" class=" validate {{ $errors->has('slug') ? ' invalid' : '' }}" >
                    <label for="slug">Slug</label>
                    @if ($errors->has('slug'))
                        <span class="helper-text">{{ $errors->first('slug') }}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class=" col s12 file-field input-field">
                    <div class="btn">
                        <span>Image</span>
                        <input name="img" type="file" accept="image/*" >

                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate  {{ $errors->has('img') ? ' invalid' : '' }}" name="file_path" value="{{  $article->img or '' }}" type="text">
                        @if ($errors->has('name'))
                            <span class="helper-text">{{ $errors->first('img') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input type="submit" class="btn" value="Save">
                </div>
            </div>
        </form>
    </div>

@endsection