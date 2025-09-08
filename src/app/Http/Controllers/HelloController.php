<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    //
    public function index()
    {
      // Viewへの変数の引き渡し
    	$test_1 = "テスト1";
    	$test_2 = "テスト2";

      return view('hello')->with([
        "test_1" => $test_1,
        "test_2" => $test_2,
      ]);
    }
}