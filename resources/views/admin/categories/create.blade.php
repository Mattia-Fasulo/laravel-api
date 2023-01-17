@extends('layouts.admin')



@section('content')
    {{-- <div>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div> --}}
    <div class="mt-3 ">
        <h1 class="mx-4">Create Category</h1>
        <div class="row bg-white">
            <div class="col-12">
                <form action="{{ route('admin.categories.store') }}" method="POST" class="p-4" >
                    @csrf
                    <div class="mb-3 w-25">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- <div class="mb-3">
                        <label for="cover_image" class="form-label">Image</label>
                        <input type="file" name="cover_image" id="cover_image"
                            class="form-control  @error('cover_image') is-invalid @enderror">
                        @error('cover_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> --}}
                    <button type="submit" class="btn btn-dark">Submit</button>
                    <button type="reset" class="btn btn-light border-dark">Reset</button>
                </form>
            </div>
        </div>
    </div>
@endsection
