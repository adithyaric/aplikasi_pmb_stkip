<?php

namespace App\Http\Controllers;

use App\Models\Persyaratan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class PersyaratanController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $persyaratan = Persyaratan::latest()->get();

            return DataTables::of($persyaratan)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $actionBtn = '<a href="javascript:void(0)" onClick="Edit(this.id)" id="'.$data->id.'" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" onClick="Delete(this.id)" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</a>';

                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.persyaratan.index');
    }

    public function store(Request $request)
    {
        Persyaratan::updateOrCreate([
            'id' => $request->id,
        ], [
            'name' => $request->name,
            'is_required' => $request->is_required == '1' ? true : false,
            'slug' => $request->slug ?: Str::slug($request->name),
        ]);

        return redirect()->route('admin.persyaratan.index')->with('success', 'Data berhasil disimpan');
    }

    public function edit($id)
    {
        $persyaratan = Persyaratan::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $persyaratan,
        ]);
    }

    public function destroy($id)
    {
        $persyaratan = Persyaratan::findOrFail($id);
        $persyaratan->delete();

        return response()->json([
            'status' => 'success',
        ]);
    }
}
