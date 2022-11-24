<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\Kategori;
use App\Models\TemporaryFiles;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class DokumenController extends Controller
{
    public function kategori(){
        $kategori = DB::table('kategori')->get();
        return view('kategori.index', [
            'kategori' => $kategori
        ]);
    }

    public function kategoriStore(Request $request){
        $request->validate([
            'nama' => 'required'
        ]);

        Kategori::create([
            'nama' => $request->nama,
            'created_at' => Carbon::now()
        ]);

        return redirect()->route('kategori');
    }

    public function kategoriDelete($id){
        $delete = Kategori::find($id);
        $delete->delete();
        return redirect()->route('kategori');
    }

    public function index(){
        
        $doc = Dokumen::get();
        $title = "Dokumen";
        return view('dokumen.index', [
            'doc' => $doc,
            'title' => $title
        ]);
    }

    public function baru()
    {
        $from = Carbon::now()->subDays(2);
        $current = Carbon::now();
        $title = "Dokumen Baru";
        $doc = Dokumen::where('created_at', '>=', $from)
                ->where('created_at', '<=', $current)->get();
        return view('dokumen.index', [
            'title' => $title,
            'doc' => $doc
        ]);
    }

    public function store(Request $request){
        
        $request->validate([
            'nama' => 'required',
            'kategori' => 'required',
        ]);

        $tmp_file = TemporaryFiles::where('folder', $request->pdf)->first();
        if ($tmp_file) {
            $filename = $tmp_file->file;
            $folder = $tmp_file->folder;
            $infopath = pathinfo(asset('storage/'.$folder.'/'.$filename));
            $extension = ".".$infopath['extension'];
            $nfile = md5($request->nama);
            $file_name = $nfile.$extension;
            
            Storage::copy('public/tmp/'.$folder.'/'.$filename, 'public/pdf/'.$file_name );
            Dokumen::create([
                'nama' => $request->nama,
                'kategori_id' => $request->kategori,
                'slug' => $nfile,
                'path' => $file_name,
                'uploader' => Auth::user()->name,
                'uploader_email' => Auth::user()->email,
                'created_at' => Carbon::now()
            ]);
            Storage::deleteDirectory('public/tmp/'.$folder);
            $tmp_file->delete;
        }
        Alert::success('Berhasil', 'Dokumen Telah Berhasil Ditambahkan!');
        return redirect()->route('main');

        // $file = $request->file('pdf');
        // $extension = ".".$file->getClientOriginalExtension();
        // $nfile = md5($request->nama);
        // $filename = $nfile.$extension;
        // $file->storeAs('public/pdf', $filename);
        // Dokumen::create([
        //     'nama' => $request->nama,
        //     'kategori_id' => $request->kategori,
        //     'slug' => $nfile,
        //     'path' => $filename,
        //     'created_at' => Carbon::now()
        // ]); 
    }

    public function pdfUpload(Request $request)
    {
        if ($request->hasFile('pdf')) {
            $file = $request->file('pdf');
            $folder = uniqid('post', true);
            $file_name = $file->getClientOriginalName();
            $file->storeAs('public/tmp/'. $folder, $file_name);
            TemporaryFiles::create([
                'folder' => $folder,
                'file' => $file_name
            ]);
            return $folder;
        }
        return '';
    }
    public function pdfDelete()
    {
        $tmp_file = TemporaryFiles::where('folder', request()->getContent())->first();
        if ($tmp_file) {
            Storage::deleteDirectory('public/tmp/'.$tmp_file->folder);
            $tmp_file->delete;
            return response('');
        }
    }

    public function show($kategori, $slug){
        $data = Dokumen::where('slug',$slug)->first();
        return view('dokumen.show', [
            'data' => $data
        ]);
    }

    public function filterKategori($kategori){
        $data = Dokumen::where('kategori_id', $kategori)->get();
        $namaKategori = Kategori::find($kategori);
        $title = $namaKategori->nama;
        return view('dokumen.index', [
            'title' => $title,
            'doc' => $data
        ]);
    }
}