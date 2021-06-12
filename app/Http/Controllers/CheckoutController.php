<?php

namespace App\Http\Controllers;

use Mail;
use App\Mail\TransactionSuccess;

use App\Transaction;
use App\TransactionDetail;
use App\TravelPackage;

use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Midtrans\Config;
use Midtrans\Snap;
use PhpParser\Node\Stmt\TryCatch;

class CheckoutController extends Controller
{
    public function index(Request $request, $id)
    {
        $item = Transaction::with(['details', 'travel_package', 'user'])->FindorFail($id);

        return view('pages.checkout', [
            'item' => $item
        ]);
    }

    public function process(Request $request, $id)
    {
        $travel_package = TravelPackage::findorFail($id);

        $transaction = Transaction::create([
            'travel_packages_id'     => $id,
            'users_id'              => auth::user()->id,
            'additional_visa'       => 0,
            'transaction_total'     => $travel_package->price,
            'transaction_status'    => 'IN_CART'
        ]);

        TransactionDetail::create([
            'transactions_id' => $transaction->id,
            'username'        => auth::user()->username,
            'nationality'     => 'ID',
            'is_visa'         => false,
            'doe_passport'    => Carbon::now()->addYears(5)
        ]);

        return redirect()->route('checkout', $transaction->id);
    }

    public function remove(Request $request, $detail_id)
    {
        $item = TransactionDetail::findorFail($detail_id);

        $transaction = Transaction::with(['details', 'travel_package'])->findorFail($item->transactions_id);

        if ($item->is_visa) {
            $transaction->transaction_total -= 190;
            $transaction->additional_visa -= 190;
        }
        $transaction->transaction_total -= $transaction->travel_package->price;
        //script save
        $transaction->save();
        //hapus item
        $item->delete();

        return redirect()->route('checkout', $item->transactions_id);
    }

    public function create(Request $request, $id)
    {
        $request->validate([
            'username'      => 'required|string',
            'is_visa'       => 'required|boolean',
            'doe_passport'  => 'required'
        ]);

        $data = $request->all();
        $data['transactions_id'] = $id;

        TransactionDetail::create($data);

        $transaction = Transaction::with(['travel_package'])->find($id);

        //update
        if ($request->is_visa) {
            $transaction->transaction_total += 190;
            $transaction->additional_visa += 190;
        }
        $transaction->transaction_total += $transaction->travel_package->price;
        //script save
        $transaction->save();

        return redirect()->route('checkout', $id);
    }

    public function success(Request $request, $id)
    {
        $transaction = Transaction::with(['details', 'travel_package.galleries', 'user'])->findorFail($id);
        $transaction->transaction_status = 'PENDING';

        $transaction->save();

        // //set konfigurasi midtrans
        Config::$serverKey      = config('midtrans.serverKey');
        Config::$isProduction   = config('midtrans.isProduction');
        Config::$isSanitized    = config('midtrans.isSanitized');
        Config::$is3ds          = config('midtrans.is3ds');

        //buat array untuk dikirim ke midtrans
        $midtrans_params = [
            'transaction_details'   => [
                'order_id'          => 'GODREAM-' . $transaction->id,
                'gross_amount'      => (int) $transaction->transaction_total
            ],
            'customer_details'  => [
                'first_name'    => $transaction->user->name,
                'email'         => $transaction->user->email
            ],
            'enabled_payments'  => ['gopay'],
            'vtweb'             => [],
        ];


        try {
            //ambil halaman payment midtrans
            $paymentUrl = Snap::createTransaction($midtrans_params)->redirect_url;

            //redirect ke halaman midtrans
            return redirect($paymentUrl);
            // Redirect to Snap Payment Page
            // header('Location: ' . $paymentUrl);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        // return $transaction; 
        //kirim email ke user, e-tiketnya
        // Mail::to($transaction->user)->send(
        //     new TransactionSuccess($transaction)
        // );
        // return view('pages.success');
    }
}
