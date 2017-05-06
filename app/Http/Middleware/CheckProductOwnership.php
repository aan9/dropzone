<?php

namespace App\Http\Middleware;

use Closure;
use App\Product;

class CheckProductOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //dapatkan produk id dri url
        $product_id = $request->product;

        //dd($product_id);

        //dptkan produk info based on product_id
        $product = Product::find($product_id);

        if ($product) {

            //dapatkan user_id produk tersebut
            $product_owner = $product->user_id;

            //dapatkan current logged in user id
            $current_user_id = auth()->id();

            if ($current_user_id!=$product_owner) {
                dd("KO NAK BUAT APA NI HAH?!");
            }
        }
        return $next($request);
    }
}
