<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            個別表示
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6">
        @if(session('message'))
        <div class="text-red-600 font-bold">
            {{session('message')}}
        </div>
        @endif
        <div class="bg-white w-full rounded-2xl">
            <div class="mt-4 p-4">
                <div class="flex">
                    <div class="rounded-full w-12 h-12">
                        <img src="{{asset('avatar/'.($post->user->avatar??'avatar/user_default.jpg'))}}" alt="">
                    </div>
                    <h1 class="text-lg font-semibold">
                        {{ $post->title }}
                    </h1>
                </div>
                <div class="text-right flex">
                    @can('update', $post)
                    <a href="{{route('post.edit', $post)}}" class="flex-1">
                        <x-primary-button>
                            編集
                        </x-primary-button>
                    </a>
                    @endcan
                    @can('delete', $post)
                    <form method="post" action="{{route('post.destroy', $post)}}" class="flex-2">
                        @csrf
                        @method('delete')
                        <x-primary-button class="bg-red-700 ml-2">
                            削除
                        </x-primary-button>
                    </form>
                    @endcan
                </div>

                <hr class="w-full">
                <p class="mt-4 whitespace-pre-line">
                    {{ $post->body }}
                </p>
                <div class="text-sm font-semibold flex flex-row-reverse">
                    <p>{{ $post->created_at }}</p>
                </div>
                @foreach ($post->comments as $comment)
                <div class="bg-white w-full rounded-2xl px-10 py-2 shadow-lg mt-8 whitespace-pre-line">
                    {{$comment->body}}
                    <div class="text-sm font-semibold flex flex-row-reverse">
                        <p class="float-left pt-4">{{ $comment->user->name }}・{{$comment->created_at->diffForHumans()}}</p>
                        <span class="rounded-full w-12 h-12">
                            <img src="{{asset('public/avatar/'.($post->user->avatar??'public/avatar/user_default.jpg'))}}" alt="">
                        </span>
                    </div>
                </div>
                @endforeach
                <div class="mt-4 mb-12">
                    <form method="post" action="{{route('comment.store')}}">
                        @csrf
                        <input type="hidden" name='post_id' value="{{$post->id}}">
                        <textarea name="body" class="bg-white w-full rounded-2xl px-4 mt-4 py-4 shadow-lg hover:shadow-2xl transition duration-500" id="body" cols="30" rows="3" placeholder="コメントを入力してください">{{old('body')}}</textarea>
                        <x-primary-button class="float-right mr-4 mb-12">コメントする</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
