<?php

namespace App\Http\Controllers\Cart;

use Session;
use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Country;
use App\Models\FoodItem;
use App\Models\FoodAddon;
use App\Models\CouponUses;
use App\Models\Ingredient;
use App\Models\FoodVariant; 
use App\Models\FoodGallery;
use App\Models\AddressBook;
use Illuminate\Http\Request;
use App\Models\EmailTemplate;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Concern\GlobalTrait;

class CartController extends Controller
{
    use GlobalTrait;

    public function foodCartModel(Request $request)
    { 
        if($request->ajax())
        { 
        	$picked    = FoodItem::find($request->id);
        	$varient   = FoodVariant::where('food_id', $picked->id)->orderBy('price', 'DESC')->first();
        	$addons    = FoodAddon::where('food_id', $picked->id)->get();
        	$addons_ar = [];
        	foreach ($addons as $key => $addon) {
        		array_push($addons_ar, $addon->addon_food_id);
        	}
            $cooking_levels = Ingredient::where('food_id', $picked->id)->where('type', 'cooking-level')->get();
        	$ingredients    = Ingredient::where('food_id', $picked->id)->where('type', 'ingredient')->get();
        	$all_varients   = FoodVariant::with(['getQuantity'])->where('food_id', $picked->id)->orderBy('price', 'ASC')->get();
        }
        return view('frontend.cart_model', compact('picked', 'varient', 'addons', 'ingredients', 'all_varients', 'cooking_levels'))->render();
    }

    public function cart(Request $request)
    {
        $cart = session()->get('cart');
    	return view('order.cart', compact('cart'));
    }

