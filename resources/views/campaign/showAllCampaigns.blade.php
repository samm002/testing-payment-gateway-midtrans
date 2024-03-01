@extends('layouts.master')

@section('title')
Show All Campaign
@endsection

@section('content')
<a href="/campaign/create" class="btn btn-primary my-3">Tambah</a>
<div class="row">
  @forelse ($campaign as $item)
  <div class="col-4 d-flex my-3">
    <div class="card h-100 flex-fill">
      <img src="{{ asset('assets/img/campaign/' . $item->photo) }}" class="card-img-top p-3" alt="Gambar campaign {{ $item->judul }}"
      style="width: 100%;
            height: 25vw;
            object-fit: cover;">
      <div class="card-body">
        <h5 class="card-title mx-auto">{{$item->name}})</h5><br>
        <span class="badge badge-success">{{ $item->type }}</span>
        <p class="card-text"> <b>Donasi Terkumpul     : </b>{{$campaign->current_donation}}</p>
        <p class="card-text"> <b>Target Donasi        : </b>{{$campaign->target_donation}}</p>
        <p class="card-text"> <b>Tanggal Mulai Donasi : </b>{{$campaign->start_date}}</p>
        <p class="card-text"> <b>Tanggal Akhir Donasi : </b>{{$campaign->end_date}}</p>
        <p class="card-text"> <b>Detail Donasi        : </b>{{$campaign->description}}</p>
      </div>
        <div style="margin-bottom: 15px; margin-left: 15px;">
          <form action="/campaign/{{$item->id}}" method="POST">
            @csrf
            @method('delete')
            <a href="/campaign/{{$item->id}}" class="btn btn-sm btn-info">Detail</a>
            <a href="/campaign/{{$item->id}}/edit" class="btn btn-sm btn-warning">Edit</a>
            <input type="submit" value="Delete" class="btn btn-sm btn-danger">
          </form>
        </div>
    </div>
  </div>
  @empty
    <h3>Tidak ada data campaign untuk ditampilkan</h3>
  @endforelse
</div>

@endsection