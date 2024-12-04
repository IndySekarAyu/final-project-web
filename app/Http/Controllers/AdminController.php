<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Session\Session;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (empty(session('akuninternal'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }
        $jumlahsiswa = DB::table('siswa')->count();
        $jumlahkursus = DB::table('kursus')->count();
        $jumlahmateri = DB::table('materi')->count();
        $data = [
            'title' => 'Selamat Datang ' . session('akuninternal')->nama . ' Di Panel Web Kursus',
            'jumlahsiswa' => $jumlahsiswa,
            'jumlahkursus' => $jumlahkursus,
            'jumlahmateri' => $jumlahmateri,
        ];
        return view('admin/dashboard', $data);
    }

    public function akuninternaldaftar()
    {
        if (empty(session('akuninternal'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }
        $id = session('akuninternal')->idakuninternal;
        $akuninternal = DB::table('akuninternal')->where('idakuninternal', '!=', $id)->where('level', '!=', 'kursus')->get();
        $data = [
            'title' => 'Daftar Akun Internal',
            'akuninternal' => $akuninternal
        ];
        return view('admin/akuninternaldaftar', $data);
    }
    public function akuninternaltambah()
    {
        if (empty(session('akuninternal'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }
        $data = [
            'title' => 'Tambah akuninternal',
        ];
        return view('admin/akuninternaltambah', $data);
    }

    public function akuninternaltambahsimpan(Request $request)
    {
        if (empty(session('akuninternal'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }
        $nama = $request->input('nama');
        $email = $request->input('email');
        $password = $request->input('password');
        $level = 'Admin';
        DB::table('akuninternal')->insert([
            'nama' => $nama,
            'email' => $email,
            'password' => $password,
            'level' => $level,
            'status' => 'Aktif',
        ]);
        session()->flash('success', 'Berhasil menambahkan data!');
        return redirect('panel/akuninternaldaftar');
    }

    public function akuninternaledit($id)
    {
        if (empty(session('akuninternal'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }
        $row = DB::table('akuninternal')->where('idakuninternal', $id)->first();
        $data = [
            'title' => 'Edit akuninternal',
            'row' => $row,
        ];
        return view('admin/akuninternaledit', $data);
    }
    public function akuninternaleditsimpan(Request $request, $id)
    {
        if (empty(session('akuninternal'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }
        $nama = $request->input('nama');
        $email = $request->input('email');
        $password = $request->input('password');
        $data = [
            'nama' => $nama,
            'email' => $email,
            'password' => $password,
        ];
        DB::table('akuninternal')->where('idakuninternal', $id)->update($data);
        session()->flash('success', 'Data berhasil diedit!');
        return redirect('panel/akuninternaldaftar');
    }
    public function akuninternalhapus($id)
    {
        if (empty(session('akuninternal'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }
        DB::table('akuninternal')->where('idakuninternal', $id)->delete();
        session()->flash('success', 'Berhasil menghapus data!');
        return redirect('panel/akuninternaldaftar');
    }
    public function kursusdaftar()
    {
        if (empty(session('akuninternal'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }

        if (session('akuninternal')->level == 'Admin') {
            $kursus = DB::table('kursus')->join('guru', 'kursus.idguru', '=', 'guru.idguru')->get();
        } else {
            $kursus = DB::table('kursus')->join('guru', 'kursus.idguru', '=', 'guru.idguru')->where('guru.idakuninternal', session('akuninternal')->idakuninternal)->get();
        }
        $data = [
            'title' => 'Daftar kursus',
            'kursus' => $kursus,
        ];
        return view('admin/kursusdaftar', $data);
    }
    public function kursustambah()
    {
        if (empty(session('akuninternal'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }
        $guru = DB::table('guru')->join('akuninternal', 'akuninternal.idakuninternal', '=', 'guru.idakuninternal')->get();
        $data = [
            'title' => 'Tambah kursus',
            'guru' => $guru,
        ];
        return view('admin/kursustambah', $data);
    }

    public function kursustambahsimpan(Request $request)
    {
        if (empty(session('akuninternal'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }
        $nama = $request->input('namakursus');
        $deskripsi = $request->input('deskripsikursus');
        $tanggalawal = $request->input('tanggalawal');
        $tanggalakhir = $request->input('tanggalakhir');
        $idguru = $request->input('idguru');
        $simpankursus = [
            'namakursus' => $nama,
            'deskripsikursus' => $deskripsi,
            'tanggalawal' => $tanggalawal,
            'tanggalakhir' => $tanggalakhir,
            'idguru' => $idguru,
        ];
        DB::table('kursus')->insert($simpankursus);
        session()->flash('success', 'Berhasil menambahkan data!');
        return redirect('panel/kursusdaftar');
    }
    public function kursusedit($id)
    {
        if (empty(session('akuninternal'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }
        $row = DB::table('kursus')->where('idkursus', $id)->first();
        $guru = DB::table('guru')->join('akuninternal', 'akuninternal.idakuninternal', '=', 'guru.idakuninternal')->get();
        $data = [
            'title' => 'Edit kursus',
            'row' => $row,
            'guru' => $guru,
        ];
        return view('admin/kursusedit', $data);
    }
    public function kursuseditsimpan(Request $request, $id)
    {
        if (empty(session('akuninternal'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }
        $nama = $request->input('namakursus');
        $deskripsi = $request->input('deskripsikursus');
        $idguru = $request->input('idguru');
        $tanggalawal = $request->input('tanggalawal');
        $tanggalakhir = $request->input('tanggalakhir');
        $simpan = [
            'namakursus' => $nama,
            'deskripsikursus' => $deskripsi,
            'idguru' => $idguru,
            'tanggalawal' => $tanggalawal,
            'tanggalakhir' => $tanggalakhir,
        ];
        DB::table('kursus')->where('idkursus', $id)->update($simpan);
        session()->flash('success', 'Data berhasil diedit!');
        return redirect('panel/kursusdaftar');
    }
    public function kursushapus($id)
    {
        if (empty(session('akuninternal'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }
        DB::table('kursus')->where('idkursus', $id)->delete();
        session()->flash('success', 'Berhasil menghapus data!');
        return redirect('panel/kursusdaftar');
    }

    public function kursusdetail($id)
    {
        if (empty(session('akuninternal'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }
        $pendaftaran = DB::table('pendaftaran')
            ->join('kursus', 'pendaftaran.idkursus', '=', 'kursus.idkursus')
            ->join('guru', 'kursus.idguru', '=', 'guru.idguru')
            ->where('pendaftaran.idkursus', $id)->where('status', 'Diterima')
            ->get();
        $data = [
            'title' => 'Detail kursus',
            'pendaftaran' => $pendaftaran,
            'idkursus' => $id,
        ];
        return view('admin/kursusdetail', $data);
    }

    public function kursusdetailtambah($id)
    {
        // Periksa apakah pengguna telah login
        if (empty(session('akuninternal'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }

        // Ambil siswa yang tidak terdaftar di tabel pendaftaran dengan idkursus tertentu
        $siswa = DB::table('siswa')
            ->whereNotIn('idakuninternal', function ($query) use ($id) {
                $query->select('idakuninternal')
                    ->from('pendaftaran')
                    ->where('idkursus', $id);
            })
            ->get();

        // Siapkan data untuk dikirim ke view
        $data = [
            'title' => 'Tambah Kursus',
            'idkursus' => $id,
            'siswa' => $siswa,
        ];

        return view('admin/kursusdetailtambah', $data);
    }

    public function kursusdetailtambahsimpan(Request $request)
    {
        $idkursus = $request->input('idkursus');
        $idakuninternal = $request->input('idakuninternal');
        DB::table('pendaftaran')->insert([
            'idkursus' => $idkursus,
            'idakuninternal' => $idakuninternal,
            'status' => 'Diterima',
            'namalengkap' => $request->input('namasiswa'),
            'alamat' => $request->input('alamat'),
            'tempatlahir' => $request->input('tempatlahir'),
            'tanggallahir' => $request->input('tanggallahir'),
            'nohp' => $request->input('notelp'),
            'tanggalpendaftaran' => date('Y-m-d'),
        ]);

        return redirect('panel/kursusdetail/' . $idkursus);
    }

    public function kursusdetailhapus($id)
    {
        // Periksa apakah pengguna telah login
        if (empty(session('akuninternal'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }

        DB::table('pendaftaran')->where('idpendaftaran', $id)->delete();
        return back()->with('success', 'Berhasil menghapus data!');
    }


    public function materidaftar()
    {
        if (empty(session('akuninternal'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }
        $materi = DB::table('materi')
            ->join('kursus', 'materi.idkursus', '=', 'kursus.idkursus')
            ->join('akuninternal', 'materi.created_by', '=', 'akuninternal.idakuninternal')
            ->get();
        $data = [
            'title' => 'Daftar materi',
            'materi' => $materi,
        ];
        return view('admin/materidaftar', $data);
    }
    public function materitambah()
    {
        if (empty(session('akuninternal'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }
        $kursus = DB::table('kursus')->get();
        $data = [
            'title' => 'Tambah materi',
            'kursus' => $kursus,
        ];
        return view('admin/materitambah', $data);
    }

    public function materitambahsimpan(Request $request)
    {
        if (empty(session('akuninternal'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }
        $idkursus = $request->input('idkursus');
        $judul = $request->input('judul');
        $deskripsi = $request->input('deskripsi');

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName(); // Nama unik
            $file->move(public_path('file'), $filename);
        } else {
            $filename = null; // Set null jika tidak ada file yang diupload
        }

        $simpanmateri = [
            'idkursus' => $idkursus,
            'judul' => $judul,
            'deskripsi' => $deskripsi,
            'file' => $filename,
            'created_by' => session('akuninternal')->idakuninternal,
        ];
        DB::table('materi')->insert($simpanmateri);
        session()->flash('success', 'Berhasil menambahkan data!');
        return redirect('panel/materidaftar');
    }
    
    public function materiedit($id)
    {
        if (empty(session('akuninternal'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }
        $row = DB::table('materi')->where('idmateri', $id)->first();
        $kursus = DB::table('kursus')->get();

        $data = [
            'title' => 'Edit materi',
            'row' => $row,
            'kursus' => $kursus,
        ];
        return view('admin/materiedit', $data);
    }
    public function materieditsimpan(Request $request, $id)
    {
        if (empty(session('akuninternal'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }
        $idkursus = $request->input('idkursus');
        $judul = $request->input('judul');
        $deskripsi = $request->input('deskripsi');

        $simpan = [
            'idkursus' => $idkursus,
            'judul' => $judul,
            'deskripsi' => $deskripsi,
        ];

        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            $row = DB::table('materi')->where('idmateri', $id)->first();
            if ($row->file) {
                $path = public_path('file/' . $row->file);
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName(); // Nama unik
            $file->move(public_path('file'), $filename);
            $simpan['file'] = $filename;
        }
        DB::table('materi')->where('idmateri', $id)->update($simpan);
        session()->flash('success', 'Data berhasil diedit!');
        return redirect('panel/materidaftar');
    }
    public function materihapus($id)
    {
        if (empty(session('akuninternal'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }

        $materi = DB::table('materi')->where('idmateri', $id)->first();
        if ($materi->file) {
            $path = public_path('file/' . $materi->file);
            if (file_exists($path)) {
                unlink($path);
            }
        }

        DB::table('materi')->where('idmateri', $id)->delete();
        session()->flash('success', 'Berhasil menghapus data!');
        return redirect('panel/materidaftar');
    }
    public function profil()
    {
        if (empty(session('akuninternal'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }
        $id = session('akuninternal')->idakuninternal;
        if (session('akuninternal')->level == 'Admin') {
            $row = DB::table('akuninternal')
                ->where('idakuninternal', $id)
                ->first();
        } else {
            $row = DB::table('akuninternal')
                ->join('guru', 'guru.idakuninternal', 'akuninternal.idakuninternal')
                ->where('akuninternal.idakuninternal', $id)
                ->first();
        }
        $data = [
            'title' => 'Profil',
            'row' => $row,
        ];
        return view('admin/profil', $data);
    }
    public function profiledit()
    {
        if (empty(session('akuninternal'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }
        $id = session('akuninternal')->idakuninternal;
        if (session('akuninternal')->level == 'Admin') {
            $row = DB::table('akuninternal')
                ->where('idakuninternal', $id)
                ->first();
        } else {
            $row = DB::table('akuninternal')
                ->join('guru', 'guru.idakuninternal', 'akuninternal.idakuninternal')
                ->where('akuninternal.idakuninternal', $id)
                ->first();
        }
        $data = [
            'title' => 'Edit Profile',
            'row' => $row,
        ];
        return view('admin/profiledit', $data);
    }
    public function profileditsimpan(Request $request)
    {
        if (empty(session('akuninternal'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }

        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:akuninternal,email,' . session('akuninternal')->idakuninternal . ',idakuninternal',
            'password' => 'required',
            'jeniskelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required',
            'notelp' => 'required|numeric',
        ]);

        $id = session('akuninternal')->idakuninternal;
        $data = [
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];
        if (session('akuninternal')->level == 'Admin') {
            DB::table('akuninternal')->where('idakuninternal', $id)->update($data);
        } else {
            DB::table('guru')->where('idakuninternal', $id)->update([
                'namaguru' => $request->input('nama'),
                'jeniskelamin' => $request->input('jeniskelamin'),
                'alamat' => $request->input('alamat'),
                'notelp' => $request->input('notelp'),
            ]);
            DB::table('akuninternal')->where('idakuninternal', $id)->update($data);
        }
        session()->flash('success', 'Data berhasil diedit!');
        return redirect('panel/profil');
    }
    public function login()
    {
        if (empty(session('akuninternal'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }
        $data = [
            'title' => 'Login',
        ];
        return view('login', $data);
    }
    public function logincek(Request $request)
    {
        if (empty(session('akuninternal'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }
        $email = $request->input('email');
        $password = $request->input('password');
        $akun = DB::table('akuninternal')
            ->where('email', $email)
            ->where('password', $password)
            ->first();
        if ($akun) {
            session(['akuninternal' => $akun]);
            return redirect('panel/dashboard')->with('success', 'Login berhasil');
        } else {
            return redirect()->back()->with('success', 'Anda gagal login, Email atau password salah');
        }
    }
    public function logout()
    {
        session()->flush();
        return redirect('/loginakun');
    }
    public function siswadaftar()
    {
        if (empty(session('akuninternal'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }
        $siswa = DB::table('siswa')->get();
        $data = [
            'title' => 'Daftar Siswa',
            'siswa' => $siswa
        ];
        return view('admin/siswadaftar', $data);
    }
    public function siswatambah()
    {
        if (empty(session('akuninternal'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }
        $data = [
            'title' => 'Tambah Siswa',
        ];
        return view('admin/siswatambah', $data);
    }

    public function siswatambahsimpan(Request $request)
    {
        if (empty(session('akuninternal'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }
        $namasiswa = $request->input('namasiswa');
        $notelp = $request->input('notelp');
        $email = $request->input('email');
        $password = $request->input('password');

        $idakuninternal = DB::table('akuninternal')->insertGetId([
            'nama' => $namasiswa,
            'email' => $email,
            'password' => $password,
            'level' => 'Siswa',
            'status' => 'Aktif',
        ]);

        DB::table('siswa')->insert([
            'idakuninternal' => $idakuninternal,
            'namasiswa' => $namasiswa,
            'notelp' => $notelp,
            'email' => $email,
        ]);


        session()->flash('success', 'Berhasil menambahkan data!');
        return redirect('panel/siswadaftar');
    }

    public function siswaedit($id)
    {
        if (empty(session('akuninternal'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }
        $row = DB::table('siswa')->join('akuninternal', 'akuninternal.idakuninternal', '=', 'siswa.idakuninternal')->where('idsiswa', $id)->first();
        $data = [
            'title' => 'Edit Siswa',
            'row' => $row,
        ];
        return view('admin/siswaedit', $data);
    }
    public function siswaeditsimpan(Request $request, $id)
    {
        if (empty(session('akuninternal'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }
        $namasiswa = $request->input('namasiswa');
        $notelp = $request->input('notelp');
        $email = $request->input('email');
        $password = $request->input('password');
        $data = [
            'namasiswa' => $namasiswa,
            'notelp' => $notelp,
            'email' => $email,
        ];
        $siswa = DB::table('siswa')->where('idsiswa', $id)->first();
        DB::table('siswa')->where('idsiswa', $id)->update($data);
        DB::table('akuninternal')->where('idakuninternal', $siswa->idakuninternal)->update([
            'password' => $password,
            'email' => $email,
            'nama' => $namasiswa,
        ]);
        session()->flash('success', 'Data berhasil diedit!');
        return redirect('panel/siswadaftar');
    }
    public function siswahapus($id)
    {
        if (empty(session('akuninternal'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }
        $siswa = DB::table('siswa')->where('idsiswa', $id)->first();
        DB::table('siswa')->where('idsiswa', $id)->delete();
        DB::table('akuninternal')->where('idakuninternal', $siswa->idakuninternal)->delete();
        session()->flash('success', 'Berhasil menghapus data!');
        return redirect('panel/siswadaftar');
    }
    public function gurudaftar()
    {
        if (empty(session('akuninternal'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }
        $guru = DB::table('guru')->join('akuninternal', 'akuninternal.idakuninternal', '=', 'guru.idakuninternal')->get();
        $data = [
            'title' => 'Daftar guru',
            'guru' => $guru
        ];
        return view('admin/gurudaftar', $data);
    }
    public function gurutambah()
    {
        if (empty(session('akuninternal'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }
        $data = [
            'title' => 'Tambah guru',
        ];
        return view('admin/gurutambah', $data);
    }

    public function gurutambahsimpan(Request $request)
    {
        if (empty(session('akuninternal'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }
        $namaguru = $request->input('namaguru');
        $jeniskelamin = $request->input('jeniskelamin');
        $alamat = $request->input('alamat');
        $notelp = $request->input('notelp');
        $email = $request->input('email');
        $password = $request->input('password');

        $idakuninternal = DB::table('akuninternal')->insertGetId([
            'nama' => $namaguru,
            'email' => $email,
            'password' => $password,
            'level' => 'Guru',
            'status' => 'Aktif',
        ]);

        DB::table('guru')->insert([
            'idakuninternal' => $idakuninternal,
            'namaguru' => $namaguru,
            'jeniskelamin' => $jeniskelamin,
            'alamat' => $alamat,
            'notelp' => $notelp,
        ]);


        session()->flash('success', 'Berhasil menambahkan data!');
        return redirect('panel/gurudaftar');
    }

    public function guruedit($id)
    {
        if (empty(session('akuninternal'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }
        $row = DB::table('guru')->join('akuninternal', 'akuninternal.idakuninternal', '=', 'guru.idakuninternal')->where('idguru', $id)->first();
        $data = [
            'title' => 'Edit guru',
            'row' => $row,
        ];
        return view('admin/guruedit', $data);
    }
    public function gurueditsimpan(Request $request, $id)
    {
        if (empty(session('akuninternal'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }
        $namaguru = $request->input('namaguru');
        $jeniskelamin = $request->input('jeniskelamin');
        $alamat = $request->input('alamat');
        $notelp = $request->input('notelp');
        $email = $request->input('email');
        $password = $request->input('password');
        $data = [
            'namaguru' => $namaguru,
            'jeniskelamin' => $jeniskelamin,
            'alamat' => $alamat,
            'notelp' => $notelp,
        ];
        $guru = DB::table('guru')->where('idguru', $id)->first();
        DB::table('guru')->where('idguru', $id)->update($data);
        DB::table('akuninternal')->where('idakuninternal', $guru->idakuninternal)->update([
            'password' => $password,
            'email' => $email,
            'nama' => $namaguru,
        ]);
        session()->flash('success', 'Data berhasil diedit!');
        return redirect('panel/gurudaftar');
    }
    public function guruhapus($id)
    {
        if (empty(session('akuninternal'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }
        $guru = DB::table('guru')->where('idguru', $id)->first();
        DB::table('guru')->where('idguru', $id)->delete();
        DB::table('akuninternal')->where('idakuninternal', $guru->idakuninternal)->delete();
        session()->flash('success', 'Berhasil menghapus data!');
        return redirect('panel/gurudaftar');
    }
    public function pendaftarankursus()
    {
        if (empty(session('akuninternal'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }
        $data['pendaftaran'] = DB::table('pendaftaran')
            ->join('kursus', 'pendaftaran.idkursus', '=', 'kursus.idkursus')
            ->join('guru', 'kursus.idguru', '=', 'guru.idguru')
            ->orderBy('idpendaftaran', 'desc')
            ->get();
        return view('admin/pendaftarankursus', $data);
    }

    public function pendaftarankursusdetail($id)
    {
        if (empty(session('akuninternal'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }
        $pendaftaran = DB::table('pendaftaran')
            ->join('kursus', 'pendaftaran.idkursus', '=', 'kursus.idkursus')
            ->join('guru', 'kursus.idguru', '=', 'guru.idguru')
            ->where('pendaftaran.idpendaftaran', $id)
            ->first();
        $data = [
            'title' => 'Detail pendaftaran kursus',
            'pendaftaran' => $pendaftaran,
        ];
        return view('admin/pendaftarankursusdetail', $data);
    }

    public function pendaftarankursusupdate(Request $request, $id)
    {
        if (empty(session('akuninternal'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }
        $status = $request->input('status');
        DB::table('pendaftaran')->where('idpendaftaran', $id)->update([
            'status' => $status,
        ]);
        session()->flash('success', 'Data berhasil diedit!');
        return redirect('panel/pendaftarankursus');
    }
}
