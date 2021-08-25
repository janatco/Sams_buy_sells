<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Bid;
use App\Models\Transaction;
use App\Models\Product;
use Exception;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use function PHPUnit\Framework\isNull;

class BidController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->all());
        DB::beginTransaction();

        try {
            $bid = new bid;
            $bid->product_id = $request->productId;
            $bid->user_id = auth()->user()->id;
            $bid->price = $request->bidAmount;
            $bid->status = 'INIT';
            $bid->deposit = round($request->bidAmount * 0.2, 2);
            $bid->deposit_status = 'PENDING';
            $bid->save();
            DB::commit();
            $bidinfo = $bid->toArray();

            return view('depositPay', compact('bidinfo'));
            //dd($bid->id);
            // return redirect()->action(
            //   [PaymentGateWayController::class,'payDeposit'], ['id' => 5]
            // );
            //return redirect()->route('depositPay', ['key'=>$key]);

        } catch (Exception $e) {
            //dd($e);
            DB::rollback();
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
        //
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

    public function awarad(Request $request)
    {
        //dd($request->all());

        $product=Product::where('id',$request->productId)->first();

        if ($request->action == 'awardFirstHigest') {
             return $this->awardHighestBidder($product);
        }

        if ($request->action == 'awardSecondHigest') {
            if($this->failBid($product)){
                return $this->awardHighestBidder($product);
            }else {
                return redirect('/home')->with('status', 'Second award is possible only after 24Hrs from awarded time!');
            }
        }

    }

    protected function failBid(Product $product)
    {
        $bid = Bid::where('product_id', $product->id)->where('status', 'AWARDED')->where('awarded_date_time', '<', Carbon::now()->subHour(24))->first();

        if (empty($bid)) {
            return false;
            
        }

        try {
            DB::beginTransaction();

            $bid->status = "FAILED_TO_BUY";
            $bid->save();
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollback();

            return false;
        }
    }

    protected function awardHighestBidder(Product $product)
    {
        $awardedBid = Bid::where('product_id', $product->id)->where('status', 'AWARDED')->orderBy('price', 'desc')->first();
        if(empty($awardedBid)){
            $bid = Bid::where('product_id', $product->id)->where('status', 'COMMIT')->orderBy('price', 'desc')->first();

        }else {

            return redirect('/home')->with('status', 'There is bid already awarded an waiting for buyer response!');

        }

       // $bid = Bid::where('product_id', $product->id)->where('status', 'COMMIT')->orderBy('price', 'desc')->first();
       // dd($bid);

        $todayDate = date('Y-m-d H:i:s');


        try {
            DB::beginTransaction();

            $bid->status = "AWARDED";
            $bid->deposit_status = "BLOCKED";
            $bid->awarded_date_time =$todayDate ;
            $bid->save();

            
            $product->status = "READY_TO_SALE";
            $product->save();
            DB::commit();
            return redirect('/home')->with('status', 'Bid awarded!');
        } catch (Exception $e) {
            DB::rollback();

            return redirect('/home')->with('status', $e->getMessage());
        }
    }


    public function cancellBid($id)
    {

        if ($id > 0) {
            /* 
            01. Here we need to check the bid is under the cancellation period?
            02. Change the bid status to Caccelled 
            03. Refund the deposit to bidder.(made transaction)
            04. change deposit status
            */

            try {

                $bid = Bid::where('id', $id)->where('status', 'COMMIT')->where('created_at', '>', Carbon::now()->subHour())->first();




                if (empty($bid)) {
                    return redirect('/home')->with('status', 'This bid cannot be canceled!');
                }

                //if (auth()->user()->can('update', $bid)) {
                //user is authorized now

                if ($bid->user_id != auth()->user()->id) {
                    return redirect('/home')->with('status', 'You are not authorized to cancell this bid!');
                }

                // dd(auth()->user());

                DB::beginTransaction();

                $bid->status = "CANCELED";
                $bid->deposit_status = "REFUND";
                $bid->save();

                $transaction = new Transaction();
                $transaction->user_id = $bid->user_id;
                $transaction->amount = $bid->deposit;
                $transaction->status = 'SUCCESS';
                $transaction->type = 'debit';
                $transaction->reson = 'DEPOSIT_REFUND';
                $transaction->save();
                DB::commit();
                return redirect('/home')->with('status', 'Bid cancallation success!');
            } catch (Exception $e) {
                DB::rollback();

                return redirect('/home')->with('status', $e->getMessage());
            }
        } else {

            return redirect('/home')->with('status', 'Not a valida bid!');
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
        dd($id);
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
}
