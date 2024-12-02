<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alamat;
use App\Models\Attachments;
use App\Models\Biodata;
use App\Models\Gelombang;
use App\Models\Lulusan;
use App\Models\Mahasiswa;
use App\Models\PemilikKartu;
use App\Models\Penerimaan;
use App\Models\Persyaratan;
use App\Models\Rencana;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class FormulirController extends Controller
{
    public function data()
    {
        $kelas = Gelombang::with('kelas')->find(Auth::user()->gelombang_id)->kelas;
        $jurusan = Gelombang::with('jurusan')->find(Auth::user()->gelombang_id)->jurusan;
        $penerimaan = Gelombang::with('penerimaan')->find(Auth::user()->gelombang_id)->penerimaan;

        $mahasiswa = Mahasiswa::with(['jurusan'])->where('user_id', Auth::user()->id)->first();
        $persyaratan = Persyaratan::whereHas('penerimaan', function ($query) use ($mahasiswa) {
            $query->where('penerimaan_id', $mahasiswa->penerimaan_id);
        })->get();

        $biodata = Biodata::where('user_id', Auth::user()->id)->first();
        $attachment = Attachments::with(['penerimaan'])->where('user_id', Auth::user()->id)->first();

        $mhs = Mahasiswa::where('user_id', Auth::user()->id)->first();

        return view('mahasiswa.data', compact('kelas', 'penerimaan', 'persyaratan', 'biodata', 'jurusan', 'mahasiswa', 'attachment', 'mhs'));
    }

    public function edit($id)
    {
        $kelas = Gelombang::with('kelas')->find(Auth::user()->gelombang_id)->kelas;
        $jurusan = Gelombang::with('jurusan')->find(Auth::user()->gelombang_id)->jurusan;
        $penerimaan = Gelombang::with('penerimaan')->find(Auth::user()->gelombang_id)->penerimaan;

        $mahasiswa = Mahasiswa::with(['jurusan'])->where('user_id', Auth::user()->id)->first();
        $persyaratan = Persyaratan::whereHas('penerimaan', function ($query) use ($mahasiswa) {
            $query->where('penerimaan_id', $mahasiswa->penerimaan_id);
        })->get();

        $biodata = Biodata::where('user_id', Auth::user()->id)->first();
        $attachment = Attachments::with(['penerimaan'])->where('user_id', Auth::user()->id)->where('id', $id)->first();

        return view('mahasiswa.data-edit', compact('kelas', 'penerimaan', 'persyaratan', 'biodata', 'jurusan', 'mahasiswa', 'attachment'));
    }

    public function updateData(Request $request)
    {
        $penerimaan = Penerimaan::with('persyaratan')->findOrFail($request->penerimaan_id);
        $mahasiswa = Mahasiswa::with(['jurusan'])->where('user_id', Auth::user()->id)->first();

        $rules = [];
        $data = [];

        // dd($penerimaan->persyaratan->toArray(), $request->all());
        foreach ($penerimaan->persyaratan as $persyaratan) {
            $fieldName = $persyaratan->slug;
            $rules[$fieldName] = 'mimes:pdf,png,jpg,jpeg|max:3072|required';

            // dd($fieldName, $rules[$fieldName]);
            if ($request->hasFile($fieldName)) {
                // dd($request->hasFile($fieldName), $request->file($fieldName));
                $data[$fieldName] = $request->file($fieldName)->store('assets/store', 'public');
            }
        }

        $validatedData = $request->validate($rules);

        $mahasiswa->update([
            'jalur' => $request->jalur,
            'jurusan_id' => $request->jurusan_id,
            'penerimaan_id' => $request->penerimaan_id,
        ]);

        // dd($data, $validatedData, $request->all(), $mahasiswa->toArray());

        $data['penerimaan_id'] = $request->penerimaan_id;
        $data['jurusan_dua'] = $request->jurusan_dua;

        Attachments::updateOrCreate([
            'user_id' => Auth::user()->id,
        ], $data);

        Biodata::updateOrCreate([
            'user_id' => Auth::user()->id,
        ], $data);

        return back()->with('success', 'berhasil disimpan');
    }

    public function biodata()
    {
        $biodata = Biodata::where('user_id', Auth::user()->id)->first();
        $mahasiswa = Mahasiswa::where('user_id', Auth::user()->id)->first();
        $alamat = Alamat::where('user_id', Auth::user()->id)->first();
        $lulusan = Lulusan::where('user_id', Auth::user()->id)->first();
        $rencana = Rencana::where('user_id', Auth::user()->id)->first();
        $pemilikkartu = PemilikKartu::where('user_id', Auth::user()->id)->first();

        return view('mahasiswa.biodata', compact('biodata', 'alamat', 'lulusan', 'rencana', 'pemilikkartu', 'mahasiswa'));
    }

    public function biostore(Request $request)
    {
        $data = $request->all();

        $data['user_id'] = Auth::user()->id;

        if ($request->nik != null) {
            $data['nik'] = $request->input('nik');
            Biodata::updateOrCreate(
                [
                    'user_id' => $data['user_id'],
                ],
                $data
            );
        } elseif ($request->kabupaten != null) {
            Alamat::updateOrCreate(
                [
                    'user_id' => $data['user_id'],
                ],
                $data
            );
        } elseif ($request->nisn != null) {
            Lulusan::updateOrCreate(
                [
                    'user_id' => $data['user_id'],
                ],
                $data
            );
        } elseif ($request->rencana_tinggal != null) {
            Rencana::updateOrCreate(
                [
                    'user_id' => $data['user_id'],
                ],
                $data
            );
        } elseif ($request->noKK != null) {
            $data['noKK'] = $request->input('noKK');
            $data['nama_kk'] = $request->input('nama_kk');
            if ($request->kip != null) {
                $data['kip'] = $request->input('kip');
            }
            if ($request->kks != null) {
                $data['kks'] = $request->input('kks');
            }
            if ($request->pkh != null) {
                $data['pkh'] = $request->input('pkh');
            }
            PemilikKartu::updateOrCreate(
                [
                    'user_id' => $data['user_id'],
                ],
                $data
            );
        } elseif ($request->pemberi_rekomendasi != null) {
            Biodata::updateOrCreate(
                [
                    'user_id' => $data['user_id'],
                ],
                $data
            );
        } else {
            return false;
        }

        return redirect()->route('biodata.index')->with('success', 'data berhasil disimpan');
    }

    public function uploads()
    {
        return view('mahasiswa.uploads');
    }

    public function cetakPdf()
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::user()->id)->first();
        // $attachment = Attachments::with(['penerimaan'])->where('user_id', Auth::user()->id)->first();
        $attachment = Attachments::with(['penerimaan'])
            ->where('user_id', Auth::user()->id)
            ->whereNotNull('pas_poto')
            ->first();

        return view('mahasiswa.cetakKartu', compact('attachment', 'mahasiswa'));
    }

    public function PrintPdf()
    {
        $user = User::with('mahasiswa', 'transaksi')->findOrFail(Auth::user()->id);
        $mahasiswa = Mahasiswa::where('user_id', Auth::user()->id)->first();
        $filename = Auth::user()->nisn.'_'.Auth::user()->name.'.pdf';
        $mahasiswa->update([
            'status' => 'BERKAS LENGKAP',
        ]);
        // return $user;
        $pdf = PDF::loadview('pdf.cetakKartuPdf', compact('user'));

        return $pdf->download($filename);
    }

    public function Profile()
    {
        $profile = Auth::user();

        return view('mahasiswa.profile', compact('profile'));
    }

    public function UpdateProfile(Request $request, $id)
    {
        $user = User::findOrFail($id);
        // return $request->all();
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'confirmed',
        ]);

        $mahasiswa = Mahasiswa::where('user_id', $id)->first();
        if ($request->input('password') == '') {
            $user->update([
                'name' => strtoupper($request->name),
                'nisn' => $request->nisn,
                'email' => $request->email,
            ]);
        } else {

            $user->update([
                'name' => strtoupper($request->input('name')),
                'email' => $request->input('email'),
                'nisn' => $request->nisn,
                'password' => bcrypt($request->input('password')),
                'password_sementara' => $request->input('password'),
            ]);
        }

        $mahasiswa->update([
            'phone' => $request->phone,
            'tempat_lahir' => strtoupper($request->tempat_lahir),
            'tanggal_lahir' => $request->tanggal_lahir,
            'status' => $user->mahasiswa->status,
        ]);

        return redirect()->route('dashboard.mahasiswa')->with('success', 'data berhasil disimpan');
    }
}
