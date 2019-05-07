<?php

   namespace App\Http\Controllers;

   use Illuminate\Http\Request;
   use App\Model\Img; // さっき作成したモデルファイルを引用

   class ImgController extends Controller
   {
       public function index() {
       	   $img = Img::all();
       	   return view('img.index', ["img" => $img]);
       }
   }