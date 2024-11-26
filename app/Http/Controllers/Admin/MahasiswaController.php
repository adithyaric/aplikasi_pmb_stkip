<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class MahasiswaController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $mahasiswa = User::with('transaksi')->where('roles', 'MAHASISWA')->with('mahasiswa', 'biodata')->latest()->get();

            return DataTables::of($mahasiswa)
                ->addIndexColumn()
                ->addColumn('action', function ($siswa) {
                    $actionBtn = '<a href="'.route('admin.mahasiswa.edit', $siswa->id).'" class="edit btn btn-warning btn-sm"> Edit</a>';
                    $actionBtn .= ' <a href="'.route('admin.mahasiswa.show', $siswa->id).'" class="btn btn-info btn-sm"> Detail</a>';
                    $actionBtn .= '<a href="javascript:void(0)" onClick="Delete(this.id)" id="'.$siswa->id.'" class="bayar btn btn-danger btn-sm"> Hapus</a> ';

                    if ($siswa->transaksi != null) {
                        $transaction = '<a href="javascript:void(0)" onClick="Bayar(this.id)" id="'.$siswa->transaksi->id.'" class="bayar btn btn-info btn-sm"> Bayar</a> ';
                    } else {
                        $transaction = '';
                    }

                    $whatsapp = '<a href="https://wa.me/'.$siswa->mahasiswa->phone.'?text=SELAMAT%20PEMBAYARAN%20PENDAFTARAN%20ANDA%20TELAH%20KAMI%20TERIMA.%0ATahap%20selanjutnya%20adalah%20LOGIN%20melalui%20alamat%20https://regpmb.stkippacitan.ac.id/login%20.%0A-%20Username%20:%20'.$siswa->nisn.'%0A-%20Password%20:%20'.$siswa->password_sementara.'%0ASilahkan%20unggah%20data%20dan%20berkas%20pendaftaranmu%20segera%20untuk%20bisa%20mengikuti%20tahapan%20seleksi%20selanjutnya.%20Terima%20kasih" target="_blank" class="btn btn-success btn-sm">Whatsapp</a>';

                    // $whatsapp = ' <a href="https://wa.me/' . $siswa->mahasiswa->phone . '?text=*SELAMAT%20PENDAFTARAN%20ANDA%20TELAH%20KAMI%20TERIMA*%20selanjutnya%20silahkan%20anda%20melakukan%20pengisian%20data%20dan%20upload%20berkas%20dengan%20login%20pada%20alamat%20https://entripmb.stkippacitan.ac.id/login%20dengan%20Username%20:%20' . $siswa->nisn . '%20dan%20password%20:%20' . $siswa->password_sementara . '" target="_blank" class="btn btn-success btn-sm">Whatsapp</a>';

                    return $siswa->mahasiswa->status == 'DALAM PROSES' ? $actionBtn.$transaction.$whatsapp : $actionBtn.$whatsapp;
                    // return $actionBtn  . $transaction . $whatsapp;
                })
                ->addColumn('briva', function ($transaksi) {
                    if ($transaksi->transaksi != null) {
                        return $transaksi->transaksi->briva;
                    } else {
                        return '';
                    }
                })
                ->addColumn('gelombang', function ($gelombang) {
                    if ($gelombang->gelombang_id != null) {
                        return $gelombang->gelombang->nama;
                    } else {
                        return '';
                    }
                })
                ->addColumn('lulusan', function ($lulusan) {
                    if ($lulusan->lulusan != null) {
                        return $lulusan->lulusan->asal_sekolah;
                    } else {
                        return '';
                    }
                })
                ->addColumn('created', function ($created) {
                    if ($created != null) {
                        return $created->created_at;
                    } else {
                        return '';
                    }
                })
                ->rawColumns(['action', 'briva', 'gelombang', 'lulusan', 'created'])
                ->make(true);
        }

        return view('admin.mahasiswa.index');
    }

    public function create()
    {
        return view('admin.mahasiswa.create');
    }

    public function edit($id)
    {
        $mahasiswa = User::with('mahasiswa')->findOrFail($id);

        return view('admin.mahasiswa.edit', compact('mahasiswa'));
    }

    public function show($id)
    {
        $mahasiswa = User::with('mahasiswa')->findOrFail($id);

        return view('admin.mahasiswa.detail', compact('mahasiswa'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $mahasiswa = Mahasiswa::where('user_id', $id)->first();

        $user->update([
            'name' => strtoupper($request->name),
            'nisn' => $request->nisn,
        ]);

        $mahasiswa->update([
            'phone' => $request->phone,
            'tempat_lahir' => strtoupper($request->tempat_lahir),
            'tanggal_lahir' => $request->tanggal_lahir,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.mahasiswa.index')->with('success', 'data berhasil disimpan');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'nisn' => 'required|unique:users',
            'phone' => 'required|unique:mahasiswa',
            'gelombang_id' => 'required',
        ]);

        $length = 8;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $password = $randomString;
        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => strtoupper($request->name),
                'nisn' => $request->nisn,
                'roles' => 'MAHASISWA',
                'password' => Hash::make($password),
                'password_sementara' => $password,
                'gelombang_id' => $request->gelombang_id,
                'photo' => 'default.jpg',

            ]);

            Mahasiswa::create([
                'user_id' => $user->id,
                'phone' => $request->phone,
                'tempat_lahir' => strtoupper($request->tempat_lahir),
                'tanggal_lahir' => $request->tanggal_lahir,
                'status' => 'DALAM PROSES',

            ]);
            $no_transaction = Transaction::latest()->first();

            $transaction = Transaction::create([
                'user_id' => $user->id,
                'no_transaksi' => $no_transaction != null ? $no_transaction->no_transaksi + 1 : 2022001,
                'briva' => $no_transaction != null ? $no_transaction->briva + 1 : 999999001,
                'nominal' => 300000,
                'status' => 'pending',
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return back();
        }

        return redirect()->route('admin.mahasiswa.index')->with('success', 'data berhasil disimpan');
    }

    public function destroy($id)
    {
        $mahasiswa = User::findOrFail($id);
        $mahasiswa->delete();
        Mahasiswa::where('user_id', $id)->delete();

        if ($mahasiswa) {

            return response()->json([
                'status' => 'success',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
            ]);
        }
    }

    public function dashboard()
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::user()->id)->first();

        return view('mahasiswa.dashboard', compact('mahasiswa'));
    }

    public function RegisterMahasiwa(Request $request)
    {
        $messages = [
            'required' => 'Kolom :attribute wajib diisi!',
            'unique' => ':attribute yang anda gunakan telah terdaftar!',
            'email' => 'Kolom :attribute harus berformat email (contoh@email.com)',
            'unique_combination' => 'Kombinasi :attribute dan Gelombang sudah terdaftar!',
        ];

        $this->validate($request, [
            'name' => 'required',
            'nisn' => 'required|numeric',
            'email' => 'required|email|unique:users',
            'phone' => 'required|unique:mahasiswa',
            'gelombang_id' => 'required',
        ], $messages);

        if (\DB::table('users')
            ->where('nisn', $request->nisn)
            ->where('gelombang_id', $request->gelombang_id)
            ->exists()) {
            return back()->withErrors(['nisn_gelombang' => 'Kombinasi NISN dan Gelombang sudah terdaftar!']);
        }

        $no_transaction = Transaction::latest()->first();

        $length = 8;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $password = $randomString;
        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => strtoupper($request->name),
                'nisn' => $request->nisn,
                'email' => $request->email,
                'roles' => 'MAHASISWA',
                'password' => Hash::make($password),
                'password_sementara' => $password,
                'gelombang_id' => $request->gelombang_id,
            ]);

            Mahasiswa::create([
                'user_id' => $user->id,
                'phone' => $request->phone,
                'tempat_lahir' => strtoupper($request->tempat_lahir),
                'tanggal_lahir' => $request->tanggal_lahir,
                'status' => 'DALAM PROSES',

            ]);

            $transaction = Transaction::create([
                'user_id' => $user->id,
                'no_transaksi' => $no_transaction != null ? $no_transaction->no_transaksi + 1 : 2022001,
                'briva' => $no_transaction != null ? $no_transaction->briva + 1 : 999999001,
                'nominal' => 300000,
                'status' => 'pending',
            ]);
            DB::commit();

            return view('pageSuccess', compact('transaction'));
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', $e->getMessage());
        }
    }

    public function changePhoto(Request $request)
    {

        $photo = $request->file('photo')->store('assets/photo', 'public');
        $user = User::findOrFail(Auth::user()->id);
        $user->update([
            'photo' => $photo,
        ]);

        return redirect()->route('dashboard.mahasiswa')->with('success', 'data berhasil disimpan');
    }
}
