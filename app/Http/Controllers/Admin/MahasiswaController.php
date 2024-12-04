<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Gelombang;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class MahasiswaController extends Controller
{
    // public function index()
    // {
    //     if (request()->ajax()) {
    //         $mahasiswa = User::with([
    //             'transaksi:id,user_id,briva',
    //             'mahasiswa:id,user_id,phone,status',
    //             // 'biodata',
    //             'gelombang:id,nama',
    //             'lulusan:id,user_id,asal_sekolah',
    //         ])->where('roles', 'MAHASISWA')
    //             ->latest('created_at')
    //             ->select(['id', 'name', 'nisn', 'password_sementara', 'created_at', 'gelombang_id'])
    //             ->get();

    //         return DataTables::of($mahasiswa)
    //             ->addIndexColumn()
    //             ->addColumn('gelombang', fn ($siswa) => $siswa->gelombang->nama ?? '-')
    //             ->addColumn('lulusan', fn ($siswa) => $siswa->lulusan->asal_sekolah ?? '-')
    //             ->addColumn('briva', fn ($siswa) => $siswa->transaksi->briva ?? '-')
    //             ->addColumn('created', fn ($siswa) => $siswa->created_at->format('d-m-Y'))
    // ->addColumn('action', function ($siswa) {
    //     $edit = '<a href="'.route('admin.mahasiswa.edit', $siswa->id).'" class="edit btn btn-warning btn-sm">Edit</a>';
    //     $detail = '<a href="'.route('admin.mahasiswa.show', $siswa->id).'" class="btn btn-info btn-sm">Detail</a>';
    //     $delete = '<a href="javascript:void(0)" onClick="Delete(this.id)" id="'.$siswa->id.'" class="bayar btn btn-danger btn-sm">Hapus</a>';
    //     $pay = $siswa->transaksi ? '<a href="javascript:void(0)" onClick="Bayar(this.id)" id="'.$siswa->transaksi->id.'" class="bayar btn btn-info btn-sm">Bayar</a>' : '';

    //     $whatsappLink = "https://wa.me/{$siswa->mahasiswa->phone}?text=SELAMAT%20PEMBAYARAN%20PENDAFTARAN%20ANDA%20TELAH%20KAMI%20TERIMA.%0ATahap%20selanjutnya%20adalah%20LOGIN%20melalui%20alamat%20https://regpmb.stkippacitan.ac.id/login%20.%0A-%20Username%20:%20{$siswa->nisn}%0A-%20Password%20:%20{$siswa->password_sementara}%0ASilahkan%20unggah%20data%20dan%20berkas%20pendaftaranmu%20segera%20untuk%20bisa%20mengikuti%20tahapan%20seleksi%20selanjutnya.%20Terima%20kasih";
    //     $whatsapp = '<a href="'.$whatsappLink.'" target="_blank" class="btn btn-success btn-sm">Whatsapp</a>';

    //     return $siswa->mahasiswa->status === 'DALAM PROSES'
    //         ? $edit.$detail.$delete.$pay.$whatsapp
    //         : $edit.$detail.$delete.$whatsapp;
    // })
    // ->rawColumns(['action'])
    // //             ->make(true);
    //     }

    //     return view('admin.mahasiswa.index', [
    //         'jurusans' => Jurusan::get(),
    //     ]);
    // }

    public function index(Request $request)
    {
        $jurusanId = $request->input('jurusan_id');
        $gelombangId = $request->input('gelombang_id');
        $search = $request->input('search');

        $mahasiswa = User::with([
            'transaksi:id,user_id,briva',
            'mahasiswa:id,user_id,jurusan_id,phone,status',
            // 'biodata',
            'gelombang:id,nama',
            'lulusan:id,user_id,asal_sekolah',
        ])
            ->when($gelombangId, function ($query) use ($gelombangId) {
                return $query->where('gelombang_id', $gelombangId);
            })
            ->when($jurusanId, function ($query) use ($jurusanId) {
                return $query->whereHas('mahasiswa', function ($q) use ($jurusanId) {
                    return $q->where('jurusan_id', $jurusanId);
                });
            })
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%")
                        ->orWhereHas('mahasiswa', function ($q) use ($search) {
                            $q->where('phone', 'like', "%$search%");
                        })
                        ->orWhereHas('lulusan', function ($q) use ($search) {
                            $q->where('asal_sekolah', 'like', "%$search%");
                        });
                });
            })
            ->where('roles', 'MAHASISWA')
            ->latest('created_at')
            ->select(['id', 'name', 'nisn', 'password_sementara', 'created_at', 'gelombang_id'])
            ->paginate(15);

        return view('admin.mahasiswa.index_new', [
            'jurusans' => Jurusan::get(),
            'gelombangs' => Gelombang::get(),
            'mahasiswa' => $mahasiswa,
        ]);
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

            $gelombang = Gelombang::find($request->gelombang_id);
            $currentYear = now()->year;
            $baseTransactionNumber = $currentYear * 1000000; // 2024 becomes 2024000000

            $latestTransaction = Transaction::where('no_transaksi', 'LIKE', "{$currentYear}%")
                ->orderBy('no_transaksi', 'desc')
                ->first();

            $no_transaksi = $latestTransaction ? $latestTransaction->no_transaksi + 1 : $baseTransactionNumber + 1;

            $baseBrivaNumber = 999999000; // Base BRIVA starting number
            $latestBriva = Transaction::latest()->first();

            $briva = $latestBriva ? $latestBriva->briva + 1 : $baseBrivaNumber + 1;

            Transaction::create([
                'user_id' => $user->id,
                'no_transaksi' => $no_transaksi,
                'briva' => $briva,
                'nominal' => $gelombang->nominal,
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
        $currentTime = Carbon::now();

        $announcements = Announcement::where('date_start', '<=', $currentTime)
            ->where('date_end', '>=', $currentTime)
            ->latest()
            ->get();

        return view('mahasiswa.dashboard', compact('mahasiswa', 'announcements'));
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
            ->exists()
        ) {
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

            $gelombang = Gelombang::find($request->gelombang_id);
            $currentYear = now()->year;
            $baseTransactionNumber = $currentYear * 1000000; // 2024 becomes 2024000000

            $latestTransaction = Transaction::where('no_transaksi', 'LIKE', "{$currentYear}%")
                ->orderBy('no_transaksi', 'desc')
                ->first();

            $no_transaksi = $latestTransaction ? $latestTransaction->no_transaksi + 1 : $baseTransactionNumber + 1;

            $baseBrivaNumber = 999999000; // Base BRIVA starting number
            $latestBriva = Transaction::latest()->first();

            $briva = $latestBriva ? $latestBriva->briva + 1 : $baseBrivaNumber + 1;

            Transaction::create([
                'user_id' => $user->id,
                'no_transaksi' => $no_transaksi,
                'briva' => $briva,
                'nominal' => $gelombang->nominal,
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
