@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('PostShow') }}</div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>
                            <div class="col-md-6" id="title">
                                <div class="form-control">{{$post->title}}</div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Content') }}</label>
                            <div class="col-md-6" id="content">
                                <div class="form-control">{{$post->content}}</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="category"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>
                            <div class="col-md-6" id="category">
                                <div class="form-control">{{$post->category}}</div>
                            </div>
                        </div>
                        @can('own', $post)
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a class="btn btn-primary" href="{{route('post.edit', $post->id)}}"
                                   role="button">edit</a>
                            </div>
                        </div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
