<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category; // Wajib dipanggil karena kita butuh data kategori untuk form
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Menampilkan halaman daftar buku (Read)
     */
    public function index()
    {
        // Menggunakan with('category') untuk Eager Loading (memanggil relasi agar lebih optimal)
        $books = Book::with('category')->get();
        return view('books.index', compact('books'));
    }

    /**
     * Menampilkan form untuk menambah buku baru (Create - Form)
     */
    public function create()
    {
        // Mengambil seluruh data kategori untuk ditampilkan di tag <select>
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    /**
     * Menyimpan data buku baru ke database (Create - Submit)
     */
    public function store(Request $request)
    {
        // 1. Validasi Data (Sesuai Syarat Halaman 6)
        $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|exists:categories,id', // Memastikan ID kategori benar-benar ada di database
            'author' => 'required|max:100',
            'published_year' => 'required|numeric',
            'stock' => 'required|numeric|min:0',
        ], [
            // Pesan error kustom
            'title.required' => 'Judul buku wajib diisi.',
            'title.max' => 'Judul buku maksimal 255 karakter.',
            'category_id.required' => 'Kategori wajib dipilih.',
            'author.required' => 'Nama penulis wajib diisi.',
            'published_year.required' => 'Tahun terbit wajib diisi.',
            'published_year.numeric' => 'Tahun terbit harus berupa angka.',
            'stock.required' => 'Stok buku wajib diisi.',
            'stock.numeric' => 'Stok buku harus berupa angka.'
        ]);

        // 2. Simpan Data
        Book::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'author' => $request->author,
            'published_year' => $request->published_year,
            'stock' => $request->stock,
        ]);

        // 3. Redirect kembali dengan pesan sukses
        return redirect()->route('books.index')
                         ->with('success', 'Buku baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit buku (Update - Form)
     */
    public function edit(Book $book)
    {
        // Mengambil seluruh data kategori untuk ditampilkan di tag <select>
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    /**
     * Menyimpan perubahan data buku ke database (Update - Submit)
     */
    public function update(Request $request, Book $book)
    {
        // 1. Validasi Data
        $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'author' => 'required|max:100',
            'published_year' => 'required|numeric',
            'stock' => 'required|numeric|min:0',
        ], [
            'title.required' => 'Judul buku wajib diisi.',
            'category_id.required' => 'Kategori wajib dipilih.',
            'author.required' => 'Nama penulis wajib diisi.',
            'published_year.required' => 'Tahun terbit wajib diisi.',
            'published_year.numeric' => 'Tahun terbit harus berupa angka.',
            'stock.required' => 'Stok buku wajib diisi.',
            'stock.numeric' => 'Stok buku harus berupa angka.'
        ]);

        // 2. Update Data
        $book->update([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'author' => $request->author,
            'published_year' => $request->published_year,
            'stock' => $request->stock,
        ]);

        // 3. Redirect kembali
        return redirect()->route('books.index')
                         ->with('success', 'Data buku berhasil diperbarui.');
    }

    /**
     * Menghapus data buku dari database (Delete)
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')
                         ->with('success', 'Buku berhasil dihapus.');
    }
}