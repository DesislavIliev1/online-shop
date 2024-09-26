<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\ProductService;
use App\Http\Requests\Products\StoreProductRequest;
// use App\Http\Requests\Products\UpdateProductRequest;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 20);
        $search = $request->input('search');
        $from = $request->input('from');
        $to = $request->input('to');
        $productsQuery = Product::with(['category', 'user']);


        if ($request->input('clear')) {
            return redirect()->route('Admin.products.index');
        }
        
        if ($from) {
            $productsQuery->where('created_at', '>=', $from);
        }

        if ($to) {
            $productsQuery->where('created_at', '<=', $to);
        }


        $sortOptions = [
            'sortOrderByID' => 'id',
            'sortOrderByTitle' => 'title',
            'sortOrderByCategoryID' => 'category_id'
        ];

        foreach ($sortOptions as $input => $column) {
            if ($sortOrder = $request->input($input)) {
                $productsQuery->orderBy($column, $sortOrder);
                break;
            }
        }

        if (!$sortOrder) {
            $productsQuery->orderBy('id', 'desc');
        }

        if ($request->has('search')) {
            $search = $request->input('search');
            if (is_numeric($search)) {
                $productById = Product::find($search);
                if ($productById) {
                    $productsQuery = $productsQuery->where('id', $search);
                } else {
                    $productsQuery = $productsQuery->where('price', $search);
                }
            } else {
                $productsQuery = $productsQuery->where('title', 'like', '%' . $search . '%');
            }
        }

        $products = $productsQuery->paginate($perPage)->appends($request->only(array_keys($sortOptions)));

        return view('admin.products.products', compact('products'));
    }

    public function create()
    {
        // $categories = Category::all();

        return view('admin.products.manage-products', ['action' => 'create',]);
    }

    public function store(StoreProductRequest $request)
    {   
        try {
            $this->productService->createProduct($request->validated(), $request);
            return redirect()->route('Admin.products.index')->with('success', 'Product created successfully.');
        } catch (\Exception $e) {
            \Log::channel('uploadAd')->error('Product creation failed', ['error' => $e->getMessage()]);
            return redirect()->route('Admin.products.index')->with('error', 'Failed to create product.');
        }
    }

    public function edit(Product $product)
    {
        // $categories = Category::all();
        // $locations = Location::all();

        return view('admin.products.manage', ['action' => 'edit', 'product' => $product]);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            $this->productService->updateProduct($product, $request->validated());
            return redirect()->route('AutoAdmin.products.index')->with('success', 'Product updated successfully.');
        } catch (\Exception $e) {
            \Log::channel('uploadAd')->error('Product update failed', ['error' => $e->getMessage()]);
            return redirect()->route('AutoAdmin.products.index')->with('error', 'Failed to update product.');
        }
    }

    public function destroy(Product $product)
    {
        try {
            $this->productService->deleteProduct($product);
            return redirect()->route('AutoAdmin.products.index')->with('success', 'Product deleted successfully.');
        } catch (\Exception $e) {
            \Log::channel('uploadAd')->error('Product deletion failed', ['error' => $e->getMessage()]);
            return redirect()->route('AutoAdmin.products.index')->with('error', 'Failed to delete product.');
        }
    }

    public function show(Product $product)
    {
        return view('admin.products.manage', ['action' => 'show', 'product' => $product]);
    }
}
