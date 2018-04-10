@extends('layouts.app')

@section('title', 'Add article')

@section('content')

    <div class="row">
        <form class="col s6 offset-s3" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="input-field col s12">
                    <input id="name" name="name" type="text" value="{{ old('name') }}" class="validate {{ $errors->has('name') ? ' invalid' : '' }}">
                    <label for="name">Article name</label>
                    @if ($errors->has('name'))
                        <span class="helper-text">{{ $errors->first('name') }}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <textarea id="content" name="text" class="materialize-textarea validate {{ $errors->has('content') ? ' invalid' : '' }}" >{{ old('text') }}</textarea>
                    <label for="Content">Content</label>
                    @if ($errors->has('text'))
                        <span class="helper-text">{{ $errors->first('text') }}</span>
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
                        <input class="file-path validate  {{ $errors->has('img') ? ' invalid' : '' }}" name="file_path" type="text">
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