@extends('layouts.master')

@section('title')
Add Campaign
@endsection

@section('content')
<form action="/campaign" method="POST" enctype="multipart/form-data">
  @csrf
  @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
  @endif
  <div class="form-group">
    <label>Nama Campaign</label>
    <input type="text" name="name" class="@error('name') is-invalid @enderror form-control" placeholder="Masukkan Judul Campaign">
  </div>
  @error('campaign')
  <div class="alert alert-danger">{{ $message }}</div>
  @enderror

  <div class="form-group">
    <label>Target Campaign</label>
    <input type="number" name="target_donation" class="@error('target_donation') is-invalid @enderror form-control" cols="30" rows="10" placeholder="Masukkan Target Donasi Campaign"></input>
  </div>
  @error('target_donation')
      <div class="alert alert-danger">{{ $message }}</div>
  @enderror
  <div class="form-group">
    <label for="type">Kategori Campaign</label>
    <select name="type" id="type" class="form-control @error('type') is-invalid @enderror">
        <option value="">Pilih Kategori Campaign</option>
        <option value="kemanusiaan">Kemanusiaan</option>
        <option value="kesehatan">Kesehatan</option>
        <option value="pendidikan">Pendidikan</option>
        <option value="tanggap bencana">Tanggap Bencana</option>
    </select>
  </div>
  @error('type')
      <div class="invalid-feedback">{{ $message }}</div>
  @enderror
  
  <div class="form-group">
    <label>Foto Campaign</label>
    <input type="file" name="photo" class="@error('photo') is-invalid @enderror form-control" placeholder="Masukkan Foto Campaign">
</div>
@error('photo')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

  <div class="form-group">
    <label>Tanggal Mulai Campaign</label>
    <input type="date" name="start_date" class="@error('start_date') is-invalid @enderror form-control" cols="30" rows="10" placeholder="Masukkan Tanggal Mulai Campaign"></input>
  </div>
  @error('start_date')
      <div class="alert alert-danger">{{ $message }}</div>
  @enderror

  <div class="form-group">
    <label>Tanggal Selesai Campaign</label>
    <input type="date" name="end_date" class="@error('end_date') is-invalid @enderror form-control" cols="30" rows="10" placeholder="Masukkan Tanggal Selesai Campaign"></input>
  </div>
  @error('end_date')
      <div class="alert alert-danger">{{ $message }}</div>
  @enderror

  <div class="form-group">
    <label>Deskripsi Campaign</label>
    <textarea id="description" name="description" class="form-control" rows="5" placeholder="Masukkan Deskripsi Campaign"></textarea>
</div>
@error('description')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
