<?php

namespace App\Http\Controllers;

use App\Models\Tahun;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TahunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $tahun = Tahun::latest()->get();

            return DataTables::of($tahun)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $actionBtn = '<a href="javascript:void(0)" onClick="Edit(this.id)" id="'.$data->id.'" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" onClick="Delete(this.id)" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</a>';

                    return $actionBtn;
                })
                ->addColumn('status', function ($status) {
                    if ($status->status != null) {
                        if ($status->status == '1') {
                            return 'Aktif';
                        } else {
                            return 'Tidak Aktif';
                        }
                    } else {
                        return '';
                    }
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        return view('admin.tahun.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Tahun::updateOrCreate(
            [
                'id' => $request->id,
            ],
            [
                'nama' => $request->nama,
                'status' => $request->status,
            ],
        );

        return redirect()->route('admin.tahun.index')->with('success', 'data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Tahun $tahun)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tahun  $tahun
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tahun = Tahun::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $tahun,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tahun $tahun)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tahun  $tahun
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tahun = Tahun::findOrFail($id);
        $tahun->delete();

        return response()->json([
            'status' => 'success',
        ]);
    }
}
