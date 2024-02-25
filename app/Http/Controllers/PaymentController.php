<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
      return view("index");
    }

    public function checkout()
    {

    }

    public function success()
    {
      return view("index");
    }
}
