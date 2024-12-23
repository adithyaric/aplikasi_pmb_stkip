<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TransactionController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $jurusan = Transaction::with('user')->latest()->get();

            return DataTables::of($jurusan)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $actionBtn = '<a href="javascript:void(0)" onClick="Edit(this.id)" id="'.$data->id.'" class="edit btn btn-success btn-sm">Bayar</a> ';
                    $success = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">Success</a> ';

                    return $data->status == 'pending' ? $actionBtn : $success;
                })
                ->addColumn('nominal', function ($data) {
                    return moneyFormat($data->nominal);
                })
                ->rawColumns(['action', 'nominal'])
                ->make(true);
        }

        return view('admin.transactions.index');
    }

    public function update($id)
    {
        $transaction = Transaction::findOrFail($id);
        $mahasiswa = Mahasiswa::where('user_id', $transaction->user_id)->first();
        // return $mahasiswa;
        $transaction->update([
            'status' => 'success',
        ]);
        $mahasiswa->update([
            'status' => 'BAYAR OK',
        ]);

        return response()->json([
            'status' => 'success',
        ]);
    }

    public function bulkUpdate(Request $request)
    {
        $ids = $request->ids;

        if (! $ids || ! is_array($ids)) {
            return response()->json(['success' => false, 'message' => 'No data selected.'], 400);
        }

        Transaction::whereIn('id', $ids)->update(['status' => 'success']);

        return response()->json(['success' => true, 'message' => 'Selected transactions updated successfully!']);
    }

    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return response()->json([
            'status' => 'success',
        ]);
    }
}
