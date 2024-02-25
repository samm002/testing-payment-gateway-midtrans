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
    <h1 class="my-3">Invoice (Nama Campaign)</h1>
    <div class="card my-5" style="width: 18rem;">
      <div class="card-body">
        <h5 class="card-title">Detail Donasi</h5>
        <table>
          <tr>
            <td>Nama</td>
            <td> : {{ $donation->name }}</td>
          </tr>
          <tr>
            <td>Email</td>
            <td> : {{ $donation->email }}</td>
          </tr>
          <tr>
            <td>Jumlah Donasi</td>
            <td> : {{ $donation->donation_amount }}</td>
          </tr>
          <tr>
            <td>Status Donasi</td>
            <td> : {{ $donation->status }}</td>
          </tr>
          <tr>
            <td>Metode Pembayaran</td>
            <td> : {{ $donation->payment_method }}</td>
          </tr>
        </table>
      </div>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>  
</body>
</html>