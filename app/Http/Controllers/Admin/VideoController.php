<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class VideoController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $video = Video::latest()->get();

            return DataTables::of($video)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $actionBtn = '<a href="javascript:void(0)" onClick="Edit(this.id)" id="'.$data->id.'" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" onClick="Delete(this.id)" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</a>';

                    return $actionBtn;
                })
                ->addColumn('video', function ($data) {
                    return '<iframe width="300" height="150" src="'.$data->name.'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.video.index');

    }

    public function store(Request $request)
    {
        Video::updateOrCreate(
            [
                'id' => $request->id,
            ],
            [
                'name' => $request->name,
            ]
        );

        return redirect()->route('admin.video.index')->with('success', 'data berhasil disimpan');
    }

    public function edit($id)
    {
        $video = Video::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $video,
        ]);
    }

    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        $video->delete();

        return response()->json([
            'status' => 'success',
        ]);
    }
}
