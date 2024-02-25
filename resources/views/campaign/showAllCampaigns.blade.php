@extends('layouts.master')

@section('title')
Show All Buku
@endsection

@section('content')
<a href="/buku/create" class="btn btn-primary my-3">Tambah</a>
<div class="row">
  @forelse ($buku as $item)
  <div class="col-4 d-flex my-3">
    <div class="card h-100 flex-fill">
      <img src="{{ asset('gambar_buku/' . $item->gambar) }}" class="card-img-top p-3" alt="Gambar buku {{ $item->judul }}"
      style="width: 100%;
            height: 25vw;
            object-fit: cover;">
      <div class="card-body">
        <h5 class="card-title mx-auto">{{$item->judul}} - ({{$item->tahun_terbit}})</h5><br>
        <span class="badge badge-success">{{ $item->genre->nama }}</span>
        <p class="card-text">{{ $item->penulis->nama }}</p>
      </div>
        <div style="margin-bottom: 15px; margin-left: 15px;">
          <form action="/buku/{{$item->id}}" method="POST">
            @csrf
            @method('delete')
            <a href="/buku/{{$item->id}}" class="btn btn-sm btn-info">Detail</a>
            <a href="/buku/{{$item->id}}/edit" class="btn btn-sm btn-warning">Edit</a>
            <input type="submit" value="Delete" class="btn btn-sm btn-danger">
          </form>
        </div>
    </div>
  </div>
  @empty
    <h3>Tidak ada data buku untuk ditampilkan</h3>
  @endforelse
</div>

@endsection