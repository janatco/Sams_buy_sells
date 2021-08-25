<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use App\Models\Bid;
use App\Models\ProductImage;

use Exception;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function viewMyProducts()
    {


        $products = Product::where('user_id', auth()->user()->id)->orderBy("created_at", "desc")->get();
        // dd($products);

        return view('viewMyProducts', compact('products'));
    }

    public function viewProduct($id)
    {


        $product = Product::where('id', $id)->with(['bids' => function ($q) {
            $q->orderBy('price', 'DESC');
        }])->first();
        // dd($product);

        return view('viewProduct', compact('product'));
    }



    /**
     * Load product to home page a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function loadProducts()
    {
        $todayDate = date('Y-m-d H:i:s');
        $query = Product::query();
        $products = $query->where('bid_closing_date_time', '>', $todayDate)->with('seller')->get();
        //$resultProduct=$products->toArray();
        // $array = json_decode(json_encode($products), true);
        //dd($products->toArray());
        return view('shoppingcart', compact('products'));
    }

    public function searchByName($name)
    {
        //$name="book";
        $todayDate = date('Y-m-d H:i:s');
        $query = Product::query();
        $products = $query->where('bid_closing_date_time', '>', $todayDate)->where('category', $name)->with('seller')->orderBy('created_at', 'DESC')->get();
        //dd($products->toArray());

        return view('shoppingcart', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd(config('values'));
        $formElementValues = [
            'locationlist' => config('values.locations'),
            'categorylist' => config('values.categories'),


        ];

        return view('addproduct', compact('formElementValues'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());

        $this->validator($request->all())->validate();
        $imageName = time() . '.' . auth()->user()->id . $request->productImage->extension();

        try {

            $product = new Product;
            $product->name = $request->productName;
            $product->description = $request->prodDescription;
            $product->start_bid_price = $request->startBidPrice;
            $product->status = "ON_BID";
            $product->bid_closing_date_time = $request->bidClosing;
            $product->inspection_date_time = $request->inspectionDateTime;
            $product->category = $request->prodcategory;
            $product->image = $imageName;
            $product->location = $request->prodLocation;
            $product->user_id = auth()->user()->id;
            $product->save();
            $request->productImage->move(public_path('images'), $imageName);

            return back()->with('success', 'Product "' . $product->name . '" now on acution');
        } catch (Exception $e) {

            // dd($e->getMessage());

            return back()->withErrors([$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $todayDate = date('Y-m-d H:i:s');
        $query = Product::query();
        $product = $query->where('bid_closing_date_time', '>', $todayDate)->where('id', $id)->with('seller')->with('productimages')->orderBy('created_at', 'DESC')->first();
        //$product = $product->toArray();
        //dd($products->toArray());

        return view('productBuy', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addMoreImages($id)
    {
        $product = Product::find($id);
        //$product = $query->where('bid_closing_date_time','>',$todayDate)->where('id',$id)->with('seller')->orderBy('created_at','DESC')->first();

        return view('addmoreimages', compact('product'));
    }

    public function storeMoreImages(Request $request)
    {
        //dd($request->all());

        //$this->validator($request->all())->validate();

        $product = Product::find($request->productId);
        // dd($product);
        $image1Name = time() . auth()->user()->id . '_1.' . $request->productImage1->extension();
        $image2Name = time() . auth()->user()->id . '_2.' . $request->productImage2->extension();

        try {

            $productImage1 = new ProductImage;
            $productImage1->image = $image1Name;
            $productImage2 = new ProductImage;
            $productImage2->image = $image2Name;

            $request->productImage1->move(public_path('images'), $image1Name);
            $request->productImage2->move(public_path('images'), $image2Name);
            $product = $product->productimages()->saveMany([$productImage1, $productImage2]);

            return back()->with('success', 'Product iages addedd');
        } catch (Exception $e) {

            // dd($e->getMessage());

            return back()->withErrors([$e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    protected function validator(array $data)
    {
        $todayDate = date('Y-m-d H:i:s');
        return Validator::make($data, [
            'prodcategory' => 'required',
            'productName' => 'required|string|max:50|min:3',
            'prodDescription' => 'required|string|max:500|min:50',
            'startBidPrice' => 'required|numeric',
            'bidClosing' => 'required|date_format:Y-m-d H:i:s|after_or_equal:' . $todayDate,
            'inspectionDateTime' => 'required|date_format:Y-m-d H:i:s|before:bidClosing',
            'productImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // later need to add dimensions:width=500,height=500'
            'prodLocation' => 'required',
        ]);
    }
    
}
