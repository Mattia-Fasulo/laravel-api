@extends('layouts.admin')

@section('content')



    <div class="mt-3 px-5">
        <h1>{{$project->title}}</h1>
        @if ($project->category)
            <small>Category : {{$project->category->name}}</small>
        @endif
        <p class="my-2">{!! $project->description !!}</p>
        @if ($project->cover_image)
        <div>
            <img width="300" src="{{ asset('storage/' . $project->cover_image) }}">
        </div>
        @endif

        @if ($project->tags && count($project->tags) > 0)
        <div class="d-flex">
            <span>Tags:</span>
            <ul class="list-group-flush ">
                 @foreach ($project->tags as $tag)
                    <li>{{$tag->name}}</li>
                @endforeach
            </ul>
        </div>

        @endif

        <div class="text-end mt-4">
            <a href="{{route('admin.projects.edit', $project->slug)}}" class="btn btn-light border-dark">Edit</a>
        </div>
    </div>

@endsection
