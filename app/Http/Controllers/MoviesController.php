<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::paginate(2);
        // return view('movies.index', ['movies' => $movies]);
        // $movies = Movie::all();
        return view('movies.index' ,compact('movies')) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('movies.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    static $movies, $image, $directory, $imageName, $imageNew;

    static function imageUrl($imagedata)
    {
        self::$image = $imagedata->file('image');
        self::$imageName = self::$image->getClientOriginalName();
        self::$directory = 'upload/movies/';
        self::$image->move(self::$directory, self::$imageName);
        return self::$directory . self::$imageName;
    }


    public function store(Request $request)
    {
        $movies = new Movie();
        $movies->title = $request->title;
        $movies->description = $request->description;
        if (isset($request->image)) {
            $movies->image = self::imageUrl($request);
        }
        $movies->save();
        return redirect()->route('movies.index')->with('success', 'Movie created successfully');
    }

    public function show(Movie $movie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Movie $movie
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

   return view('movies.edit',['movies'=>movie::find($id)]);
//    return view('admin.central-committee.edit',['centralCommittee'=>CentralCommittee::find($id)
// ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Movie $movie
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, $id)
        {
            $movies = Movie::find($id);
            $movies->title = $request->title;
            $movies->description = $request->description;
            if($request->file('image')){
                if(file_exists($movies->image)){
                    unlink($movies->image);
                }
                self::$imageNew = self::imageUrl($request);
            }else{
                self::$imageNew = $movies->image;
            }
            $movies->image = self::$imageNew;
            $movies->save();
            return redirect()->route('movies.index');
        }
    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Movie $movie
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $movies = Movie::find($id);
        if (file_exists($movies->image)) {
            unlink($movies->image);
        }
        $movies->delete();
        return back();
    }
}
