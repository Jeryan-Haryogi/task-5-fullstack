<?php

namespace App\Http\Controllers\Kategori;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriModel;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    public function index()
    {
        $data = DB::table('categories')->get();
        $data2 = DB::table('categories')->join('users', function($join){
            $join->on('users.id', '=', 'categories.user_id');
        })->get();
        echo view('kategori/list-kategori', ['data' => $data, 'data2' => $data2]);
    }
    public function store(Request $request)
    {
       $this->validate($request, [
        'name' => 'required'
       ]);
       $kategori =  KategoriModel::create([
            'name' => $request->name,
            'user_id' => auth()->user()->id,
        ]);
        return redirect('/Kategori')->with('success', 'Data Kategori Berhasil Ditambah');

    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        
        KategoriModel::where('id', $request->id)->update([
            'name' => $request->name
        ]);
        return redirect('/Kategori')->with('success', 'Data Kategori Berhasil Diupdate');
    }
    public function delete(Request $request)
    {
        KategoriModel::where('id', $request->id)->delete();
        return redirect('/Kategori')->with('success', 'Data Kategori Berhasil Dihapus');
    }

    
    // endpoint API
    public function api_index()
    {
        $data = DB::table('categories')->get();
        $data2 = DB::table('categories')->join('users', function($join){
            $join->on('users.id', '=', 'categories.user_id');
        })->get();
        return response()->json(['data' => $data], 200);

    }
    public function api_detail($id)
    {
        $data = KategoriModel::where('id', $id)->get();
        return response()->json(['data' => $data], 200);
    }
    public function api_store(Request $request)
    {
       $this->validate($request, [
        'name' => 'required'
       ]);
       $kategori =  KategoriModel::create([
            'name' => $request->name,
            'user_id' => auth()->user()->id,
        ]);
        $token = $kategori->createToken('laravel-token')->accessToken;
        return response()->json(['Data' => $kategori,'token' => $token], 200);
    }
    public function api_update(Request $request,$id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        KategoriModel::where('id', $id)->update([
            'name' => $request->name
        ]);
        $kategori =  KategoriModel::where('id', $id)->get();
        return response()->json(['data' => $kategori, 'Messege' => 'Data Kategori Berhasil Diubah'], 200);
    }
    public function api_delete(Request $request, $id)
    {
        KategoriModel::where('id', $id)->delete();
        return response()->json(['Messege' => 'Data Kategori Berhasil Dihapus'], 200);

    }
}
