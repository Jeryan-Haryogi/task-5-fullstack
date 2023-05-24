<?php

namespace App\Http\Controllers\Articel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArtikelModel;
use Illuminate\Support\Facades\DB;
use App\Models\KategoriModel;

class ArticelController extends Controller
{
    public function index()
    {
        $kategori = KategoriModel::all();
        $data = ArtikelModel::all();
        echo view('Artikel/list-artikel', ['kategori' => $kategori, 'data' => $data]);
    }
    public function list()
    {
        $data = ArtikelModel::orderBy('id', 'DESC')->paginate(8);
        echo view('home', ['data' => $data]);
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'image' => 'required|mimes:png,jpg,jpeg|max:2000',
            'title' => 'required',
            'kategori' => 'required',
            'content' => 'required',
        ]);
        $imageName = md5($request->image).time().'.'.$request->image->extension();
       
        ArtikelModel::create([
            'image' => $imageName,
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->kategori,
            'user_id' => auth()->user()->id
        ]);
        $request->image->move(public_path('images/'), $imageName);
        return redirect('/Artikel')->with('success', 'Data Artikel Berhasil Ditambahkan');
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|mimes:png,jpg,jpeg|max:2000',
            'title' => 'required',
            'content' => 'required',
            'kategori' => 'required',
        ]);
        $imageName = md5($request->image).time().'.'.$request->image->extension();
        ArtikelModel::where('id', $request->id)->update([
            'image' => $imageName,
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->kategori,
            'user_id' => auth()->user()->id
        ]);
        $request->image->move(public_path('images/'), $imageName);
        return redirect('/Artikel')->with('success', 'Data Artikel Berhasil Diubah');

    }
    public function view($id)
    {
        
        $data = ArtikelModel::where('id', $id)->get();
        echo view('Artikel/detail', ['data' => $data]);
    }
    public function delete(Request $request)
    {
        ArtikelModel::where('id', $request->id)->delete();
        return redirect('/Artikel')->with('success', 'Data Artikel Berhasil Dihapus');
    }
    


    public function api_index()
    {
        $data = ArtikelModel::paginate(8);
        return response()->json(['data' => $data], 200);
    }
    public function api_list()
    {
        $data = ArtikelModel::paginate(8);
        return response()->json(['data' => $data], 200);

    }
    public function api_store(Request $request)
    {
        $this->validate($request,[
            'image' => 'required',
            'title' => 'required',
            'content' => 'required',
        ]);
        $imageName = md5($request->image).time();
       
        $artikel = ArtikelModel::create([
            'image' => $imageName,
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->kategori,
            'user_id' => auth()->user()->id
        ]);
        // $request->image->move(public_path('images/'), $imageName);
        return response()->json(['data' => $artikel, 'Messege' => 'Data Artikel Berhasil Ditambahkan'], 200);
    }
    public function api_update(Request $request, $id)
    {
     
        $imageName = md5($request->image).time();
       $artikel =  ArtikelModel::where('id', $id)->update([
             'image' => $imageName,
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->kategori,
            'user_id' => auth()->user()->id
        ]);
        return response()->json(['Messege' => 'Data Artikel Berhasil Diubah'], 200);
    }
    public function api_view($id)
    {
        
        $data = ArtikelModel::where('id', $id)->get();
        foreach ($data as $key => $d) {
            $kategori = DB::table('categories')->where('id', $d->category_id)->get();
            # code...
            
        return response()->json(['data' => ['artikel' => $data, 'kategori' => $kategori]], 200);
        }

    }
    public function api_delete(Request $request, $id)
    {
        $artikel = ArtikelModel::where('id', $id)->delete();
        return response()->json([ 'Messege' => 'Data Artikel Berhasil Dihapus'], 200);

    }
}
