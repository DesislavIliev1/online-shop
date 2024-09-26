<?php

declare(strict_types=1);

namespace App\Services;


use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Session;

class ProductService
{
   
    public function __construct( )
    {
       
    }

    public function getProducts(){
        $products = Product::all()->get();
        
      return $products;
    }

    /**
     * Get all products with their relationships.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    // public function getAllProductsWithRelations(int $paginate = 24)
    // {
    //     return Cache::remember('products.all_with_relations', now()->addDays(2), function () use ($paginate) {
    //         return Product::with(['user', 'location'])->paginate($paginate);
    //     });
    // }

    /**
     * Get a product with its relationships by slug.
     *
     * @param string $slug
     * @return Product
     */
    // public function getProductWithRelationsBySlug(string $slug): Product
    // {
    //     return $this->getProductWithRelations('slug', $slug, ['user', 'location', 'category', 'characteristics.brand', 'characteristics.model', 'characteristics.modification']);
    // }

    /**
     * Get a product with its relationships by a given field.
     *
     * @param string $field
     * @param mixed $value
     * @param array $relations
     * @return Product
     */
    // private function getProductWithRelations(string $field, $value, array $relations): Product
    // {
    //     $products = Cache::remember('products.all_with_relations', now()->addDays(2), function () use ($relations) {
    //         return Product::with($relations)->get();
    //     });

    //     $product = $products->where($field, $value)->first();
    //     if (!$product) {
    //         $product = Product::with($relations)->where($field, $value)->first();
    //         if ($product) {
    //             $products->push($product);
    //             Cache::put('products.all_with_relations', $products, now()->addDays(2));
    //         }
    //     }

    //     if (Auth::check()) {
    //         $userId = Auth::id();

    //         $likedProductIds = Cache::remember('user_' . $userId . '_liked_products', now()->addMinutes(30), function () use ($userId) {
    //             return UserFavorite::where('user_id', $userId)
    //                             ->pluck('product_id')
    //                             ->toArray();
    //         });

    //         $product->is_liked = in_array($product->id, $likedProductIds);
    //     }

    //     return $product;
    // }

    /**
     * Get suggested products based on the provided product.
     *
     * @param Product $product
     * @return \Illuminate\Database\Eloquent\Collection
     */
    // public function getSuggestedProducts(Product $product)
    // {
    //     return Cache::remember('products.suggested.' . $product->id, now()->addDays(2), function () use ($product) {
    //         return Product::with('category')
    //             ->where('category_id', $product->category_id)
    //             ->where('id', '!=', $product->id)
    //             ->inRandomOrder()
    //             ->limit(4)
    //             ->get();
    //     });
    // }

    /**
     * Get products for the homepage.
     *
     * @param int $paginate
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    // public function getProductsForHomepage(int $paginate = 24)
    // {
    //     $products = Cache::remember('products.for_homepage_page_' . request('page', 1), now()->minutes(30), function () use ($paginate) {
    //         return Product::with('category')->latest()->paginate($paginate);
    //     });

    //     if (Auth::check()) {
    //         $userId = Auth::id();

    //         $likedProductIds = Cache::remember('user_' . $userId . '_liked_products', now()->addMinutes(30), function () use ($userId) {
    //             return UserFavorite::where('user_id', $userId)
    //                             ->pluck('product_id')
    //                             ->toArray();
    //         });

    //         $products->getCollection()->transform(function ($product) use ($likedProductIds) {
    //             $product->is_liked = in_array($product->id, $likedProductIds);
    //             return $product;
    //         });
    //     }

    //     return $products;
    // }

    /**
     * Get products by category slug for the category page and its children.
     *
     * @param string $slug
     * @param int $paginate
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    // public function getProductsByCategorySlug(string $slug, int $paginate, int $page)
    // {
    //     return Cache::remember('products.by_category.' . $slug . '.page_' . $page, now()->addDays(2), function () use ($slug, $paginate, $page) {
    //         $category = $this->categoryService->getCategoryBySlug($slug)->load('children');
    //         $categoryIds = $category->children->pluck('id')->push($category->id);

    //         return Product::with(['user',])
    //             ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
    //             ->leftJoin('car_characteristics', 'products.id', '=', 'car_characteristics.product_id')
    //             ->leftJoin('car_engines', 'car_characteristics.engine_id', '=', 'car_engines.id')
    //             ->leftJoin('locations', 'products.location_id', '=', 'locations.id')
    //             ->select(
    //                 'products.*',
    //                 'categories.name as category_name',
    //                 'locations.name as location_name',
    //                 'car_characteristics.*',
    //                 'car_engines.engine_type'
    //             )
    //             ->whereIn('category_id', $categoryIds)
    //             ->paginate($paginate, ['*'], 'page', $page);
    //     });
    // }

    

    
    /**
     * Create a new product.
     *
     * @param array $datadobre
     * @return Product
     */
    public function createProduct(array $data, Request $request): mixed
    {
        try {
            Log::channel('uploadAd')->info('Product creation attempt', $data);
            $data['user_id'] = Auth::id();

            if ($request->has('uploaded_images')) {
                $imageFileNames = $request->input('uploaded_images');
                $data['image'] = json_encode($imageFileNames);
            }
            
            $product = Product::create($data);
            $ipAddress = request()->ip();
           
            $this->recache($product->id);

            Log::channel('uploadAd')->info('Product created successfully', ['product_id' => $product->id]);

            return $product;
        } catch (\Exception $e) {
            Log::channel('uploadAd')->error('Product creation failed', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to create product.'], 500);
        }
    }

    /**
     * Update an existing product.
     *
     * @param Product $product
     * @param array $data
     * @return bool
     */
    public function updateProduct(Product $product, array $data): bool
    {
        try {
            Log::channel('uploadAd')->info('Product update attempt', ['product_id' => $product->id]);
            $result = $product->update($data);
           
            $this->recache($product->id);

            Log::channel('uploadAd')->info('Product updated successfully', ['product_id' => $product->id]);
            return $result;
        } catch (\Exception $e) {
            Log::channel('uploadAd')->error('Product update failed', ['product_id' => $product->id, 'error' => $e->getMessage()]);
            return false;
        }
    }

    /**
     * Delete a product.
     *
     * @param Product $product
     * @return bool
     */
    public function deleteProduct(Product $product): bool
    {
        try {
            $result = $product->delete();
            $this->recache($product->id);
            Log::channel('uploadAd')->info('Product deleted successfully', ['product_id' => $product->id]);
            return $result;
        } catch (\Exception $e) {
            Log::channel('uploadAd')->error('Product deletion failed', ['product_id' => $product->id, 'error' => $e->getMessage()]);
            return false;
        }
    }

    /**
     * Recache the products.
     * If an ID is provided, only that product with the same ID will be recached.
     * If no ID is provided, all products will be recached.
     *
     * @param int|null $id
     * @return void
     */
    private function recache($id = null): void
    {
        if ($id) {
            $product = Product::with(['user', 'location'])->find($id);

            if ($product) {
                $products = Cache::get('products.all_with_relations', collect());
                $products = $products->reject(function ($item) use ($id) {
                    return $item->id == $id;
                });

                $products->push($product);
                Cache::put('products.all_with_relations', $products, now()->addDays(2));
            }
        } else {
            $products = Product::with(['user', 'location'])->get();
            Cache::put('products.all_with_relations', $products, now()->addDays(2));
        }
    }

}
