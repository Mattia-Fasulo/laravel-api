@extends('layouts.admin')

@section('content')
    <h1 class="m-3">Tags</h1>
    <form class=" action="{{route('admin.tags.store')}}" method="post" class="d-flex align-items-center m-4">
        @csrf
        <div class="input-group m-3 w-50">
            <input type="text" name="name" class="form-control" placeholder="
            Add a tag name here " aria-label="Recipient's username" aria-describedby="button-addon2">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Add</button>
        </div>
    </form>
    @if(session()->has('message'))
    <div class="alert alert-success m-3">
        {{ session()->get('message') }}
    </div>
    @endif
    <div class="mx-3">
    <table class="my-table table table-striped">
        <thead class="table-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th class="text-center" scope="col">Posts</th>
            <th class="text-center" scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tags as $tag)
                <tr>
                    <th scope="row">{{$tag->id}}</th>
                    <td>
                        <form id="tag-{{$tag->id}}" action="{{route('admin.tags.update', $tag->slug)}}" method="post">
                            @csrf
                            @method('PATCH')
                            <input class="border-0 bg-transparent" type="text" name="name" value="{{$tag->name}}">
                        </form>

                    </td>

                    <td class="text-center">
                        {{ $tag->projects && count($tag->projects) > 0 ? count($tag->projects) : 0 }}
                    </td>

                    <td class="my-w-100 text-center">
                        <form action="{{route('admin.tags.destroy', $tag->slug)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-button btn btn-danger " data-item-title="{{$tag->name}}"><i class="fa-solid fa-trash-can"></i></button>
                     </form>
                    </td>
                </tr>
        @endforeach
        </tbody>
    </table>
    </div>
    @include('partials.admin.modal-delete')
@endsection

