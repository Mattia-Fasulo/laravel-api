@extends('layouts.admin')

@section('content')
    <div>
        <h1 class="m-3">Categories</h1>
        <div class="text-end">
            <a class="btn btn-dark mx-3 mb-3" href="{{ route('admin.categories.create') }}">New Category</a>
        </div>
        @if (session()->has('message'))
            <div class="alert alert-success m-3 ">
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="table-responsive mx-3">
            <table class="my-table table table-striped">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Projects</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr class="text-center">
                            <th scope="row">{{ $category->id }}</th>
                            <td><a href="{{ route('admin.categories.show', $category->slug) }}"
                                    title="View Ctegory">{{ $category->name }}</a></td>
                            <td>{{ count($category->projects) }}</td>
                            <td><a class="link-secondary" href="{{ route('admin.categories.edit', $category->slug) }}"
                                    title="Edit Category"><i class="fa-solid fa-pen"></i></a></td>
                            <td class="my-w-100">
                                <form action="{{ route('admin.categories.destroy', $category->slug) }}" method="POST" >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-button btn btn-danger"
                                        data-item-title="{{ $category->name }}"><i
                                            class="fa-solid fa-trash-can"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @include('partials.admin.modal-delete')
    </div>
@endsection
