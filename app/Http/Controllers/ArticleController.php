<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
    {
        // Mengambil semua artikel beserta data admin (user) yang menulisnya
        // latest() akan mengurutkan dari berita yang paling baru dibuat
        $articles = Article::with('user')->latest()->get();

        return view('admin.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
public function create()
    {
        return view('admin.articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
    {
        // 1. Validasi data yang masuk
        $validated = $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // maksimal 2MB
        ]);

        // 2. Setup data yang akan disimpan
        $data = $validated;
        $data['user_id'] = auth()->id(); // Set otomatis penulisnya adalah admin yang sedang login
        
        // Membuat slug otomatis dari judul (ditambah string acak agar unik)
        $data['slug'] = Str::slug($request->title) . '-' . Str::random(5);

        // 3. Proses upload foto (jika admin mengunggah foto)
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('articles', 'public');
        }

        // 4. Simpan ke database
        Article::create($data);

        // 5. Kembalikan ke halaman daftar dengan pesan sukses
        return redirect()->route('admin.articles.index')->with('success', 'Berita berhasil diterbitkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

// Menampilkan halaman form edit dengan membawa data artikel lama
    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    // Memproses pembaruan data ke database
    public function update(Request $request, Article $article)
    {
        // 1. Validasi
        $validated = $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $validated;
        // Opsional: perbarui slug jika judul berubah
        $data['slug'] = Str::slug($request->title) . '-' . Str::random(5);

        // 2. Cek apakah ada upload foto baru
        if ($request->hasFile('image')) {
            
            // Hapus foto lama dari storage jika sebelumnya sudah ada fotonya
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
            
            // Simpan foto yang baru
            $data['image'] = $request->file('image')->store('articles', 'public');
        }

        // 3. Update data di database
        $article->update($data);

        // 4. Kembalikan ke halaman index dengan pesan sukses
        return redirect()->route('admin.articles.index')->with('success', 'Berita berhasil diperbarui!');
    }

// Memproses penghapusan data dan file gambar
    public function destroy(Article $article)
    {
        // 1. Hapus foto dari folder storage jika artikel ini memiliki foto
        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }

        // 2. Hapus data artikel dari database
        $article->delete();

        // 3. Kembalikan ke halaman daftar dengan pesan sukses
        return redirect()->route('admin.articles.index')->with('success', 'Berita beserta fotonya berhasil dihapus secara permanen!');
    }
}
