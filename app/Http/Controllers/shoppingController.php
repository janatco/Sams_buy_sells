<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class shoppingController extends Controller
{
    public function index(){
        /*$products=[
            '1'=>[
                'Name'=>'Samsung',
                'Start_Price'=>'Rs.50000',
                'url'=>'http://anodscocoa.com/upload_content/QGEAbwcO-t0.jpg',
                
            ],
            '2'=>[
                'Name'=>'TCL',
                'Start_Price'=>'Rs.50000',
                'url'=>'http://anodscocoa.com/upload_content/QGEAbwcO-t0.jpg',
            ],
            '3'=>[
                'Name'=>'HP',
                'Start_Price'=>'Rs.50000',
                'url'=>'http://anodscocoa.com/upload_content/QGEAbwcO-t0.jpg',
            ],
            '4'=>[
                'Name'=>'Dell',
                'Start_Price'=>'Rs.50000',
                'url'=>'http://anodscocoa.com/upload_content/QGEAbwcO-t0.jpg',
            ],

        ];
        return view('shoppingcart',compact('products'));*/
        $products = Product::all();

        return view('shoppingcart',compact('products'));
    }
    public function bidproduct($productKey){
        $productDetails=[
            'id'=>[
                'p_name' => 'Samsung',
                'p_Start_Price'=>'Rs.50000',
                'p_url'=>'http://anodscocoa.com/upload_content/QGEAbwcO-t0.jpg',
            ]
        ];
        return view('productBuy');

    }
}
