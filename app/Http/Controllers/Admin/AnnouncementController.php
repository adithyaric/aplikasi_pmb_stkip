<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Gelombang;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class AnnouncementController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $announcement = Announcement::latest()->get();

            return DataTables::of($announcement)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $editRoute = route('admin.pengumuman.edit', $data->id);
                    $actionBtn = '<a href="'.$editRoute.'" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" onClick="Delete(this.id)" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</a>';

                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.announcement.index');
    }

    public function store(Request $request)
    {
        $announcement = Announcement::updateOrCreate(
            [
                'id' => $request->id,
            ],
            [
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'content' => $request->content,
                'date_start' => $request->date_start,
                'date_end' => $request->date_end,
            ]
        );

        $announcement->gelombangs()->sync($request->gelombangs);

        return redirect()->route('admin.pengumuman.index')->with('success', 'Data berhasil disimpan');
    }

    public function edit($id)
    {
        $announcement = Announcement::findOrFail($id);

        return view('admin.pengumuman.edit', [
            'pengumuman' => $announcement,
            'gelombangs' => Gelombang::get(),
        ]);

        // return response()->json([
        //     'status' => 'success',
        //     'data' => $announcement,
        // ]);
    }

    public function destroy($id)
    {
        $announcement = Announcement::findOrFail($id);
        $announcement->delete();

        return response()->json([
            'status' => 'success',
        ]);
    }
}
