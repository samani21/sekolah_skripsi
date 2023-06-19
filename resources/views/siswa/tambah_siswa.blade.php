@extends('layouts.sidebar')

@section('content')

    <div class="container">
        <form action="{{route('siswa.store')}}" method="POST">
            @csrf
            <div>
                <label for="">Nik</label>
                <input class="form-control" type="text" name="nik" placeholder="Masukkan NIK" aria-label="default input example" autofocus required>
            </div>
            <div>
                <label for="">Nama</label>
                <input class="form-control" type="text" name="nama" placeholder="Masukkan Nama" aria-label="default input example" required>
            </div>
            <div>
                <label for="">Tempat Tanggal Lahir</label>
                <div class="row g-2">
                    <div class="col-6">
                        <input class="form-control" type="text" name="tempat" placeholder="Masukkan Tempat Lahir" aria-label="default input example" required>
                    </div>
                    <div class="col-6">
                        <input class="form-control" type="date" name="tgl" placeholder="Masukkan Tempat Lahir" aria-label="default input example" required>
                    </div>
                </div>
            </div>
            <div>
                <label for="">Agama</label>
                <select class="form-select" name="agama" aria-label="Default select example" required>
                    <option selected>--Pilih</option>
                    <option value="Islam">Islam</option>
                    <option value="Protestan">Protestan</option>
                    <option value="Katolik">Katolik</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Buddha">Buddha</option>
                    <option value="Khonghucu">Khonghucu</option>
                  </select>
            </div>
            <div>
                <label for="">Jenis Kelamin</label>
                <select class="form-select" name="jk" aria-label="Default select example" required>
                    <option selected required>--Pilih</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                  </select>
            </div>
            <div>
                <label for="">Alamat</label>
                <input class="form-control" type="text" name="alamat" placeholder="Masukkan alamat" aria-label="default input example" required>
            </div>
            <hr>
            <button type="submit" class="btn btn-success">Simpan</button>
            <button type="reset" class="btn btn-danger">Reset</button>
        </form>
	</div>
@endsection