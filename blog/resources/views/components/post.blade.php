@props(['post' => $post])
{{-- @props(['comment' => $comment]) --}}

<div class="mb-4">

                        <a href="{{route('posts.user',$post->user)}}" class="font-bold">{{$post->user->name}}:</a>

                        <a class="bg-black p-1 rounded-md text-white  " href="{{route('comments',$post)}}" >{{$post->body}}</a>
                        <span class="text-gray-600 text-sm">{{$post->created_at->diffForHumans()}}</span> <br>

                        {{-- <a href="{{route('comments',$post)}}">{{$comment}} Comments</a> --}}

                        
                        @can('delete', $post)
                            <form action="{{route('posts.destroy',$post)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class='text-blue-500'>Delete</button>
                            </form>
                            @endcan

                            @auth
                            @if(auth()->user()->role===1)
                            <form class="flex justify-end" action="{{route('posts.destroy',$post)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class='text-blue-500'><svg id="Layer_1" enable-background="new 0 0 512 512" height="24" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><g><path d="m424 64h-88v-16c0-26.51-21.49-48-48-48h-64c-26.51 0-48 21.49-48 48v16h-88c-22.091 0-40 17.909-40 40v32c0 8.837 7.163 16 16 16h384c8.837 0 16-7.163 16-16v-32c0-22.091-17.909-40-40-40zm-216-16c0-8.82 7.18-16 16-16h64c8.82 0 16 7.18 16 16v16h-96z"/><path d="m78.364 184c-2.855 0-5.13 2.386-4.994 5.238l13.2 277.042c1.22 25.64 22.28 45.72 47.94 45.72h242.98c25.66 0 46.72-20.08 47.94-45.72l13.2-277.042c.136-2.852-2.139-5.238-4.994-5.238zm241.636 40c0-8.84 7.16-16 16-16s16 7.16 16 16v208c0 8.84-7.16 16-16 16s-16-7.16-16-16zm-80 0c0-8.84 7.16-16 16-16s16 7.16 16 16v208c0 8.84-7.16 16-16 16s-16-7.16-16-16zm-80 0c0-8.84 7.16-16 16-16s16 7.16 16 16v208c0 8.84-7.16 16-16 16s-16-7.16-16-16z"/></g></svg>
                                </button>
                            </form>
                            @endif
                            @endauth

                            @can('delete', $post)
                                <form action="{{route('posts.edit',$post)}}" method="post">
                                    @csrf
                                    <button type="submit" class='text-blue-500'>Update</button>
                                </form>
                            @endcan
                        


                    <div class="flex items-center">
                        @auth
                        @if(!$post->liked(auth()->user()))
                        <form action="{{route('posts.likes',$post->id)}}" method="post" class="mr-1">
                            @csrf
                            <button type="submit" class="text-blue-500">Like</button>
                        </form>
                        @else
                        <form action="{{route('posts.likes',$post->id)}}" method="post" class="mr-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-blue-500">Unlike</button>
                        </form>
                        @endif
                        @endauth    
                        <span>{{$post->likes->count()}}{{Str::plural('like',$post->likes->count())}}</span>
                    </div>



                        {{-- comment --}}
                    <div>
                        
                        @auth
                        <form action="{{route('comments',$post->id)}}" method="post">
                        @csrf
                        <input type="hidden" name="id_post" value="{{$post->id}}">
                        <textarea name="comments" cols="10" rows="2" class="bg-gray-100 border-2 w-full p-2 rounded-lg  border-black-500 " placeholder="comment something!"></textarea>
                        <div>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Comment</button>
                        </div>
                        </form>
                        @endauth
                        


                    </div>

                    


</div>