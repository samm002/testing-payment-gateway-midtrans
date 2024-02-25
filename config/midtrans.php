<?php

return [
  'merchant_id' => env('MIDTRANS_MECHANT_ID'),
  'client_key' => env('MIDTRANS_CLIENT_KEY'),
  'server_key' => env('MIDTRANS_SERVER_KEY'),
  'isProduction' => env('MIDTRANS_IS_PRODUCTION', false),
  'isSanitized' => env('MIDTRANS_IS_SANITIZED', true),
  'is3ds' => env('MIDTRANS_IS_3DS', true),
];