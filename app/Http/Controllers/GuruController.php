<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuruController extends Controller
{
    public function index(Request $request){
        $cari = $request->cari;
        $guru = DB::table('tb_guru')->join('users','users.id','=','tb_guru.id_user')
        ->select('users.level','nik','nama','tempat','tgl','alamat','agama','jk','tb_guru.id','id_user')
        ->where('nama','like',"%".$cari."%")
        ->orWhere('nik','like',"%".$cari."%")
        ->paginate(10);
        return view('data_guru/guru',['title'=>'Data Guru','guru'=>$guru]);
    }

    public function create(){
        $data['title']= "Data profil";
        return view('profil.tambah_guru',$data);
    }

    public function store(Request $request){
        $id = $request->id_user;
        $guru = new Guru([
            'id_user' => $request->id_user,
            'nama' => $request->nama,
            'nik' => $request->nik,
            'tempat' => $request->tempat,
            'tgl' => $request->tgl,
            'agama' => $request->agama,
            'jk' => $request->jk,
            'alamat' => $request->alamat,
        ]);
        $guru->save();

        $edit = User::findorfail($id);
        $data = [
            'status' => $request->status,
        ];
        $edit->update($data);
        Alert()->success('SuccessAlert','Tambah data GUru berhasil');
        return redirect()->route('guru/guru');
    }

    public function profil($id){
        $guru = DB::table('tb_guru')->join('users','users.id','=','tb_guru.id_user')
        ->select('users.level','nik','nama','tempat','tgl','alamat','agama','jk','tb_guru.id')
        ->where('id_user','=',''.$id.'')
        ->get();
        $data['title']= "Data profil";
        return view('profil.profil',['guru'=>$guru],$data);
    }

    public function edit_guru($id){
        $guru = Guru::find($id);
        $data['title'] = 'Edit Guru';
        return view('profil/edit_guru',compact(['guru']),$data);
    }

    public function update(Request $request, $id){
        $edit = Guru::findorfail($id);
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
        Alert()->success('SuccessAlert','Tambah data Guru berhasil');
        return redirect()->route('guru/guru');
    }

    public function destroy($id,$id_user){
        $guru = Guru::find($id);
        $guru->delete();

        $edit = User::findorfail($id_user);
        $data = [
            'status' => "0",
        ];
        $edit->update($data);
        toast('Berhasil menghapus data','success');
        return redirect('data_guru/guru');
    }
}
