<x-app-layout>



    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$post->name}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <p style="margin: 10px; background-color:white">
                    slug: {{$post->slug}}
                </p>
                <p style="margin: 15px; background-color:white">
                    excerpt: {{$post->excerpt}}
                </p>
                <p style="margin: 20px; background-color:white">
                    content: {{$post->content}}
                </p>
            </div>
            <div>
                @foreach($activeTags as $activeTag)
                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">{{ $activeTag->name }}</span>
                @endforeach
            </div>
            
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <h3 class="font-semibold text-lg text-gray-800 leading-tight">Add Comment</h3>
            <form action="{{ route('comments.store') }}" method="POST">
                @csrf
                <input type="hidden" name="post_id" value="{{$post->id}}">
                <div>
                    <textarea name="content" rows="3" placeholder="Enter your comment" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" required></textarea>
                </div>
                <div class="mt-4">
                    <button class="px-4 py-2 font-bold bg-blue-500 rounded hover:bg-blue-700">Create</button>
                </div>
            </form>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h3 class="font-semibold text-lg text-gray-800 leading-tight">Comments</h3>
                @foreach($post->comments as $comment)
                    <div class="border-b border-gray-200 py-4">
                        <p class="text-gray-700">{{$comment->content}}</p>
                        <p class="text-gray-400">{{$comment->user->name}}</p>
                    </div>
                @endforeach
            </div>
            </div>
        
            <form action="{{ route('posts.tags.update', $post) }}" method="POST">
                @csrf

                <label for="tags" class="block font-medium text-gray-700 mb-1">Теги:</label>

                <select name="tags[]" id="tags" multiple class="border-gray-400 border-2 rounded px-4 py-2 focus:outline-none focus:border-blue-400">
                    @foreach($tags as $tag)
                        @if($activeTags->contains($tag))
                            <option value="{{ $tag->id }}" selected>{{ $tag->name }}</option>
                        @else
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endif
                    @endforeach
                </select>

                <button type="submit" class="bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded mt-3">Сохранить</button>
            </form>

        </div>
    </div>




</x-app-layout>
