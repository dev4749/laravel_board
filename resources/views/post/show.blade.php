@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary">{{ __('PostShow') }}</div>
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
                                    <a class="btn btn-danger" href="{{route('post.destroy', $post->id)}}"
                                       role="button"
                                       onclick="event.preventDefault();document.getElementById('delete-form').submit();">destroy</a>
                                    <form id="delete-form" method="post" action="{{route('post.destroy', $post->id)}}"
                                          style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </div>
                        @endcan
                    </div>
                </div>

                <br/>
                <div class="card">
                    <div class="card-header">{{ __('CommentCreate') }}</div>
                    <div class="card-body">
                        <div class="comment-wrapper">
                            <div class="text-center">
                                <textarea class="form-control" placeholder="write a comment..." rows="3"
                                          name="content"></textarea>
                                <br>
                                <button id="create_button" type="button" class="btn btn-primary">Comment</button>
                                <div class="clearfix"></div>
                                <hr>
                            </div>

                            <ul id="comment_list">
                                @foreach($commentList as $comment)
                                    <li data-comment-id="{{$comment->id}}">
                                        <strong class="text-success">{{$comment->user->name}}</strong>
                                        <span class="text-muted pull-right">
                                            <small class="text-muted">({{$comment->created_at}})</small>
                                        </span>
                                        @can('own', $comment)
                                            <strong><a class="text-danger" href="#">@delete</a></strong>
                                        @endcan
                                        <p>{{$comment->content}}</p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            method: "POST",
        });

        $("#create_button").on("click", function () {
            $.ajax({
                url: "{{$post->id}}/comment",
                data: {content: $("[name=content]").val()}
            }).then((data, textStatus, jqXHR) => {
                var template = "<li data-comment-id='" + data.id + "'>";
                template += "    <strong class='text-success'>" + data.user_name + "</strong>";
                template += "    <span class='text-muted pull-right'>";
                template += "        <small class='text-muted'>(" + data.created_at + ")</small>";
                template += "    </span>";
                template += "    <strong><a class='text-danger' href='#'>@delete</a></strong>";
                template += "    <p>" + data.content + "</p>";
                template += "</li>";
                $("#comment_list").prepend(template);
            }, (jqXHR, textStatus, errorThrown) => {
                errorResult(jqXHR);
            })
        });

        $("#comment_list").on("click", "li .text-danger", function (e) {
            e.preventDefault();
            var li = $(this).closest('li');
            var comment_id = $(li).data('comment-id');

            $.ajax({
                url: "/post/{{$post->id}}/comment/" + comment_id,
                data: {
                    _method: "DELETE",
                }
            }).then((data, textStatus, jqXHR) => {
                $(li).remove();
            }, (jqXHR, textStatus, errorThrown) => {
                errorResult(jqXHR);
            })
        });

        function errorResult(jqXHR)
        {
            var response = jqXHR.responseJSON;
            var message = response.errors != undefined ? response.errors.content[0] : response.message;
            alert(message);
            if (jqXHR.status == 401) {
                location.href = "{{route('login')}}";
            }
        }
    </script>
@endsection
