<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gelombang;
use App\Models\Penerimaan;
use App\Models\Persyaratan;
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
                    $actionBtn = '<a href="'.route('admin.penerimaan.edit', $data->id).'" class="edit btn btn-success btn-sm">Edit</a>
                              <a href="javascript:void(0)" onClick="Delete(this.id)" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</a>';

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
                'id' => $request->id,
            ],
            [
                'name' => $request->name,
            ]
        );

        return redirect()->route('admin.penerimaan.index')->with('success', 'data berhasil disimpan');
    }

    public function edit($id)
    {
        $penerimaan = Penerimaan::findOrFail($id);

        return view('admin.penerimaan.edit', [
            'penerimaan' => $penerimaan,
            'persyaratans' => Persyaratan::get(),
            'gelombangs' => Gelombang::get(),
        ]);
    }

    public function update(Request $request)
    {
        $penerimaan = Penerimaan::findOrFail($request->id);

        $penerimaan->update([
            'name' => $request->name,
        ]);

        $penerimaan->persyaratan()->sync($request->persyaratans);
        $penerimaan->gelombang()->sync($request->gelombangs);

        return redirect()->route('admin.penerimaan.index')->with('success', 'Data berhasil disimpan');
    }

    public function destroy($id)
    {
        $penerimaan = Penerimaan::findOrFail($id);
        $penerimaan->delete();

        return response()->json([
            'status' => 'success',
        ]);
    }
}
