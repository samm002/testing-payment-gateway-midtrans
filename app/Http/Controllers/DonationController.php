<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Donation;
use App\Models\Transaction;
use Carbon\Carbon;
use Midtrans\Config;
use Midtrans\Snap;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $donation = Donation::all();
      try {
        return response()->json([
            'status' => 'success',
            'message' => 'Get all donation success',
            'data' => $donation,
          ], 200);
      } catch (\Exception $e) {
        return response()->json([
          'status' => 'error',
          'message' => 'Get all donation failed',
          'error' => $e->getMessage(),
        ], 500);
      }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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

        $transaction = Transaction::create([
          'donation_id' => $donation->id,
        ]);

        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = array(
          'transaction_details' => array(
            'order_id' => $transaction->id,
            'gross_amount' => $donation->donation_amount,
          ),
          'donation_details' => json_decode($donation['email'], true),
          'customer_details' => array(
            'first_name' => $donation->name ?? 'anonim',
            'email' => $donation->email,
          ),
        );

        $snapToken = Snap::getSnapToken($params);
        $paymentUrl = Snap::createTransaction($params)->redirect_url;

        return response()->json([
          'status' => 'success',
          'message' => 'succesfully create donation',
          'snap_token' => $snapToken,
          'payment_url' => $paymentUrl,
        ], 201);
      } catch (\Exception $e) {
        return response()->json([
          'status' => 'error',
          'message' => 'Failed tocreate donation',
          'error' => $e->getMessage(),
        ], 500);
      }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
      $donation = Donation::find($id);
      if (!$donation) {
        return response()->json([
          'status' => 'error',
          'message' => 'Donation not found with the given ID',
        ], 404);
      }
      try {
        return response()->json([
          'status' => 'success',
          'message' => 'Get donation by id success',
          'data' => $donation,
        ], 200);
      } catch (\Exception $e) {
        return response()->json([
          'status' => 'error',
          'message' => 'Get donation by id failed',
          'error' => $e->getMessage(),
        ], 500);
      }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      $donation = Donation::find($id);
      if (!$donation) {
        return response()->json([
          'status' => 'error',
          'message' => 'Donation not found with the given ID',
        ], 404);
      }

      try {
        $donation->delete();
  
        return response()->json([
          'status' => 'success',
          'message' => 'Donation deleted successfully',
          'data' => $donation,
        ], 200);
      } catch (\Exception $e) {
        return response()->json([
          'status' => 'error',
          'message' => 'Error deleting donation',
          'error' => $e->getMessage(),
        ], 500);
      }
    }

    public function deleteAll()
    {
      try {
        $totalDonation = Donation::count();

        Donation::truncate();
  
        return response()->json([
          'status' => 'success',
          'message' => 'Delete all donation successfully',
          'data' => ['Total donation deleted' => $totalDonation]
        ], 200);
      } catch (\Exception $e) {
        return response()->json([
          'status' => 'error',
          'message' => 'Delete all donation failed',
          'error' => $e->getMessage(),
        ], 500);
      }
    }
}
