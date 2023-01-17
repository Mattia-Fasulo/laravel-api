@extends('layouts.admin')

@section('content')

    <h1 class="m-3">{{$category->name}}</h1>

    <ul>
        @foreach ($category->projects as $project)
            <li><a href="{{ route('admin.projects.show', $project->slug) }}"
                title="View Project">{{ $project->title }}</a></li>
        @endforeach
    </ul>

    @if ($category->cover_image)
        <div>
            <img width="300" src="{{ asset('storage/' . $category->cover_image) }}">
        </div>
    @endif


@endsection