    public function addFoodToCart(Request $request)
    {
    	$picked_food  = FoodItem::find($request->food_id);
    	$picked_image = FoodGallery::where('food_id', $picked_food->id)->orderBy('id', 'DESC')->first();
    	if(!$picked_food) {
    		$data['type'] = 'success';
            $data['msg']  = 'This Food Item Not Food, Please Try Again Later.';
            return $data;
    	}
    	$cart = session()->get('cart');
    	// if cart is empty then this the first product
        if(!$cart) {
            $cart = [
                    $picked_food->id => [
                    	"id"                 => $picked_food->id,
                        "name"               => $picked_food->name,
                        "image"              => $picked_image ? $picked_image->image : null,
                        "price"              => $request->food_price,
                        "food_varient_id"    => $request->varient_type_id,
                        "ingredients_total"  => $request->addon_price,
                        "ingredients_ids"    => $request->ingredients_ids,
                        "quantity"           => $request->quantity,
                        "total_price"        => $request->total_price,
                        "food_request"       => $request->food_request,
                        "level_id"           => $request->level_id,
                    ]
            ];
            session()->put('cart', $cart);
            $data['type'] = 'success';
            $data['msg']  = 'Product added to cart successfully!';
            return $data;
        }
        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$picked_food->id])) {
        	$data['type'] = 'warning';
            $data['msg']  = 'Product allready added in cart!';
            return $data;
        }
        // if item not exist in cart then add to cart
        $cart[$picked_food->id] = [
            "id"                 => $picked_food->id,
            "name"               => $picked_food->name,
            "image"              => $picked_image ? $picked_image->image : null,
            "price"              => $request->food_price,
            "food_varient_id"    => $request->varient_type_id,
            "ingredients_total"  => $request->addon_price,
            "ingredients_ids"    => $request->ingredients_ids,
            "quantity"           => $request->quantity,
            "total_price"        => $request->total_price,
            "food_request"       => $request->food_request,
            "level_id"           => $request->level_id,
        ];
        session()->put('cart', $cart);
        $data['type'] = 'warning';
        $data['msg']  = 'Product added to cart successfully!';
        return $data;
    }

    public function updateQuality(Request $request)
    {
        if($request->food_id and $request->quantity)
        {
            $cart = session()->get('cart');
            $price                   = $cart[$request->food_id]['price'];
            $ingredients_total_price = $cart[$request->food_id]['ingredients_total'];
            $total_price  = ( $price * $request->quantity ) + $ingredients_total_price;
            $cart[$request->food_id]["quantity"] = $request->quantity;
            $cart[$request->food_id]["total_price"] = $total_price;
            session()->put('cart', $cart);
            $cart = session()->get('cart');
            return view('order.cart-data', compact('cart'))->render();
        }
    }

    public function removeQuality(Request $request)
    {
        if($request->food_id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->food_id])) {
                unset($cart[$request->food_id]);
                session()->put('cart', $cart);
            }
            $cart = session()->get('cart');
            return view('order.cart-data', compact('cart'))->render();
        }
    }

    public function applyCoupon(Request $request)
    {
        $picked_coupon = Coupon::where('code', $request->coupon)->first();
        if(!$picked_coupon) {
            return redirect()->back()->with('error', 'The coupon code you entered is incorrect, please check your coupon code and re-enter');
        }
        if($request->amount < $picked_coupon->min_order) {
            return redirect()->back()->with('error', 'Dear customer your total amount is less, this coupon will be applicable only if your amount is '.$picked_coupon->min_order.' or above '.$picked_coupon->min_order);
        }
        $picked_user_coupon = CouponUses::where('coupon_id', $picked_coupon->id)
            ->where('user_id', \Auth::id())->first();
        if($picked_user_coupon) {
            if($picked_user_coupon->usages == 0){
                return redirect()->back()->with('error', 'Coupon will not apply because the usages limit of your coupon has been reached.');
            }
        }else {
            $picked_user_coupon = CouponUses::create(
                [
                    'user_id'   => \Auth::id(),
                    'coupon_id' => $picked_coupon->id,
                    'usages'    => $picked_coupon->usages
                ]
            );
        }
        $usages = $picked_user_coupon->usages - 1;
        $offer_amount = $request->amount - $picked_coupon->max_discount;
        $discount     = $picked_coupon->discount;
        $picked_user_coupon->update(
            [
                'usages' => $usages
            ]
        );
        return redirect()->route('food.cart', ['o_m' => base64_encode($offer_amount), 'd_a' => base64_encode($picked_coupon->max_discount), 'dis' => base64_encode($discount), 'c_id' => base64_encode($picked_coupon->id)]);
    }

    public function removeCoupon(Request $request)
    {
        $picked_coupon = Coupon::where('id', $request->coupon_id)->first();
        $picked_user_coupon = CouponUses::where('coupon_id', $picked_coupon->id)
            ->where('user_id', \Auth::id())->first();
        if($picked_user_coupon) {
            $usages = $picked_user_coupon->usages + 1;
            $picked_user_coupon->update(
                [
                    'usages' => $usages
                ]
            );
        }
        return redirect()->route('food.cart')->with('success', 'Coupon Removed Successfully.'); 
    }

    public function checkout($coupon_id, $total_price, $offer_price, $discount, $sub_total, $tax, $discount_amount, $tax_discount)
    {
        $coupon_id   = base64_decode($coupon_id);
        $total_price = base64_decode($total_price);
        $offer_price = base64_decode($offer_price);
        $discount    = base64_decode($discount);
        $sub_total    = base64_decode($sub_total);
        $tax    = base64_decode($tax);
        $discount_amount    = base64_decode($discount_amount);
        $tax_discount    = base64_decode($tax_discount);
        $countries = Country::orderBy('name', 'ASC')->get();
        $address_books = AddressBook::where('user_id', \Auth::id())->get();
        return view('order.checkout', compact('coupon_id', 'total_price', 'offer_price', 'discount', 'sub_total', 'tax', 'discount_amount', 'tax_discount', 'countries', 'address_books'));
    }

    public function createOrder(Request $request)
    {
        $request->validate(
            [
                'total_price'     => 'required|numeric',
                'offer_price'     => 'required|numeric',
                'payment_mode'    => 'required',
                'name'            => 'required|max:150',
                'email'           => 'required|email',
                'mobile_number'   => 'required|numeric|digits_between:10, 15',
                'country'         => 'required',
                'state'           => 'required',
                'city'            => 'required',
                'address'         => 'required|max:190',
                'pincode'         => 'required|numeric|digits_between:6, 8',
            ]
        );
        if($request->has('address_save')) {
            AddressBook::create(
                [
                    'user_id'       => \Auth::id(),
                    'type'          => 'Shipping',
                    'country_id'    => $request->country,
                    'state_id'      => $request->state,
                    'city_id'       => $request->city,
                    'address'       => $request->address,
                    'pincode'       => $request->pincode,
                    'mobile_number' => $request->mobile_number,
                    'set_as_default'=> 'No'
                ]
            );
        }
        $random     = rand(1000, 9999);
        $year       = date('Y');
        $order_id   = 'ODR'.$random.$year;
        $invoice_id = 'IID'.$random.$year;
        $cart = json_encode(session()->get('cart'));
        $order = Order::create(
            [
                'order_id'      => $order_id,
                'invoice_id'    => $invoice_id,
                'user_id'       => \Auth::id(),
                'coupon_id'     => $request->coupon_id == 0 ? null : $request->coupon_id,
                'cart'          => $cart,
                'name'          => $request->name,
                'email'         => $request->email,
                'mobile_number' => $request->mobile_number,
                'country_id'    => $request->country,
                'state_id'      => $request->state,
                'city_id'       => $request->city,
                'address'       => $request->address,
                'total_amount'  => $request->total_price,
                'offer_amount'  => $request->offer_price,
                'discount'      => $request->discount == 0 ? null : $request->discount,
                'tax_amount'    => $request->tax_amount,
                'tax_percent'   => $request->tax_percent,
                'discount_amount'=> $request->discount_amount == 0 ? null : $request->discount_amount,
                'payment_method' => $request->payment_method,
                'delivery_type'  => 'home-delivery',
            ]
        );

        // Send Order Placed Mail To User
        $_template = EmailTemplate::where('code', 'ORDERCREATEDBYUSER-5003')->where('status', 'Yes')->first();
        if($_template) {
            $button_temp = null;
            if($_template->button) {
                $link        = url('');  
                $buttn_var   = array('#LINK' => $link);
                $button_temp = $this->modifyTemplateButton($_template->button_html, $buttn_var);
            }
            $replacetemplate = Array(
                '#NAME'       => $order->name,
                '#ORDER-ID'   => $order->order_id,
                '#BUTTON'     => $button_temp
            );
            $check = $this->__sendEmail($order, $_template->template, $_template->subject, $_template->image, $replacetemplate);
        }

        // Send Order Placed Mail To Admin
        $admin = User::where('role', 'admin')->first();
        $a_template = EmailTemplate::where('code', 'ORDERGENEARTED-8913')->where('status', 'Yes')->first();
        if($a_template) {
            $button_temp = null;
            if($a_template->button) {
                $link        = url('');  
                $buttn_var   = array('#LINK' => $link);
                $button_temp = $this->modifyTemplateButton($a_template->button_html, $buttn_var);
            }
            $replacetemplate = Array(
                '#NAME'       => $admin->name,
                '#USERNAME'   => $order->name,
                '#ORDER-ID' => $order->order_id,
                '#BUTTON'     => $button_temp
            );
            $this->__sendEmail($admin, $a_template->template, $a_template->subject, $a_template->image, $replacetemplate);
        }
        // Send Database Admin Notifications
        $admin_msg = 'New order is generated by '.$order->name.' . The order id is '.$order->order_id;
        $check = $this->_sendAdminDbNotifications('new-order', $admin_msg, $order);
        \Session::flush();
        return redirect('order/success/'.$order->id)->with('success', 'Thank You, Your request has been registered in our system, please wait you will be contacted from our office.');
    }

    public function orderSuccess($id) {
        dd($id);
    }

}
