<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
{
    public function index(Request $request){
        $cari = $request->cari;
        $siswa = DB::table('tb_siswa')
        ->where('nama','like',"%".$cari."%")
        ->orWhere('nik','like',"%".$cari."%")
        ->paginate(10);
        return view('siswa/siswa',['siswa'=>$siswa,'title'=>'Data Siswa']);
    }

    public function create(){
        return view('siswa/tambah_siswa',['title'=>'Tambah Data Siswa']);
    }

    public function store(Request $request){
        $siswa = new Siswa([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'tempat' => $request->tempat,
            'tgl' => $request->tgl,
            'agama' => $request->agama,
            'jk' => $request->jk,
            'alamat' => $request->alamat,
        ]);
        $siswa->save();
        Alert()->success('SuccessAlert','Tambah data Siswa berhasil');
        return redirect()->route('siswa/siswa');
    }

    public function edit_siswa($id){
        $siswa = Siswa::find($id);
        $data['title'] = 'Edit Siswa';
        return view('siswa/edit_siswa',compact(['siswa']),$data);
    }

    public function update(Request $request, $id){
        $edit = Siswa::findorfail($id);
        $data = [
            'nama' => $request->nama,
            'nik' => $request->nik,
            'tempat' => $request->tempat,
            'tgl' => $request->tgl,
            'agama' => $request->agama,
            'jk' => $request->jk,
            'alamat' => $request->alamat,
        ];
        $edit->update($data);
        Alert()->success('SuccessAlert','Tambah data Siswa berhasil');
        return redirect()->route('siswa/siswa');
    }

    public function destroy($id){
        $siswa = Siswa::find($id);
        $siswa->delete();
        toast('Berhasil menghapus data','success');
        return redirect('siswa/siswa');
    }
}
