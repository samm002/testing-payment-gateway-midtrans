@extends('layouts.master')

@section('title')
{{$campaign->id}}
@endsection

@section('content')
<div class="card mb-4 d-flex px-auto">
  <img src="{{ asset('assets/img/campaign/' . $item->photo) }}" class="card-img-top p-3" alt="Gambar campaign {{ $item->judul }}" style="max-width: 400px; height: auto;">
  <div class="card-body">
        <p class="card-text"> <b>Donasi Terkumpul     : </b>{{$campaign->current_donation ?? 0}}</p>
        <p class="card-text"> <b>Target Donasi        : </b>{{$campaign->target_donation}}</p>
        <p class="card-text"> <b>Tanggal Mulai Donasi : </b>{{$campaign->start_date}}</p>
        <p class="card-text"> <b>Tanggal Akhir Donasi : </b>{{$campaign->end_date}}</p>
        <p class="card-text"> <b>Detail Donasi        : </b>{{$campaign->description}}</p>
  </div>
  @auth
  <div class="card-footer d-flex">
    <a href="/campaign/{{$campaign->id}}/edit" class="btn btn-warning btn-sm mx-2">Edit</a>
    <button type="button" class="btn btn-danger btn-sm mx-2" data-toggle="modal" data-target="#deleteModal{{$campaign->id}}">
      Delete
    </button>
  </div>
  @endauth
</div>
@endsection
