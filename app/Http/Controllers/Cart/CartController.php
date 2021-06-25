<?php

namespace App\Http\Controllers\Cart;

use Session;
use App\Models\FoodItem;
use App\Models\FoodAddon;
use App\Models\Ingredient;
use App\Models\FoodVariant; 
use App\Models\FoodGallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
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

    public function cart()
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
}
