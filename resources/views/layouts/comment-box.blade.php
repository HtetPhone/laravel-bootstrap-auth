@auth
    <div class="comment-box card mb-4">
        <div class="card-body">
            <h6 class="fw-bold mb-3">Comment Here</h6>
            <form method="POST" action="{{ route('comment.store') }}">
                @csrf
                <input type="hidden" name="article_id" value="{{ $article->id }}">
                <textarea name="content" id="" class="form-control mb-3" rows="1" placeholder="Join the discussion.....">
                </textarea>
                <div class="d-flex justify-content-between align-items-center">
                    <p class="text-black-50 mb-0">Comment as {{ Auth()->user()->name }}</p>
                    <button class="btn btn-dark"> <i class="bi bi-send"></i> Comment </button>
                </div>
            </form>
        </div>
    </div>
@endauth

@guest
    <div class="comment-box card mb-4">
        <div class="card-body">
            <h6 class="fw-bold mb-3">Comment Here</h6>
            <form method="POST" action="{{ route('comment.store') }}">
                @csrf
                <input type="hidden" name="article_id" value="{{ $article->id }}">
                <textarea name="content" id="" class="form-control mb-3" rows="1" placeholder="Join the discussion.....">
            </textarea>
                <div class="d-flex justify-content-between align-items-center">
                    <p class="text-black-50 mb-0">Comment on MMS Blog</p>
                    <button class="btn btn-dark"> <i class="bi bi-send"></i> Comment </button>
                </div>
            </form>
        </div>
    </div>
@endguest

{{-- comments  --}}
@forelse ($article->comments()->whereNull('parent_id')->latest()->get() as $comment)
    <div class="comment card mb-4">
        <div class="card-body">
            <div class="d-flex mb-2 align-items-top">
                <img src="{{ asset('img/user.png') }}" style="width: 40px;height: 40px" alt="">
                <div class="ms-2">
                    <p class="fw-bold  mb-0"> {{ $comment->user->name }} </p>
                    <p class="mb-0 fw-lighter" style="font-size: 11px"> {{ $comment->created_at->diffforhumans() }}</p>
                </div>
                <div class="ms-auto">
                    <button class="bg-success border-0 text-white rounded edit-btn" style="width: 30px;height:30px;" id="edit{{$comment->id}}">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                    @can('delete', $comment)
                        <button form="deleteComment{{ $comment->id }}" class="bg-danger border-0 text-white rounded"
                            style="width: 30px;height:30px;"> <i class="bi bi-trash"></i> </button>
                        <form id="deleteComment{{ $comment->id }}" method="POST"
                            action="{{ route('comment.destroy', $comment->id) }}">
                            @csrf
                            @method('DELETE')
                        </form>
                    @endcan
                </div>

            </div>
            <p class="mb-0"> {{ $comment->content }} </p>

            {{-- edit box --}}
            <div class="card edit-box ms-3 my-3 d-none" id="edit{{$comment->id}}">
                <div class="card-body">
                    <form method="POST" action="{{ route('comment.update', $comment->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="input-group">
                            <input type="text" class="form-control" name="content"
                                value="{{ old('content', $comment->content) }}">
                            <button class="btn btn-dark"> Save </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- reply here  --}}
            @auth
                <div class="reply-box">
                    <span class="text-black-50 mb-0 rp-text rp-btn"> <i class="bi bi-reply-all-fill"></i> Reply </span>

                    <div class="mt-3 d-none">
                        <form method="POST" action="{{ route('comment.store') }}">
                            @csrf
                            <input type="hidden" name="article_id" value="{{ $article->id }}">
                            <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                            <textarea name="content" id="" class="form-control mb-3" rows="1"
                                placeholder="Reply to {{ $comment->user->name }} .....">
                        </textarea>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="text-black-50 mb-0">Reply as {{ Auth()->user()->name }}</p>
                                <button class="btn btn-dark"> <i class="bi bi-send"></i> Send </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endauth

            @guest
                <form method="POST" action="{{ route('comment.store') }}">
                    @csrf
                    <button type="submit" class="text-black-50 mb-0 rp-text btn">
                        <i class="bi bi-reply-all-fill"></i> Reply
                    </button>
                </form>
            @endguest

            <div class="replies mt-3">
                @foreach ($comment->replies()->latest()->get() as $reply)
                    <div class="card mb-4 ms-3 ">
                        <div class="card-body">
                            <div class="d-flex mb-2 align-items-top">
                                <img src="{{ asset('img/user.png') }}" style="width: 40px;height: 40px" alt="">
                                <div class="ms-2">
                                    <p class="fw-bold mb-0">
                                        {{ $reply->user->name }} <i class="bi bi-reply-all-fill"></i>
                                    </p>
                                    <p class="mb-0 fw-lighter" style="font-size: 11px">
                                        {{ $reply->created_at->diffforhumans() }}</p>
                                </div>
                                @can('delete', $reply)
                                    <button form="deleteRely{{ $reply->id }}"
                                        class="bg-danger border-0 ms-auto text-white rounded"
                                        style="width: 30px;height:30px;"> <i class="bi bi-trash"></i> </button>
                                    <form id="deleteRely{{ $reply->id }}" method="POST"
                                        action="{{ route('comment.destroy', $reply->id) }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                @endcan

                            </div>
                            <p class="mb-0"> {{ $reply->content }} </p>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@empty
    <p class="text-center">No Comment</p>
@endforelse
