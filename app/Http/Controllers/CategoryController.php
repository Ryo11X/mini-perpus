<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException; // Penting untuk menangani error constraint saat hapus data

class CategoryController extends Controller
{
    /**
     * Menampilkan halaman daftar kategori (Read)
     */
    public function index()
    {
        $categories = Category::all();
        // Mengirim data kategori ke view categories/index.blade.php
        return view('categories.index', compact('categories'));
    }

    /**
     * Menampilkan form untuk menambah kategori baru (Create - Form)
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Menyimpan data kategori baru ke database (Create - Submit)
     */
    public function store(Request $request)
    {
        // 1. Validasi Data
        $request->validate([
            'name' => 'required|unique:categories,name|max:100',
            'description' => 'nullable'
        ], [
            // Pesan error kustom (opsional agar lebih ramah dibaca)
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique' => 'Kategori dengan nama ini sudah ada.',
            'name.max' => 'Nama kategori maksimal 100 karakter.'
        ]);

        // 2. Simpan Data menggunakan Eloquent
        Category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // 3. Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('categories.index')
                         ->with('success', 'Kategori baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit kategori (Update - Form)
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Menyimpan perubahan data kategori ke database (Update - Submit)
     */
    public function update(Request $request, Category $category)
    {
        // 1. Validasi Data
        $request->validate([
            // Pengecualian ID saat validasi unique agar tidak error jika namanya tidak diubah
            'name' => 'required|max:100|unique:categories,name,' . $category->id,
            'description' => 'nullable'
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique' => 'Kategori dengan nama ini sudah ada.',
            'name.max' => 'Nama kategori maksimal 100 karakter.'
        ]);

        // 2. Update Data menggunakan Eloquent
        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // 3. Redirect kembali
        return redirect()->route('categories.index')
                         ->with('success', 'Data kategori berhasil diperbarui.');
    }

    /**
     * Menghapus data kategori dari database (Delete)
     */
    public function destroy(Category $category)
    {
        try {
            // Mencoba menghapus kategori
            $category->delete();
            return redirect()->route('categories.index')
                             ->with('success', 'Kategori berhasil dihapus.');

        } catch (QueryException $e) {
            // Syarat Halaman 4: Menangani constraint/error jika kategori masih dipakai di tabel buku
            return redirect()->route('categories.index')
                             ->with('error', 'Gagal! Kategori tidak dapat dihapus karena masih ada buku yang menggunakan kategori ini.');
        }
    }
}