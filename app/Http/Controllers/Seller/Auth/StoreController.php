<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\StoreDatatable;
use App\Models\Store;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Seller\StoreRequest;
use App\Repositories\Seller\StoreRepository;
use App\Http\Requests\Seller\UpdateStoreRequest;
use App\Models\MembershipPlan;
use App\Models\Payment;
use App\Models\PaymentCustomer;
use App\Models\UserPlan;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
   public function __construct(StoreRepository $Store)
   {
      $this->Store = $Store;
   }

   public function showStoreList(StoreDatatable $StoreDatatable)
   {
      return $StoreDatatable->render('Seller.Store.list-store');
   }

   public function addStore()
   {
      $plans = MembershipPlan::where('status', 0)->get();
      return view('Seller.Store.create-store', compact('plans'));
   }

   public function createStore(StoreRequest $request)
   {
      $data = $this->Store->createstore($request->all());
      return redirect()->route('seller.store_list', compact('data'));
   }

   public function enName(Request $request)
   {
      if ($request->get('en_name')) {
         $en_name = $request->get('en_name');
         $data = DB::table("stores")->where('en_name', $en_name)->count();
         if ($data > 0) {
            return 'Name_Exists';
         } else {
            return 'Unique';
         }
      }
   }
   public function arName(Request $request)
   {
      if ($request->get('ar_name')) {
         $ar_name = $request->get('ar_name');
         $data = DB::table("stores")->where('ar_name', $ar_name)->count();
         if ($data > 0) {
            return 'Name_Exists';
         } else {
            return 'Unique';
         }
      }
   }

   public function showStore($id)
   {
      $showStore = $this->Store->showStore($id);
      return view('Seller.Store.show-store', compact('showStore'));
   }
   public function editStore($id)
   {
      $showStore = $this->Store->editStore($id);
      return view('Seller.Store.edit-store', compact('showStore'));
   }

   public function updateStore(UpdateStoreRequest $request, $id)
   {
      $data = $this->Store->updateStore($request->all(), $id);
      return redirect()->route('seller.store_list', compact('data'));
   }

   public function storeStatus(Request $request)
   {
      $id = $request['id'];
      $store = Store::find($id);

      if ($store->status == "0") {
         $store->status = "1";
      } else {
         $store->status = "0";
      }
      $store->save();
      return $store;
   }

   public function deleteStore($id)
   {
      $store = $this->Store->deleteStore($id);
      return $store;
   }

   public function paymentPage(Request $request)
   {
      $plan = MembershipPlan::where('id', $request->id)->first();
      $userPlan = UserPlan::updateOrCreate(
         [
            'seller_id' => Auth::guard('seller')->user()->id,
            'membership_plan_id' => $request->id,
         ],
         [
            'package_name' => $plan->en_package_name,
            'price' => $plan->price,
            'duration' => $plan->duration,
            'status' => '0',
         ]
      );

      Payment::updateOrCreate(
         [
            'product_name' => $plan->en_package_name,
            'plan_amount' => $plan->price,
         ],
      );
      return $userPlan;
   }

   public function payment(Request $request)
   {
      // dd($request->stripeToken);
      $stripe = new \Stripe\StripeClient(
         env('STRIPE_SECRET')
      );

      // Customer
      $customer = $stripe->customers->create([
         'name' => $request->card_name,
      ]);
      
      //create product
      $stripeProduct = $stripe->products->create([
         'name' =>  'GSP',
      ]);
      
      // plan
      $plans = $stripe->plans->create([
         'amount' => 100 * 100,
         "currency" => "INR",
         'interval' => 'month',
         'product' => $stripeProduct->id,
      ]);
      
      $stripepublic = new \Stripe\StripeClient(env('STRIPE_KEY'));
      $paymentMethods = $stripepublic->paymentMethods->create([
         'type' => 'card',
         'card' => [
            'number' => 4242424242424242,
            'exp_month' => 12,
            'exp_year' => 24,
            'cvc' => 123,
         ],
      ]);
      
      // create customer
      $customercreate = $stripe->customers->create([
         'description' => 'Subscription',
         'email' => $request->email,
         'payment_method' => $paymentMethods->id,
         'invoice_settings'  => [
            'default_payment_method' => $paymentMethods->id,
         ],
      ]);
      
      // create subscription
      $subscriptions =  $stripe->subscriptions->create([
         'customer' => $customercreate->id,
         'items' => [
            ['price' => $plans->id],
         ],
         'expand' => ['latest_invoice.payment_intent'],
      ]);
      return redirect()->route('seller.add_store');
      // ========================================
      // $payment_customer = PaymentCustomer::where('name', $request->card_name)->where('email', $request->email)->count();
      // if ($payment_customer == null) {

      //    // Customer
      //    $customer = $stripe->customers->create([
      //       'name' => $request->card_name,
      //    ]);
      //    PaymentCustomer::updateOrCreate(
      //       [
      //          'seller_id' => Auth::user()->id,
      //          'name' => $request->card_name,
      //       ],
      //       [
      //          'email' => $request->email,
      //          'card_number' => $request->card_number,
      //          'cvv' => $request->cvv,
      //          'expiration_month' => $request->expiration_month,
      //          'expiration_year' => $request->expiration_year,
      //          'transaction_id' => $customer->id,
      //       ],
      //    );
      // }

      // $plan = Payment::latest('id', 'price')->first();
      // if ($plan->product_id == NULL) {
      //    $p = PaymentCustomer::where('seller_id', Auth::user()->id)->select('id')->first();
      //    // product
      //    $product = $stripe->products->create([
      //       'name' => $plan->product_name,
      //    ]);
      //    // dd($product);

      //    // plan
      //    $plans = $stripe->plans->create([
      //       'amount' => (int)$plan->plan_amount * 100,
      //       "currency" => "INR",
      //       'interval' => 'month',
      //       'product' => 'prod_LBwKKe8hWp7ZLn'
      //    ]);
      //    // dd($plans);

      //    $stripepublic = new \Stripe\StripeClient(env('STRIPE_KEY'));
      //    $paymentMethods = $stripepublic->paymentMethods->create([
      //       'type' => 'card',
      //       'card' => [
      //          'number' => 4242424242424242,
      //          'exp_month' => 12,
      //          'exp_year' => 2024,
      //          'cvc' => 123,
      //       ],
      //    ]);

      //    $customercreate = $stripe->customers->create([
      //       'description' => 'Subscription',
      //       'email' => $request->email,
      //       'payment_method' => $paymentMethods->id,
      //       'invoice_settings'  => [
      //          'default_payment_method' => $paymentMethods->id,
      //       ],
      //    ]);

      //    $subscriptions =  $stripe->subscriptions->create([
      //       'customer' => $customercreate->id,
      //       'items' => [
      //          ['price' => $plans->id],
      //       ],
      //       'expand' => ['latest_invoice.payment_intent'],
      //    ]);
      //    // dd($subscriptions);

      //    Payment::updateOrCreate(
      //       [
      //          'product_name' => 'silver',
      //       ],
      //       [
      //          'payment_customer_id' => $p->id,
      //          'balance_transaction' => $request->stripeToken,
      //          'description' => 'Subscriptions',
      //          'plan_currency' => $plan->currency,
      //          'plan_interval' => $plan->interval,
      //          'subscription_id' => $subscriptions->id,
      //       ]
      //    );
      // }

      // Product

      // $charges = $stripe->charges->create([
      //     "amount" => (int)$plan->price * 100,
      //     "currency" => "INR",
      //     "source" => $request->stripeToken,
      //     "description" => "Test payment from expert ishani 2"
      // ]);
   }
}
