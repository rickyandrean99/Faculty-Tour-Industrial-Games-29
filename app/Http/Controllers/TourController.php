<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TourController extends Controller
{
    public function loadTourPage() {
        $region = DB::table('categories')->get();
        return view('tour.index', ['regions' => $region]);
    }

    public function selectTourPage(Request $request) {
        $id = $request->get('id');

        $photo_list = DB::table('photos')->join('categories', 'photos.categories_id', '=', 'categories.id')->where('categories_id', $id)->select('categories.nama as folder', 'photos.nama as file')->get();

        return response()->json(array(
            'status'=> "oke",
            'photo_list'=> $photo_list
        ), 200);
    }
}
