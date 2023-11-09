@extends('movies.layout')

<div class="row">
    <div class="col-md-8 offset-2">
        <div class="card mt-5">
            @section('content')
                <div class="card-header">
                    <div class="formcontainer">
                       <form action="{{route('movies.update', $movies->id )}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                           @method('put')
                            <div class="mb-3">
                                <label for="titleInput" class="form-label">Title</label>
                                <input type="text" name="title" value="{{$movies->title}}" class="form-control" id="titleInput"
                                       aria-describedby="titleHelp">
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description Title</label>
                                <input type="text" name="description" value="{{$movies->description}}"class="form-control" id="description"
                                       aria-describedby="descriptionHelp">
                            </div>
                            {{-- <img src="{{$movies->image}}" height="180px" width="200px"> --}}
                            <div class="mb-3">

                                <label for="formFileMultiple" class="form-label">Image Input </label>

                                <input class="form-control" name="image" type="file" id="formFileMultiple">
                                <img src="{{$movies->image}}" height="180px" width="200px">
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                            </div>
                        </form>

                    </div>

                </div>
        </div>
    </div>
@endsection
