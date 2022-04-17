@props(['post' => $post])

<div class="mb-2">
    <div class="bg-purple-900 text-white rounded-t px-1 flex justify-between"><a href="{{route('users.posts', $post->user)}}" class="font-bold">{{ucfirst($post->user->name)}}</a><span>{{$post->updated_at->diffForHumans()}}</span>
    </div>
    <div class="bg-gray-100 p-2 pl-1">{{$post->body}}</div>
    <div class="flex bg-gray-400 items-cente rounded-b text-sm">
        @auth
        @if(!$post->likedBy(auth()->user()))
        <form action="{{route('posts.likes', $post)}}" method="POST" class="ml-1 mr-4">
            <!-- protection with hidden token -->
            @csrf
            <button type="submit" class="font-semibold text-white rounded font-medium text-white"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
            </button>
        </form>
        @else
        <form action="{{route('posts.likes', $post)}}" method="POST" class="ml-1 mr-4">

            <!-- protection with hidden token -->
            @csrf
            @method('DELETE')
            <button type="submit" class="font-semibold text-white rounded font-medium text-gray-900"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i>
            </button>
        </form>
        @endif
        @endauth
        <span class="text-white">{{$post->likes->count()}} {{Str::plural('like', $post->likes->count())}}</span>
        @can('delete', $post)
        <form action="{{route('posts.edit', $post)}}" method="GET" class="ml-auto mr-2">
            <!-- protection with hidden token -->
            @csrf
            <button type="submit" class="font-semibold text-white rounded font-medium"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            </button>
        </form>
        <form action="{{route('posts.del', $post)}}" method="POST" class="mr-1">
            <!-- protection with hidden token -->
            @csrf
            @method('DELETE')
            <button type="submit" class="font-semibold rounded font-medium text-gray-900"><i class="fa fa-trash-o" aria-hidden="true"></i>

            </button>
        </form>
        @endcan
    </div>
</div>