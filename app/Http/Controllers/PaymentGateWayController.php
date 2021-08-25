<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Bid;
use App\Models\Transaction;
use Exception;
use Illuminate\Support\Carbon;


class PaymentGateWayController extends Controller
{
    public function payDeposit($id)
    {

        dd($id);
    }

    public function paymentGateWay()
    {
        $msgString = "";
        $paymentAmount = 0;

        $annualFeePaid = User::annualFeeExpire(auth()->user()->id);

        if (!auth()->user()->registration_fee_paid && !$annualFeePaid) {
            $msgString = " registration payment and annual payment to continue";
            $paymentAmount = 650;
        }
        if (!$annualFeePaid && auth()->user()->registration_fee_paid) {
            $msgString = " annual payment to continue";
            $paymentAmount = 400;
        }

        if (!auth()->user()->registration_fee_paid && $annualFeePaid) {
            $msgString = " registration payment to continue";
            $paymentAmount = 250;
        }


        $userPaymentInfo = [
            "id" => auth()->user()->id,
            "name" => auth()->user()->name,
            "paymentAmount" => $paymentAmount,
            "msgString" => $msgString,
        ];


        // dd("Here payemnt gateway...");
        return view('feepay', compact('userPaymentInfo'));
    }


    public function madeDepositPay(Request $request)
    {

        // dd($request->all());

        $bid = Bid::find($request->bidId);

        DB::beginTransaction();

        try {
            if ($bid) {
                $bid->deposit = $request->depositAmount;
                $bid->status = "COMMIT";
                $bid->deposit_status = "PAID";
                $bid->save();

                $transaction = new Transaction();
                $transaction->user_id = $bid->user_id;
                $transaction->amount = $request->depositAmount;
                $transaction->status = 'SUCCESS';
                $transaction->type = 'credit';
                $transaction->reson = 'DEPOSIT';
                $transaction->save();
            } else {

                throw new \Exception("No a valid bid");
            }



            DB::commit();

            return redirect('/home')->with('status', 'Bid succefully committed!');

            //return redirect('/home');
        } catch (Exception $e) {
            //dd($e);
            DB::rollback();
            return back()->withErrors([$e->getMessage()]);
        }
    }
    public function paymentFee(Request $request)
    {

        if ($request->isMethod('POST')) {
            //dd($request->all());


            $this->validator($request->all())->validate();

            /* 
           Here need to pass cc data to simulation payment gateway
           
           */
            $registration_fee_paid = auth()->user()->registration_fee_paid;
            $annual_fee_paid = auth()->user()->annual_fee_paid;
            $annualExpireDate = $annual_fee_paid;

            // calculate annaual fee expire date 
            if ($annual_fee_paid == Null) {

                $currentDateTime = Carbon::now();
                $annualExpireDate = Carbon::now()->addDays(365);
            } else {
                $dateString = $annual_fee_paid;
                $t = strtotime($dateString);
                $annualExpireDate = date('Y-m-d H:m:s', strtotime('+365 days', $t));
            }

            $transDefaultArray = [
                'user_id' => auth()->user()->id,
                'type' => 'credit',
                'status' => 'SUCCESS'
            ];
            // dd($transDefaultArray);


            DB::beginTransaction();

            try {

                if ($request->amount == 650) {
                    $registration_fee_paid = true;
                    $annual_fee_paid = $annualExpireDate;
                    $regfee = new Transaction;
                    $regfee->fill($transDefaultArray);
                    $regfee->amount = '250.00';
                    $regfee->reson = 'Registration_fee';
                    // dd($regfee);
                    $regfee->save();

                    $annualfee = new Transaction;
                    $annualfee->fill($transDefaultArray);
                    $annualfee->amount = '400.00';
                    $annualfee->reson = 'Annaul_fee';
                    $annualfee->save();
                }
                if ($request->amount == 250) {
                    $registration_fee_paid = true;
                    $regfee = new Transaction;
                    $regfee->fill($transDefaultArray);
                    $regfee->amount = '250.00';
                    $regfee->reson = 'Registration_fee';
                    $regfee->save();
                }
                if ($request->amount == 400) {
                    $annual_fee_paid = $annualExpireDate;
                    $annualfee = new Transaction;
                    $annualfee->fill($transDefaultArray);
                    $annualfee->amount = '400.00';
                    $annualfee->reson = 'Annaul_fee';
                    $annualfee->save();
                }
                //dd($request->all());
                User::where('id', $request->uesrId)
                    ->update([
                        'registration_fee_paid' => $registration_fee_paid,
                        'annual_fee_paid' => $annual_fee_paid,
                    ]);

                DB::commit();

                return redirect('/home');
            } catch (Exception $e) {
                //dd($e);
                DB::rollback();
                return back()->withErrors([$e->getMessage()]);
            }
            // dd($request->all());

        }
    }

    protected function validator(array $data)
    {
        $todayDate = date('m/d/Y');
        return Validator::make($data, [
            'nameOnCard' => 'required|string|min:3',
            'cardNumber' => 'string|max:16|min:16',
            'expireDate' => 'required|date_format:m/d/Y|after_or_equal:' . $todayDate,
            'cvv' => 'string|max:3|min:3',
        ]);
    }
}
