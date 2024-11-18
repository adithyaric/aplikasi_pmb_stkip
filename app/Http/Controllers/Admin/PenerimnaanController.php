<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penerimaan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PenerimnaanController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $penerimaan = Penerimaan::latest()->get();
            return DataTables::of($penerimaan)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $actionBtn = '<a href="javascript:void(0)" onClick="Edit(this.id)" id="' . $data->id . '" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" onClick="Delete(this.id)" id="' . $data->id . '" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.penerimaan.index');
    }


    public function store(Request $request)
    {
        Penerimaan::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'name' => $request->name
            ]
        );

        return redirect()->route('admin.penerimaan.index')->with('success', 'data berhasil disimpan');
    }

    public function edit($id)
    {
        $penerimaan = Penerimaan::findOrFail($id);
        return response()->json([
            'status' => "success",
            'data' => $penerimaan
        ]);
    }

    public function destroy($id)
    {
        $penerimaan = Penerimaan::findOrFail($id);
        $penerimaan->delete();
        return response()->json([
            'status' => "success"
        ]);
    }
}
