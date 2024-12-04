<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gelombang;
use App\Models\Jurusan;
use App\Models\Tahun;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $tahunId = $request->input('tahun_id') ?? Tahun::where('status', true)->value('id');

        $gelombangQuery = Gelombang::query();
        $userQuery = User::query();
        $jurusanQuery = Jurusan::query();

        if ($tahunId) {
            $gelombangQuery->with(['user' => function ($query) {
                $query->whereHas('mahasiswa', function ($q) {
                    $q->whereNotNull('jurusan_id');
                });
            }])->whereHas('user.mahasiswa', function ($query) {
                $query->whereNotNull('jurusan_id');
            })->where('tahun_id', $tahunId);

            $userQuery->whereHas('mahasiswa.jurusan')->whereHas('gelombang', function ($query) use ($tahunId) {
                $query->where('tahun_id', $tahunId);
            });

            $jurusanQuery->with(['mahasiswa' => function ($query) use ($tahunId) {
                $query->whereHas('user.gelombang', function ($q) use ($tahunId) {
                    $q->where('tahun_id', $tahunId);
                });
            }, 'gelombang', 'mahasiswa.user']);

            // dd($gelombangQuery->get()->toArray(), $userQuery->get()->toArray(), $jurusanQuery->get()->toArray());
        }

        $mahasiswa = $userQuery->where('roles', 'MAHASISWA')->count();
        $bayar = $userQuery->whereHas('transaksi', function ($q) {
            $q->where('status', 'success');
        })->count();
        $berkas = $userQuery->whereHas('mahasiswa', function ($q) {
            $q->where('status', 'BERKAS LENGKAP');
        })->count();
        $cbt = $userQuery->whereHas('mahasiswa', function ($q) {
            $q->where('status', 'TES / CBT');
        })->count();
        $interview = $userQuery->whereHas('mahasiswa', function ($q) {
            $q->where('status', 'INTERVIEW');
        })->count();
        $diterima = $userQuery->whereHas('mahasiswa', function ($q) {
            $q->where('status', 'BERKAS DITERIMA');
        })->count();
        $keluar = $userQuery->whereHas('mahasiswa', function ($q) {
            $q->where('status', 'KELUAR');
        })->count();

        $tahuns = Tahun::get();
        $gelombang = $gelombangQuery->get();
        $jurusan = $jurusanQuery->get();

        return view('admin.dashboard', compact('mahasiswa', 'keluar', 'bayar', 'berkas', 'diterima', 'jurusan', 'cbt', 'interview', 'gelombang', 'tahunId', 'tahuns'));
    }

    public function profile()
    {
        $profile = Auth::user();

        return view('admin.profile', compact('profile'));
    }

    public function profileUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'confirmed',
        ]);
        if ($request->input('password') == '') {
            $user->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
            ]);
        } else {

            $user->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),

            ]);
        }

        return redirect()->route('dashboard')->with('success', 'data berhasil disimpan');
    }
}
