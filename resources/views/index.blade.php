<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Donasi IFL Malang</title>
</head>
<body>
  <div class="container">
    <h1 class="my-3">Campaign & Donation</h1>
    <div class="card my-5" style="width: 18rem;">
      <img src="{{asset('assets/img/makan siang gratis.jpeg')}}" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Makan Siang Gratis</h5>
        <p class="card-text">Mari kita wujudkan program kerja baru makan siang gratis!</p>
        <form action="/donate" method="POST">
          @csrf
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Silahkan masukkan email anda">
          </div>
          <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Silahkan masukkan nama anda (kosongkan apabila ingin mengirim secara anonim)">
          </div>
          <div class="mb-3">
            <label for="donation_amount" class="form-label">Nominal Donasi</label>
            <input type="number" name="donation_amount" class="form-control" id="donation_amount" placeholder="Silahkan masukkan jumlah donasi anda">
          </div>
          <div class="mb-3">
            <label for="donation_message" class="form-label">Pesan Donasi</label>
            <textarea name="donation_message" class="form-control" id="donation_message" rows="3" placeholder="Silahkan masukkan pesan yang ingin anda sampaikan"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Donasi</button>
        </form>
      </div>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>  
</body>
</html>