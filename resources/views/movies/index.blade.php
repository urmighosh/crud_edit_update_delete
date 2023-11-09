@extends('movies.layout')

<div class="row">
    <div class="col-md-8 offset-2">


        <div class="card mt-5">
            <div class="card-header text-center">
                @section('content')
            </div>
        </div>

        <div class="card-body">

            <table class="table table-hober table-bordered">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Image</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                </tr>
                </thead>
                <tbody class="table-group-divider">
                @foreach ($movies as $movie)
                    <tr>
                        <th scope="row">{{$movie->id}}</th>
                        <td><img src="{{$movie->image}}" height="180px" width="200px"></td>
                        <td>{{$movie->title}}</td>
                        <td>{{$movie->description}}</td>
                        <td>
                            <a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-success">Edit</a>

                            <form action="{{ route('movies.destroy', $movie->id) }}" method="post"
                                  style="display: inline;">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger" type="submit"
                                        onclick="return confirm('Are you sure to delete this?')">Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $movies->links() }}
        </div>
    </div>
</div>
@endsection
