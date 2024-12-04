@extends('admin/layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-12">
                    <h3 class="mb-3">{{ $title }}</h3>
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="{{ url('panel/kursusdetailtambahsimpan') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="idkursus" value="{{ $idkursus }}">
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Nama Siswa</label>
                                    <div class="col-sm-12 col-md-10">
                                        <select name="idakuninternal" id="idakuninternal" class="form-control">
                                            <option value="" selected disabled>Pilih Siswa</option>
                                            @foreach ($siswa as $row)
                                                <option value="{{ $row->idakuninternal }}" data-alamat="{{ $row->alamat }}"
                                                    data-tempatlahir="{{ $row->tempatlahir }}"
                                                    data-tanggallahir="{{ $row->tanggallahir }}"
                                                    data-notelp="{{ $row->notelp }}"
                                                    data-namasiswa="{{ $row->namasiswa }}">
                                                    {{ $row->namasiswa }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div id="siswa-detail" style="display: none;">
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label">Alamat</label>
                                        <div class="col-sm-12 col-md-10">
                                            <input type="text" id="alamat" name="alamat" class="form-control"
                                                readonly>
                                        </div>
                                    </div>
                                    <input type="hidden" name="namasiswa" id="namasiswa">
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label">Tempat Lahir</label>
                                        <div class="col-sm-12 col-md-10">
                                            <input type="text" id="tempatlahir" name="tempatlahir" class="form-control"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label">Tanggal Lahir</label>
                                        <div class="col-sm-12 col-md-10">
                                            <input type="text" id="tanggallahir" name="tanggallahir" class="form-control"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label">No HP</label>
                                        <div class="col-sm-12 col-md-10">
                                            <input type="text" id="notelp" name="notelp" class="form-control"
                                                readonly>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success pull-right" name="simpan">Simpan</button>
                                <br><br>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('idakuninternal').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];

            if (selectedOption.value) {
                document.getElementById('alamat').value = selectedOption.getAttribute('data-alamat');
                document.getElementById('tempatlahir').value = selectedOption.getAttribute('data-tempatlahir');
                document.getElementById('tanggallahir').value = selectedOption.getAttribute('data-tanggallahir');
                document.getElementById('notelp').value = selectedOption.getAttribute('data-notelp');
                document.getElementById('namasiswa').value = selectedOption.getAttribute('data-namasiswa');

                document.getElementById('siswa-detail').style.display = 'block';
            } else {
                document.getElementById('siswa-detail').style.display = 'none';
            }
        });
    </script>
@endsection
