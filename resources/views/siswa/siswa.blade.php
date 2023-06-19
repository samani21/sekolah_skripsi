@extends('layouts.sidebar')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-8">
                <form action="" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="cari" placeholder="Cari siswa" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-primary" type="submit" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i></button>
                      </div>
                </form>
            </div>
            <div class="col-4">
                <a href="tambah_siswa" class="btn btn-primary"><i class="fa-solid fa-plus"></i>Siswa</a>
            </div>
            <hr>
            <div>
                <table class="table table-secondary table-striped" id="no-more-tables">
                    <thead align="center">
                        <th scope="col">No</th>
                        <th scope="col">NIk</th>
                        <th scope="col">Nama</th>
                        <th scope="col">TTL</th>
                        <th scope="col">Agama</th>
                        <th scope="col">JK</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Aksi</th>
                    </thead>
                    <tbody>
                        @foreach ($siswa as $index=>$sis)
                            <tr>
                                <td data-title="No">{{ $index + $siswa->firstItem() }}</td>
                                <td data-title="NIK">{{$sis->nik}}</td>
                                <td data-title="Nama">{{$sis->nama}}</td>
                                <td data-title="TTL">{{$sis->tempat}}, {{date('d-m-Y', strtotime($sis->tgl))}}</td>
                                <td data-title="Agama">{{$sis->agama}}</td>
                                <td data-title="Jenis Kelamin">{{$sis->jk}}</td>
                                <td data-title="Alamat">{{$sis->alamat}}</td>
                                <td>
                                    <a href="edit_siswa/{{$sis->id}}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
                                    <a href="hapus_siswa/{{$sis->id}}" class="btn btn-danger" onclick="javascript: return confirm('Konfirmasi data akan dihapus');"><i class="fa-solid fa-trash"></i> Hapus</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $siswa->links() }}
            </div>
        </div>
	</div>
@endsection