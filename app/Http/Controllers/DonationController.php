<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Donation;
use Carbon\Carbon;
use Midtrans\Notification;

class DonationController extends Controller
{
  public function homePage()
  {
    return view("layouts.master");
  }
  public function index()
  {
    return view("index");
  }

  public function donate(Request $request)
  {
    $data = $request->only('email', 'donation_amount', 'donation_message');
    $data['donation_date'] = Carbon::now();
    $data['status'] = 'unpaid';

    $validator = Validator::make($data, [
      'email' => ['required', 'string', 'email', 'max:255'],
      'donation_amount' => ['required', 'numeric'],
      'donation_message' => ['nullable', 'string'],
      'donation_date' => ['nullable', 'date'],
      'status' => ['nullable'],
    ]);

    if ($validator->fails()) {
      $errors = $validator->messages();

      return response()->json(['error' => $errors], 400);
    }

    try {
      $donation = Donation::create($data);

      \Midtrans\Config::$serverKey = config('midtrans.server_key');
      \Midtrans\Config::$isProduction = false;
      // Set sanitization on (default)
      \Midtrans\Config::$isSanitized = true;
      // Set 3DS transaction for credit card to true
      \Midtrans\Config::$is3ds = true;

      $params = array(
        'transaction_details' => array(
          'order_id' => $donation->id,
          'gross_amount' => $donation->donation_amount,
        ),
        'donation_details' => json_decode($donation['email'], true),
        'customer_details' => array(
          'first_name' => $donation->name,
          'email' => $donation->email,
        ),
      );

      $snapToken = \Midtrans\Snap::getSnapToken($params);

      return view('donate', compact('snapToken', 'donation'));

      // return response()->json([
      //   'status' => 'success',
      //   'message' => 'succesfully create donation',
      //   'donasi' => $donation,
      //   'snap_token' => $snapToken,
      // ], 201);
    } catch (\Exception $e) {
      return response()->json([
        'status' => 'error',
        'message' => 'Failed tocreate donation',
        'error' => $e->getMessage(),
      ], 500);
    }
  }
//   public function paymentCallback(Request $request)
//   {
//     // Get notification data from the request
//     $notification = new \Midtrans\Notification($request->getContent());

//     // Extract necessary properties
//     $transaction = $notification->transaction_status;
//     $type = $notification->payment_type;
//     $order_id = $notification->order_id;
//     $fraud = $notification->fraud_status;

//     // Verify signature
//     $serverKey = config('midtrans.server_key');
//     $hashed = hash('sha512', $notification->order_id . $notification->status_code . $notification->gross_amount . $serverKey);

//     // Check if signature matches
//     if ($hashed === $request->signature_key) {
//         // Proceed with updating donation status based on transaction status
//         if ($transaction === 'capture') {
//             if ($type === 'credit_card' && $fraud === 'accept') {
//                 $donation = Donation::find($order_id);
//                 $donation->update(['status' => 'paid']);
//             }
//         } elseif ($transaction === 'settlement') {
//             $donation = Donation::find($order_id);
//             $donation->update(['status' => 'paid']);
//         }
//     }
// }


  public function paymentCallback(Request $request)
  {
    $transaction_status = $request->transaction_status;
    $status_code = $request->status_code;
    $type = $request->payment_type;
    $fraud = $request->fraud_status;
    $donation_id = $request->order_id;
    $donation_amount = $request->gross_amount;
    $serverKey = config('midtrans.server_key');
    $hashed = hash('sha512', $request->order_id.$request->status_code.$request->gross_amount.$serverKey);

    if($hashed == $request->signature_key) {
      $donation = Donation::find($donation_id);
      if($transaction_status == 'capture') {
        if ($type == 'credit_card'){
          if($fraud == 'accept'){
            $donation->update(['status' => 'paid']);
            $donation->update(['payment_method' => $type]);
          }
        }
      } else if($transaction_status == 'settlement') {
        $donation->update(['status' => 'paid']);
        $donation->update(['payment_method' => $type]);
      } else if($transaction_status == 'pending') {
        $donation->update(['status' => 'pending']);
        $donation->update(['payment_method' => $type]);
      } else if($transaction_status == 'deny') {
        $donation->update(['status' => 'denied']);
        $donation->update(['payment_method' => $type]);
      } else if($transaction_status == 'expire') {
        $donation->update(['status' => 'expired']);
        $donation->update(['payment_method' => $type]);
      } else if($transaction_status == 'cancel') {
        $donation->update(['status' => 'canceled']);
        $donation->update(['payment_method' => $type]);
      }
    }
  }

  public function invoice($id)
  {
    $donation = Donation::find($id);

    return view('invoice', compact('donation'));
  }
}
