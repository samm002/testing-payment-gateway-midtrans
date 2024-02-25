<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script type="text/javascript"
  src="https://app.sandbox.midtrans.com/snap/snap.js"
  data-client-key="{{ config('midtrans.client_key') }}"></script>
  <title>Donasi IFL Malang</title>
</head>
<body>
  <div class="container">
    <h1 class="my-3">Campaign & Donation</h1>
    <div class="card my-5" style="width: 24rem;">
      <img src="{{asset('assets/img/makan siang gratis.jpeg')}}" class="card-img-top" alt="...">
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
            <td>Pesan Donasi</td>
            <td> : {{ $donation->donation_message }}</td>
          </tr>
        </table>
        <button class='btn btn-primary mt-3' id="pay-button">Bayar Sekarang</button>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>  
  <script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
      // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
      window.snap.pay('{{ $snapToken }}', {
        onSuccess: function(result){
          /* You may add your own implementation here */
          alert("payment success!"); 
          window.location.href = '/invoice/{{ $donation->id }}'
          // console.log(result);
        },
        onPending: function(result){
          /* You may add your own implementation here */
          alert("wating your payment!"); console.log(result);
        },
        onError: function(result){
          /* You may add your own implementation here */
          alert("payment failed!"); console.log(result);
        },
        onClose: function(){
          /* You may add your own implementation here */
          alert('you closed the popup without finishing the payment');
        }
      })
    });
  </script>
</body>
</html>