<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Admin\Product;
use App\Models\User;
use App\Models\Payment;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index()
    {
        $cartCollection = \Cart::getContent();
        return view('user.order.index')->with(['cartCollection' => $cartCollection]);
    }

    public function placedOrder(Request $request)
    {
        $user = DB::table('users')->where('id', Auth::user()->id)->first();
        // dd($user);
        $total = \Cart::getSubTotal() + 49;
        // dd($total);
        $order = Order::create([
            'order_number'      =>  'ORD-'.strtoupper(uniqid()),
            'user_id'           => auth()->user()->id,
            'status'            =>  'pending',
            'grand_total'       =>  $total,
            'item_count'        =>  \Cart::getTotalQuantity(),
            'payment_status'    =>  0,
            'name'        =>  auth()->user()->name,
            'address'           =>  $user->address,
            'mobile_no'      =>  $user->mobile_no,
        ]);
    
        if ($order) {
    
            $items = \Cart::getContent();
    
            foreach ($items as $item)
            {
                // A better way will be to bring the product id with the cart items
                // you can explore the package documentation to send product id with the cart
                $product = Product::where('product_name', $item->name)->first();
    
                $orderItem = new OrderItem([
                    'product_id'    =>  $product->id,
                    'quantity'      =>  $item->quantity,
                    'size'          =>  $item->attributes->size,
                    'price'         =>  $item->getPriceSum()
                ]);
    
                $order->items()->save($orderItem);
                \Cart::clear();
            }
        }
        return redirect()->route('order.details', $order->id)->with('success', "Order Placed Successfully!");
    }

    public function orderDetails($id)
    {
        $order = Order::findorfail($id);
        $orderItems = OrderItem::where('order_id', $id)->get();
        return view('user.order.view', compact('order', 'orderItems'));
    }

    function generateHashKey($parameters, $salt, $hashing_method = 'sha512')
    {
    $secure_hash = null;
    ksort($parameters);
    $hash_data = $salt;
    foreach ($parameters as $key => $value) {
    if (strlen($value) > 0) {
    $hash_data .= '|' . trim($value);
    }
    }
    if (strlen($hash_data) > 0) {
    $secure_hash = strtoupper(hash($hashing_method, $hash_data));
    }
    return $secure_hash;
    
    }



    public function payment(Request $request, $id)
    {
        $order = Order::findorfail($id);
        $user = User::where('id', $order->user_id)->first();
        $salt = '7e823710271a098e16fc174e659083e6ae04a2f3'; //Pass your SALT here

        $data = array(
            'api_key' => '52ca9e52-f2f7-482e-a666-9a93836e09c3',
            'order_id' => $order->order_number,
            'mode' => 'LIVE',
            'amount' => $order->grand_total,
            'currency' => 'INR',
            'description' => 'Product Payment',
            'name' => $order->name,
            'email' => $user->email,
            'phone' => $order->mobile_no,
            'city' => $user->city,
            'country' => $user->country, 
            'zip_code' => $user->pincode,
            'return_url' => url('/success') 
            );
            $data['hash'] = $this->generateHash($data,$salt);
            $payment_url = 'https://biz.aggrepaypayments.com/v2/paymentrequest';
            ?>
            <html>
            <body OnLoad="OnLoadEvent();">
            <form name="form1" action="<?php echo $payment_url; ?>" method="post">
                <?php foreach ($data as $key => $value) {
                    echo '<input type="hidden" value="' . $value . '" name="' . $key . '"/>';
                } ?>
            </form>
            <script language="JavaScript">
                function OnLoadEvent() {
                    document.form1.submit();
                }
            </script>
            </body>
            </html>
            <?php
    }

    public function generateHash($input,$salt)
    {

        /* Columns used for generating the hash value */
        $hash_columns = [
            'address_line_1',
            'address_line_2',
            'amount',
            'api_key',
            'city',
            'country',
            'currency',
            'description',
            'email',
            'mode',
            'name',
            'order_id',
            'phone',
            'return_url',
            'state',
            'udf1',
            'udf2',
            'udf3',
            'udf4',
            'udf5',
            'zip_code',
        ];

        /*Sort the array before hashing*/
        ksort($hash_columns);

        /*Create a | (pipe) separated string of all the $input values which are available in $hash_columns*/
        $hash_data = $salt;
        foreach ($hash_columns as $column) {
            if (isset($input[$column])) {
                if (strlen($input[$column]) > 0) {
                    $hash_data .= '|' . $input[$column];
                }
            }
        }

        /* Convert the $hash_data to Upper Case and then use SHA512 to generate hash key */
        $hash = null;
        if (strlen($hash_data) > 0) {
            $hash = strtoupper(hash("sha512", $hash_data));
        }

        return $hash;

    }

    public function paymentSuccess(Request $request)
    {
        $payment = new Payment();
        $payment->order_id = $request->order_id;
        $payment->name = $request->name;
        $payment->email = $request->email;
        $payment->transaction_id = $request->transaction_id;
        $payment->payment_mode = $request->payment_mode;
        $payment->payment_channel = $request->payment_channel;
        $payment->payment_datetime = $request->payment_datetime;
        $payment->response_message = $request->response_message;
        $payment->save();
        
        return view('user.success');
    }

    public function placedOrderDetails()
    {
        $order = DB::table('orders')->where('user_id', Auth::user()->id)->get();
        return view('user.order.placedOrder', compact('order'));
    }


}
