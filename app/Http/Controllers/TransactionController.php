<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\Transaction;
use Carbon\Carbon;
use Midtrans\Config;
use Midtrans\Snap;

class TransactionController extends Controller
{
  public function paymentCallback(Request $request)
  {
    $transaction_status = $request->transaction_status;
    $status_code = $request->status_code;
    $type = $request->payment_type;
    $fraud = $request->fraud_status;
    $transaction_id = $request->order_id;
    $donation_amount = $request->gross_amount;
    $serverKey = config('midtrans.server_key');
    $hashed = hash('sha512', $request->order_id.$request->status_code.$request->gross_amount.$serverKey);

    if($hashed == $request->signature_key) {
      $transaction = Transaction::find($transaction_id);
      if($transaction_status == 'capture') {
        if ($type == 'credit_card'){
          if($fraud == 'accept'){
            $transaction->update(['status' => 'paid']);
            $transaction->update(['payment_method' => $type]);
          }
        }
      } else if($transaction_status == 'settlement') {
        $transaction->update(['status' => 'paid']);
        $transaction->update(['payment_method' => $type]);
      } else if($transaction_status == 'pending') {
        $transaction->update(['status' => 'pending']);
        $transaction->update(['payment_method' => $type]);
      } else if($transaction_status == 'deny') {
        $transaction->update(['status' => 'denied']);
        $transaction->update(['payment_method' => $type]);
      } else if($transaction_status == 'expire') {
        $transaction->update(['status' => 'expired']);
        $transaction->update(['payment_method' => $type]);
      } else if($transaction_status == 'cancel') {
        $transaction->update(['status' => 'canceled']);
        $transaction->update(['payment_method' => $type]);
      }
    }
  }
}
