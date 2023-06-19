@extends('layouts.sidebar')

@section('content')

    <div class="container">
        <h3 align="center">PROFIL GURU</h3>
        <hr>
        @foreach ( $guru as $g )
       <div align="right">
        <a href="/profil/edit_guru/{{$g->id}}" class="btn btn-warning">Edit</a>
       </div>
        <br>
        <table class="table table-success table-striped" >
            <tr>
                <th>
                    NIK :
                </th> 
                <td>
                    {{$g->nik}}
                </td>
            </tr>
            <tr>
                <th>
                    Nama :
                </th> 
                <td>
                    {{$g->nama}}
                </td>
            </tr>
            <tr>
                <th>
                    TTL :
                </th> 
                <td>
                    {{$g->tempat}}, {{$g->tgl}}
                </td>
            </tr>
            <tr>
                <th>
                    Agama :
                </th> 
                <td>
                    {{$g->agama}}
                </td>
            </tr>
            <tr>
                <th>
                    Jenis Kelamin :
                </th> 
                <td>
                    {{$g->jk}}
                </td>
            </tr>
            <tr>
                <th>
                    Alamat :
                </th> 
                <td>
                    {{$g->alamat}}
                </td>
            </tr>
            <tr>
                <th>
                    Status :
                </th> 
                <td>
                    <?php
                        if ($g->level == "Tata_usaha") {
                                echo "Tata Usaha";
                        }else {
                                echo $g->level;
                        }
                    ?>
                </td>
            </tr>
        </table>
       @endforeach
	</div>
@endsection