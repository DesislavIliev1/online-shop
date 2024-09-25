<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(UpdateProductRequest $request, Product $product)
    // {
    //     try {
    //         Log::channel('uploadAd')->info('Product update attempt', ['product_id' => $product->id]);
    //         $result = $product->update($data);
            

    //         $this->recache($product->id);
    //         $this->recacheHomepage($product->id);

    //         Log::channel('uploadAd')->info('Product updated successfully', ['product_id' => $product->id]);
    //         return $result;
    //     } catch (\Exception $e) {
    //         Log::channel('uploadAd')->error('Product update failed', ['product_id' => $product->id, 'error' => $e->getMessage()]);
    //         return false;
    //     }
    // }

    /**
     * Remove the specified resource from storage.
     */
//     public function destroy(Product $product)
//     {
//         try {
//             $result = $product->delete();
//             $this->recache($product->id);
//             $this->recacheHomepage($product->id);
//             Log::channel('uploadAd')->info('Product deleted successfully', ['product_id' => $product->id]);
//             return $result;
//         } catch (\Exception $e) {
//             Log::channel('uploadAd')->error('Product deletion failed', ['product_id' => $product->id, 'error' => $e->getMessage()]);
//             return false;
//         }
//     }

//     private function recache($id = null): void
//     {
//         if ($id) {
//             $product = Product::with(['user', 'location'])->find($id);

//             if ($product) {
//                 $products = Cache::get('products.all_with_relations', collect());
//                 $products = $products->reject(function ($item) use ($id) {
//                     return $item->id == $id;
//                 });

//                 $products->push($product);
//                 Cache::put('products.all_with_relations', $products, now()->addDays(2));
//             }
//         } else {
//             $products = Product::with(['user', 'location'])->get();
//             Cache::put('products.all_with_relations', $products, now()->addDays(2));
//         }
//     }
}
