@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold text-dark mb-1">Daftar Buku</h3>
        <p class="text-muted small mb-0">Kelola inventaris buku perpustakaan secara real-time.</p>
    </div>
    <a href="{{ route('books.create') }}" class="btn btn-dark px-4 rounded-3 shadow-sm">
        <i class="bi bi-plus-lg me-1"></i> Tambah Buku
    </a>
</div>

<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-secondary border-bottom">
                    <tr>
                        <th class="py-3 px-4" width="70px">No</th>
                        <th class="py-3">Judul Buku</th>
                        <th class="py-3">Kategori</th>
                        <th class="py-3">Penulis</th>
                        <th class="py-3">Tahun</th>
                        <th class="py-3">Stok</th>
                        <th class="py-3 px-4 text-end" width="160px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($books as $key => $book)
                    <tr>
                        <td class="px-4 text-muted fw-semibold">{{ $key + 1 }}</td>
                        <td class="fw-semibold text-dark">{{ $book->title }}</td>
                        <td>
                            <span class="badge bg-secondary bg-opacity-10 text-dark border px-2 py-1 fw-normal">
                                {{ $book->category->name }}
                            </span>
                        </td>
                        <td class="text-secondary">{{ $book->author }}</td>
                        <td class="text-secondary">{{ $book->published_year }}</td>
                        <td>
                            <span class="fw-bold {{ $book->stock > 0 ? 'text-dark' : 'text-danger' }}">
                                {{ $book->stock }}
                            </span>
                        </td>
                        <td class="px-4 text-end">
                            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-light border text-dark me-1 rounded-2">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light border text-danger rounded-2">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="bi bi-book display-6 d-block mb-2 text-secondary opacity-50"></i>
                            Belum ada data buku yang tersimpan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection