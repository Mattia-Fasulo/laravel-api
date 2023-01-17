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
        <h1 class="mx-4">Create Project</h1>
        <div class="row bg-white">
            <div class="col-12">
                <form action="{{ route('admin.projects.store') }}" method="POST" class="p-4" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                            name="title" required maxlength="150" minlength="3">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">* Minimum 3 characters and maximum 150 characters</div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>

                    <div >

                        <label for="cover_image" class="form-label">Insert an Image</label>
                        {{-- <input type="file" name="cover_image" id="create_cover_image"
                            class="form-control  @error('cover_image') is-invalid @enderror"> --}}
                        <div class=" mb-3 w-50">

                            <img class="d-block mb-2" id="uploadPreview" width="100" src="https://via.placeholder.com/300x200">
                            <div >

                                <input type="file" name="cover_image" id="create_cover_image"
                                    class="form-control  @error('cover_image') is-invalid @enderror">
                                @error('cover_image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>




                        </div>

                        <div class="mb-3 w-25">
                            <label for="category_id" class="form-label">Selct Category</label>
                            <select name="category_id" id="category_id"
                                class="form-control @error('category_id') is-invalid @enderror" required>
                                <option value="">Select category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $category->id == old('category_id') ? 'selected' : '' }}>{{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            {{-- <label for="tags" class="form-label">Select Tags</label> <br> --}}
                            @foreach ($tags as $tag)
                                <div class="form-check form-check-inline">


                                    <input type="checkbox" class="form-check-input" id="{{ $tag->slug }}" name="tags[]"
                                        value="{{ $tag->id }}">

                                    <label class="form-check-label" for="{{ $tag->slug }}">{{ $tag->name }}</label>
                                </div>
                            @endforeach
                            @error('tags')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <button type="submit" class="btn btn-dark">Submit</button>
                        <button type="reset" class="btn btn-light border-dark">Reset</button>
                </form>
            </div>
        </div>
    </div>
    <script src="//js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
    <script type="text/javascript">
        bkLib.onDomLoaded(nicEditors.allTextAreas);
    </script>
@endsection
