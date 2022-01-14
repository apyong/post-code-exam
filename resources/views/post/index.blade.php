@extends('layouts.app')

@section('content')

    <div class="px-4 py-2 text-center">
        <h1 class="display-5 fw-bold"> Posts</h1>
    </div>



    <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
        <a href="/post/create" class="btn btn-success btn-sm active" role="button" aria-pressed="true">Create Posts</a>
    </div>

    <div class="container mt-5 mb-5">
        @if (session()->has('message'))
            <div class="alert alert-primary" role="alert">
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="row g-2">
            @foreach ($posts as $post)
                <div class="col-md-6 justify-content-center">
                    <div class="card bg-white p-3 px-4 d-flex justify-content-center">
                        <h4 class="mb-0">{{ $post->title }}</h4><span
                            class="price">{{ $post->post_type }}</span>
                        <div class="mt-4">
                            <div class="d-flex align-items-center" style="min-height: 100px;">
                                <span>{{ $post->body }}</span>
                            </div>
                        </div>

                        <!-- posts action buttons -->
                        <div class="row mt-4">
                            <div class="col-md-12 d-flex justify-content-start">
                                <span>
                                    <a class="btn btn-success" href="/post/{{ $post->id }}/edit" role="button">Edit</a>
                                </span>
                                <span class="px-1">
                                    <form action="/post/{{ $post->id }}" method="POST">
                                        @csrf
                                        @method('delete')

                                        <button class="btn btn-danger" type="submit">
                                            Delete
                                        </button>
                                    </form>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row g-2 mt-4">
            {{ $posts->links() }}
        </div>
    </div>

@endsection
