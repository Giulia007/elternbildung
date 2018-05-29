<?php

namespace App\Http\Controllers;

use App\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\Subscriptions;
use Illuminate\Support\Facades\Session;

class MembershipController extends Controller
{
    use Subscriptions;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('pages.membership');
    }


    public function checkVoucher(Request $request)
    {

        $request_data = $request->validate([
            'voucher_code' =>    'required',
        ]);

        $voucher_code = $request_data['voucher_code'];

        if ($voucher_code) {

            $url = 'voucher';
            $vouchers = $this->getFromWP($url);

            //loop through WP vouchers list
            foreach ($vouchers as $voucher) {

                //check if voucher is in vouchers' list
                if ($voucher_code === $voucher['title']['rendered']) {

                    $current_date = strtotime(date("d-m-Y"));

                    //retrieve expiration date
                    $voucher_date = strtotime(trim(strip_tags($voucher['content']['rendered'])));

                    //and if it is not expired
                    if ($voucher_date > $current_date) {

                        //check voucher
                        $user_id = Auth::id();
                        $subscription = $this->checkVoucherSubscription($voucher_code);

                        //if the voucher is already in the subscriptions table, redirect with message
                        if ($subscription == 'used') {
                            Session::flash('message', 'The voucher code entered has been already used!');
                            Session::flash('code', 'primary');
                            return redirect('membership');
                        }

                        //if the voucher hasn't been used yet, create subscription and redirect with success message
                        if ($subscription != 'used') {

                            if ($this->createSubscription($user_id, $voucher_code)) {
                                Session::flash('message', 'Your subscription is now active! Please start browsing the contents.');
                                Session::flash('code', 'success');
                                return redirect('/membership');
                            }
                        }
                    }

                    //if the entered voucher is found but it is expired redirect with message
                    Session::flash('message', 'The voucher entered is already expired!');
                    Session::flash('code', 'primary');
                    return redirect('membership')->with('expired', 'The voucher entered is already expired!');
                }
            }
            //if the entered voucher is not found redirect with message
            Session::flash('message', 'The voucher code entered is not valid! Please check and try again.');
            Session::flash('code', 'primary');
            return redirect('membership');
        }
    }


    public function checkVoucherSubscription($voucher_code)
    {
        //the entered voucher has already been used for a subscription
        if (Subscription::where('voucher_code', $voucher_code)->first()) {
            return 'used';
        }
    }

}
