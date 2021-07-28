@extends('layouts.app')

@section('content')
<h1 class="font-bold">Comments</h1>
@foreach ($comments as $comment)
       <div class="bg-gray-100 border-2 w-full p-4 rounded-lg">
       <p class="font-bold">{{$comment->user->name}} :</p> 
       <p>{{$comment->comments}}</p>
</div>
       
@endforeach
@endsection