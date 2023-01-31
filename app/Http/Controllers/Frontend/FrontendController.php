<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', 0)->get();
        $trendingProducts = Product::where('trending', '1')->latest()->take('15')->get();
        $newArrivals = Product::latest()->take('15')->get();
        $featuredProducts = Product::where('featured', '1')->latest()->take('15')->get();
        return view('frontend.index', compact('sliders', 'trendingProducts', 'newArrivals', 'featuredProducts'));
    }

    public function categories()
    {
        $categories = Category::where('status', '0')->get();
        return view('frontend.collections.categories.index', compact('categories'));
    }

    public function products($category_slug)
    {
        $category = Category::where('slug', $category_slug)->first();
        
        if($category)
        {
            return view('frontend.collections.products.index', compact('category'));
        }
        else
        {
            return redirect()->back();
        }
    }

    public function productview(string $category_slug, string $product_slug)
    {
        $category = Category::where('slug', $category_slug)->first();
        
        if($category)
        {
            $product = $category->products->where('slug', $product_slug)->first();
            
            if($product)
            {
                return view('frontend.collections.products.view', compact('category', 'product'));
            }
            else
            {
                return redirect()->back();
            }
        }
        else
        {
            return redirect()->back();
        }
    }

    public function newArrivals()
    {
        $newArrivals = Product::latest()->take('15')->get();
        return view('frontend.pages.new-arrivals', compact('newArrivals'));
    }

    public function featuredProducts()
    {
        $featuredProducts = Product::where('featured', '1')->latest()->get();
        return view('frontend.pages.featured-products', compact('featuredProducts'));
    }

    public function thankyou()
    {
        return view('frontend.thank-you');
    }

    public function searchProducts(Request $request)
    {
        if ($request->search)
        {
            $searchProducts = Product::where('name', 'LIKE', '%'.$request->search.'%')->latest()->paginate(1);
            
            return view('frontend.pages.search', compact('searchProducts'));
        }
        else
        {
            return redirect()->back()->with('message', 'Empty Search');
        }
    }
}
