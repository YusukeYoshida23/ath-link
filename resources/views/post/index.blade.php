<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            一覧表示
        </h2>
    </x-slot>

    <div class="mx-auto px-6">
        {{-- @if(session('message'))
            <div class="text-red-600 font-bold">
                {{session('message')}}
            </div>
        @endif --}}
        <x-message :message="session('message')" />
        @foreach($posts as $post)
        <div class="mt-4 p-8 bg-white w-full rounded-2xl">
            <div class="flex">
                <div class="rounded-full w-12 h-12">
                    <img src="{{asset('avatar/'.($post->user->avatar??'avatar/user_default.jpg'))}}" alt="">
                </div>
                <h1 class="p-4 text-lg font-semibold">
                    件名：
                    <a href="{{route('post.show', $post)}}" class="text-blue-600">
                        {{$post->title}}
                    </a>
                </h1>
            </div>
            <hr class="w-full">
            <p class="mt-4 p-4">
                {{Str::limit($post->body, 100, '...')}}
            </p>
            <div class="p-4 text-sm font-semibold">
                <p>
                    {{$post->created_at}} / {{$post->user->name??'匿名'}}
                </p>
            </div>
            <hr class="w-full mb-2">
            @if ($post->comments->count())
            <span class="badge">
                返信 {{$post->comments->count()}}件
            </span>
            @else
            <span>コメントはまだありません</span>
            @endif
            <a href="{{route('post.show', $post)}}" style="color:white">
                <x-primary-button class="float-right">コメントする</x-primary-button>
            </a>
        </div>
        @endforeach
        <div class="mb-4">
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>
