@extends('layouts.sidebar')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-8">
                <form action="{{route('guru/guru')}}" method="get">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="cari" placeholder="Cari Guru" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-primary" type="submit" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i></button>
                      </div>
                </form>
            </div>
            {{-- <div class="col-4">
                <a href="tambah_siswa" class="btn btn-primary"><i class="fa-solid fa-plus"></i>Siswa</a>
            </div> --}}
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
                        <th scope="col">status</th>
                        @if(Auth::user()->level =='Tata_usaha')
                            <th scope="col">Aksi</th>
                        @endif
                    </thead>
                    <tbody>
                        @foreach ($guru as $index=>$gur)
                            <tr>
                                <td data-title="No">{{ $index + $guru->firstItem() }}</td>
                                <td data-title="NIK">{{$gur->nik}}</td>
                                <td data-title="Nama">{{$gur->nama}}</td>
                                <td data-title="TTL">{{$gur->tempat}}, {{date('d-m-Y', strtotime($gur->tgl))}}</td>
                                <td data-title="Agama">{{$gur->agama}}</td>
                                <td data-title="Jenis Kelamin">{{$gur->jk}}</td>
                                <td data-title="Alamat">{{$gur->alamat}}</td>
                                <td data-title="Status"><?php
                                    if ($gur->level == "Tata_usaha") {
                                        echo "Tata Usaha";
                                    }else {
                                        echo $gur->level;
                                    }
                                ?></td>
                                @if(Auth::user()->level =='Tata_usaha')
                                    <td>
                                        <a href="/profil/edit_guru/{{$gur->id}}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
                                        <a href="hapus_guru/{{$gur->id}}&{{$gur->id_user}}" class="btn btn-danger" onclick="javascript: return confirm('Konfirmasi data akan dihapus');"><i class="fa-solid fa-trash"></i> Hapus</a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $guru->links() }}
            </div>
        </div>
	</div>
@endsection