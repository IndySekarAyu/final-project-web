<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Session\Session;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index()
    {
        $kursus = DB::table('kursus')
            ->join('pendaftaran', 'kursus.idkursus', '=', 'pendaftaran.idkursus')
            ->select('kursus.idkursus', 'kursus.namakursus', DB::raw('COUNT(pendaftaran.idpendaftaran) as total_peserta'))
            ->groupBy('kursus.idkursus', 'kursus.namakursus')
            ->orderByDesc('total_peserta')
            ->limit(5)
            ->get();

        $data = [
            'title' => 'Beranda',
            'kursus' => $kursus,
        ];

        return view('beranda', $data);
    }
    public function daftar()
    {
        return view('register');
    }

    public function daftarsimpan(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:akuninternal,email',
            'password' => 'required|confirmed',
            'notelp' => 'required|numeric',
            'alamat' => 'required',
            'tempatlahir' => 'required',
            'tanggallahir' => 'required',
        ]);

        $idakuninternal = DB::table('akuninternal')->insertGetId([
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'level' => 'Siswa',
            'status' => 'Aktif',
        ]);

        DB::table('siswa')->insert([
            'idakuninternal' => $idakuninternal,
            'namasiswa' => $request->input('nama'),
            'notelp' => $request->input('notelp'),
            'email' => $request->input('email'),
            'alamat' => $request->alamat,
            'tempatlahir' => $request->tempatlahir,
            'tanggallahir' => $request->tanggallahir,
        ]);

        return redirect('loginakun')->with('success', 'Berhasil mendaftar, silahkan login dengan akun anda');
    }
    public function login()
    {
        $data = [
            'title' => 'Login',
        ];
        return view('login', $data);
    }
    public function logincek(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $akun = DB::table('akuninternal')
            ->where('email', $email)
            ->where('password', $password)
            ->first();
        if ($akun) {
            session(['akuninternal' => $akun]);
            if ($akun->level == 'Admin' || $akun->level == 'Guru') {
                return redirect('panel/dashboard')->with('success', 'Login Berhasil');
            } else {
                return redirect('/')->with('success', 'Login Berhasil');
            }
        } else {
            return redirect()->back()->with('error', 'Anda gagal login, Email atau password salah');
        }
    }

    public function logout()
    {
        session()->flush();
        return redirect('/loginakun');
    }
    public function kursusdaftar()
    {
        $kursus = DB::table('kursus')
            ->join('guru', 'kursus.idguru', '=', 'guru.idguru')
            ->orderBy('idkursus', 'desc')
            ->paginate(6);
        $hitung = DB::table('kursus')
            ->join('guru', 'kursus.idguru', '=', 'guru.idguru')
            ->orderBy('idkursus', 'desc')
            ->count();
        $data = [
            'title' => 'Daftar kursus',
            'kursus' => $kursus,
            'keyword' => '',
            'hitung' => $hitung,
            'idkursus' => '',
        ];
        return view('kursusdaftar', $data);
    }
    public function kursusdaftarcari(Request $request)
    {

        $keyword = $request->input('keyword');
        $kursus = DB::table('kursus')->get();

        $kursus = DB::table('kursus')
            ->join('guru', 'kursus.idguru', '=', 'guru.idguru')
            ->where('namakursus', 'like', '%' . $keyword . '%')
            ->orderBy('idkursus', 'desc')
            ->paginate(6);
        $hitung = DB::table('kursus')
            ->join('guru', 'kursus.idguru', '=', 'guru.idguru')
            ->where('namakursus', 'like', '%' . $keyword . '%')
            ->orderBy('idkursus', 'desc')
            ->count();

        $data = [
            'title' => 'Hasil Pencarian ' . $keyword,
            'kursus' => $kursus,
            'keyword' => $keyword,
            'hitung' => $hitung,
        ];
        return view('kursusdaftar', $data);
    }
    public function kursusdetail($id)
    {
        $row = DB::table('kursus')
            ->join('guru', 'kursus.idguru', '=', 'guru.idguru')
            ->where('kursus.idkursus', $id)
            ->orderBy('idkursus', 'desc')->first();
        $materi = DB::table('materi')
            ->where('materi.idkursus', $id)
            ->orderBy('idmateri', 'desc')
            ->get();
        $data = [
            'title' => 'Detail kursus',
            'row' => $row,
            'materi' => $materi,
        ];

        if (session('akuninternal')) {
            $data['pendaftaran'] = DB::table('pendaftaran')
                ->where('pendaftaran.idkursus', $id)
                ->where('pendaftaran.idakuninternal', session('akuninternal')->idakuninternal)
                ->count();
        }
        return view('kursusdetail', $data);
    }

    public function pendaftarankursus($id)
    {
        if (!session('akuninternal')) {
            return redirect('/loginakun')->with('error', 'Harap login terlebih dahulu');
        }
        $data['kursus'] = DB::table('kursus')
            ->join('guru', 'kursus.idguru', '=', 'guru.idguru')
            ->where('idkursus', $id)
            ->first();
        return view('pendaftarankursus', $data);
    }

    public function prosespendaftarankursus(Request $request)
    {
        $idkursus = $request->input('idkursus');
        $idakuninternal = session('akuninternal')->idakuninternal;
        $data = [
            'idkursus' => $idkursus,
            'idakuninternal' => $idakuninternal,
            'namalengkap' => $request->input('namalengkap'),
            'tempatlahir' => $request->input('tempatlahir'),
            'tanggallahir' => $request->input('tanggallahir'),
            'alamat' => $request->input('alamat'),
            'nohp' => $request->input('nohp'),
            'tanggalpendaftaran' => date('Y-m-d'),
            'status' => 'Menunggu Konfirmasi Admin',
        ];
        DB::table('pendaftaran')->insert($data);
        return back()->with('success', 'Berhasil mendaftar kursus');
    }

    public function riwayatpendaftaran()
    {
        if (!session('akuninternal')) {
            return redirect('/loginakun');
        }
        $data['pendaftaran'] = DB::table('pendaftaran')
            ->join('kursus', 'pendaftaran.idkursus', '=', 'kursus.idkursus')
            ->join('guru', 'kursus.idguru', '=', 'guru.idguru')
            ->where('pendaftaran.idakuninternal', session('akuninternal')->idakuninternal)
            ->orderBy('idpendaftaran', 'desc')
            ->paginate(6);
        return view('riwayatpendaftaran', $data);
    }

    public function materidetail($id)
    {
        $data['materi'] = DB::table('materi')
            ->join('kursus', 'materi.idkursus', '=', 'kursus.idkursus')
            ->join('guru', 'kursus.idguru', '=', 'guru.idguru')
            ->where('materi.idmateri', $id)
            ->first();
        $data['progress_materi'] = DB::table('materi')
            ->leftjoin('progress_materi', 'materi.idmateri', '=', 'progress_materi.idmateri')
            ->where('materi.idmateri', $id)
            ->where('progress_materi.idakuninternal', session('akuninternal')->idakuninternal)
            ->first();
        return view('materidetail', $data);
    }

    public function updatemateristatus(Request $request, $id)
    {
        // Update or Insert
        DB::table('progress_materi')->updateOrInsert(
            [
                'idmateri' => $id, // Kondisi pencarian berdasarkan idmateri
                'idakuninternal' => session('akuninternal')->idakuninternal, // Kondisi pencarian berdasarkan idakuninternal
            ],
            [
                'status' => $request->input('status'), // Data yang akan diupdate atau dimasukkan
            ]
        );
        return back()->with('success', 'Status materi berhasil diperbarui');
    }

    public function markasdone($id)
    {
        DB::table('progress_materi')
            ->where('idmateri', $id)
            ->where('idakuninternal', session('akuninternal')->idakuninternal)
            ->update([
                'markasdone' => 'Selesai',
            ]);
        return back()->with('success', 'Status materi berhasil diperbarui');
    }

    public function profile()
    {
        $data['profile'] = DB::table('akuninternal')
            ->join('siswa', 'akuninternal.idakuninternal', '=', 'siswa.idakuninternal')
            ->where('akuninternal.idakuninternal', session('akuninternal')->idakuninternal)
            ->first();
        return view('profile', $data);
    }

    public function profileupdate(Request $request)
    {
        $idakuninternal = session('akuninternal')->idakuninternal;

        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:akuninternal,email,' . $idakuninternal . ',idakuninternal',
            'notelp' => 'required|numeric',
            'alamat' => 'required',
            'tempatlahir' => 'required',
            'tanggallahir' => 'required',
        ]);

        $data = [
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
        ];
        if ($request->password != '') {
            $request->validate([
                'password' => 'required|confirmed',
            ]);
            $data['password'] = $request->password;
        }
        DB::table('akuninternal')->where('idakuninternal', $idakuninternal)->update($data);
        DB::table('siswa')->where('idakuninternal', $idakuninternal)->update([
            'namasiswa' => $request->input('nama'),
            'notelp' => $request->input('notelp'),
            'alamat' => $request->alamat,
            'tempatlahir' => $request->tempatlahir,
            'tanggallahir' => $request->tanggallahir,
            'email' => $request->email,
        ]);
        return back()->with('success', 'Profile berhasil diperbarui');
    }
}
