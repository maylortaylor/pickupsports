@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <h1>Submit a team</h1>
            <form action="/submitTeam" method="post" enctype="multipart/form-data">
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        Please fix the following errors
                    </div>
                @endif

                {!! csrf_field() !!}
                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{ old('title') }}">
                    @if($errors->has('title'))
                        <span class="help-block">{{ $errors->first('title') }}</span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" placeholder="description">{{ old('description') }}</textarea>
                    @if($errors->has('description'))
                        <span class="help-block">{{ $errors->first('description') }}</span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" id="image" name="image" placeholder="Image" value="{{ old('image') }}">
                    @if($errors->has('image'))
                        <span class="help-block">{{ $errors->first('image') }}</span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('zipcode') ? ' has-error' : '' }}">
                    <label for="zipcode">Zipcode</label>
                    <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="Zipcode" value="{{ old('zipcode') }}">
                    @if($errors->has('zipcode'))
                        <span class="help-block">{{ $errors->first('zipcode') }}</span>
                    @endif
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
    </div>
@endsection