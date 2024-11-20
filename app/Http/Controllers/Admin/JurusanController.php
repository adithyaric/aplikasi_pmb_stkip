<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class JurusanController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $jurusan = Jurusan::latest()->get();

            return DataTables::of($jurusan)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $actionBtn = '<a href="javascript:void(0)" onClick="Edit(this.id)" id="'.$data->id.'" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" onClick="Delete(this.id)" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</a>';

                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.jurusan.index');
    }

    public function store(Request $request)
    {
        Jurusan::updateOrCreate(
            [
                'id' => $request->id,
            ],
            [
                'name' => $request->name,
            ]
        );

        return redirect()->route('admin.jurusan.index')->with('success', 'data berhasil disimpan');
    }

    public function edit($id)
    {
        $jurusan = Jurusan::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $jurusan,
        ]);
    }

    public function destroy($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        $jurusan->delete();

        return response()->json([
            'status' => 'success',
        ]);
    }
}
