@extends('layouts.app')

@section('content')

    <div class="container mt-5 mb-5 col-md-6 justify-content-center">

        <div class="w-4/5 m-auto text-left">
            <div class="py-15">
                <h1>
                    Edit Post
                </h1>
            </div>
        </div>

        <div class="form-body">
            <p>Fill in the data below.</p>
            <form action="/post/{{ $data['post']->id }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="col-md-12">
                    <input class="form-control" type="text" name="title" placeholder="Title"
                        value="{{ $data['post']->title }}" required>
                </div>
                <!-- Error -->
                @if ($errors->has('title'))
                    <div class="error">
                        <p class="text-danger">{{ $errors->first('title') }}</p>
                    </div>
                @endif

                <div class="col-md-12">
                    <select class="form-select mt-3" required name="post_type_id">
                        <option selected disabled value="">Type</option>
                        <option value="1" {{ $data['post']->post_type_id == 1 ? 'selected' : '' }}>Feature Request
                        </option>
                        <option value="2" {{ $data['post']->post_type_id == 2 ? 'selected' : '' }}>Bug</option>
                        <option value="3" {{ $data['post']->post_type_id == 3 ? 'selected' : '' }}>Inquiry</option>

                    </select>
                </div>
                <!-- Error -->
                @if ($errors->has('post_type_id'))
                    <div class="error">
                        <p class="text-danger">{{ $errors->first('post_type_id') }}</p>
                    </div>
                @endif

                <div class="col-md-12 mt-3">
                    <label>Body</label>
                    <textarea name="body" class="form-control" rows="3" required
                        style="resize:none;min-height: 200px;">{{ $data['post']->body }}</textarea>
                </div>
                <!-- Error -->
                @if ($errors->has('body'))
                    <div>
                        <p class="text-danger">{{ $errors->first('body') }}</p>
                    </div>
                @endif

                <div class="form-button mt-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>


@endsection
