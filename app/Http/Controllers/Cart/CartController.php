<?php

namespace App\Http\Controllers\Cart;

use Session;
use App\Models\FoodItem;
use App\Models\FoodAddon;
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
        	$ingredients  = FoodItem::whereIn('id', $addons_ar)->get();
        	$all_varients = FoodVariant::with(['getQuantity'])->where('food_id', $picked->id)->orderBy('price', 'ASC')->get();
        }
        return view('frontend.cart_model', compact('picked', 'varient', 'addons', 'ingredients', 'all_varients'))->render();
    }

    public function addFoodToCart(Request $request)
    {
    	$picked_food  = FoodItem::find($request->food_id);
    	$picked_image = FoodItem::where('food_id', $picked_food->id)->orderBy('id', 'DESC')->first();
    	if(!$picked_food) {
    		return redirect()->back()->with('success', 'This Food Item Not Food, Please Try Again Later.');
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
                        "ingredients_ids"    => $request->varient_ids,
                        "quantity"           => $request->quantity,
                        "total_price"        => $request->total_price,
                        "food_request"       => $request->food_request,
                    ]
            ];
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$id])) {
            return redirect()->back()->with('warning', 'Product allready added in cart!');
        }
        // if item not exist in cart then add to cart
        $cart[$picked_food->id] = [
            "id"                 => $picked_food->id,
            "name"               => $picked_food->name,
            "image"              => $picked_image ? $picked_image->image : null,
            "price"              => $request->food_price,
            "food_varient_id"    => $request->varient_type_id,
            "ingredients_total"  => $request->addon_price,
            "ingredients_ids"    => $request->varient_ids,
            "quantity"           => $request->quantity,
            "total_price"        => $request->total_price,
            "food_request"       => $request->food_request,
        ];
        session()->put('cart', $cart);
    	return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
}
