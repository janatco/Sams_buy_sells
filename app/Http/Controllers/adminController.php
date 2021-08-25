<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Complaint;
use App\Models\Product;
use App\Models\Bid;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class adminController extends Controller
{
    public function index()
    {
        $users=User::orderBy('created_at','DESC')->with('complaints')->get();
        //dd($users);

        return view('admin.admin_dashboard',compact('users'));
    }

    public function viewBlackListUser()
    {
        $users=User::orderBy('created_at','DESC')->where('status','BLACK_LIST')->with('complaints')->get();
        //dd($users);
        return view('admin.user_details',compact('users'));

        
    }

    public function userStatusToBlackList($userId)
    {
        $user = User::where('id', $userId)->first();

        if (empty($user)) {
            return redirect('/admin')->with('status', 'invalid user!');
        }

        try {
            DB::beginTransaction();
            $user->status = "BLACK_LIST";
            $user->save();
            DB::commit();
            return redirect('/admin')->with('status', $user->name."- add to black list!");

        } catch (\Exception $e) {
            DB::rollback();

            return redirect('/admin')->with('status', $e->getMessage());
        }
        //dd($users);

        return view('admin.admin_dashboard',compact('users'));
    }

    public function userUnblock($userId)
    {
        $user = User::where('id', $userId)->first();

        if (empty($user)) {
            return redirect('/admin')->with('status', 'invalid user!');
        }

        try {
            DB::beginTransaction();
            $user->status = "ACTIVE";
            $user->save();
            DB::commit();
            return redirect('/admin')->with('status', $user->name."- add to black list!");

        } catch (\Exception $e) {
            DB::rollback();

            return redirect('/admin')->with('status', $e->getMessage());
        }
        //dd($users);

        return view('admin.admin_dashboard',compact('users'));
    }

    public function viewComplaints($userId)
    {
        $compliants  = Complaint::where('user_id', $userId)->with('user')->with('logBy')->get();

        dd($compliants);

        return view('admin.user_complaints',compact('compliants'));
    }

    public function viewProductDetails()
    {
        $products = Product::orderBy('created_at','DESC')->with('seller')->get();

        //dd($products);

        return view('admin.product_details',compact('products'));
    }

    public function viewAllBids()
    {
        $bids = Bid::orderBy('created_at','DESC')->with('bidder')->with('product')->get();

        //dd($bids);

        return view('admin.bids_admin',compact('bids'));
    }

    public function viewAllTransactions()
    {
        $transactions = Transaction::orderBy('created_at','DESC')->with('user')->get();

        //dd($transactions);

        return view('admin.transactions_admin',compact('transactions'));
    }

    public function viewAllComplaints()
    {
        $compliants = Complaint::orderBy('created_at','DESC')->with('user')->with('logBy')->get();

        //dd($compliants);

        return view('admin.user_feedback_admin',compact('compliants'));
    }
    

}
