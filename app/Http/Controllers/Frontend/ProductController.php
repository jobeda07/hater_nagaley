<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Category;
use App\Models\Brand;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Header Category Start
        // dd($request);
        // return $request;
        $categories = Category::orderBy('name_en','DESC')->where('status', 1)->get();

        $sort_by = $request->sort_by;
        $brand_id = $request->brand;

        $conditions = ['status' => 1];

        if($brand_id != null){
            $conditions = array_merge($conditions, ['brand_id' => $brand_id]);
            //dd($brand_id);
        }

        $products_sort_by = Product::where($conditions);
        //dd($products_sort_by);

        switch ($sort_by) {
            case 'newest':
                $products_sort_by->orderBy('created_at', 'desc')->paginate(30)->appends(request()->query());
                break;
            case 'oldest':
                $products_sort_by->orderBy('created_at', 'asc')->paginate(30)->appends(request()->query());
                break;
            case 'price-asc':
                $products_sort_by->orderBy('regular_price', 'asc')->paginate(30)->appends(request()->query());
                break;
            case 'price-desc':
                $products_sort_by->orderBy('regular_price', 'desc')->paginate(30)->appends(request()->query());
                break;
            default:
                $products_sort_by->orderBy('id', 'desc')->paginate(30)->appends(request()->query());
                break;
                //dd($products_sort_by);
        }
        //return $sort_by;

        // Start Shop Product //
        if($brand_id){
            $products = Product::orderBy('name_en', 'ASC')->where('brand_id', $brand_id)->latest()->paginate(30)->appends(request()->query());
        }else{
            $products = Product::orderBy('name_en', 'ASC')->latest()->paginate(30)->appends(request()->query());
        }

        //dd($products);

        $min_price = $request->get('filter_price_start');
        $max_price = $request->get('filter_price_end');
        if($min_price != null && $max_price != null){
            $products = Product::orderBy('name_en', 'ASC')->where('status', 1)->where('regular_price', '>=', $min_price)->where('regular_price', '<=', $max_price)->paginate(30)->appends(request()->query());
        }
        // Category Filter Start
        if ($request->get('filtercategory')){

            $checked = $_GET['filtercategory'];
            // filter With name start
            $category_filter = Category::whereIn('name_en', $checked)->get();
            //dd($category_filter);
            $catId = [];
            foreach($category_filter as $cat_list){
                array_push($catId, $cat_list->id);
            }
            // filter With name end
            $products = Product::whereIn('category_id', $catId)->where('status', 1)->latest()->paginate(30)->appends(request()->query());
            //dd($products);
        }
        // Category Filter End

        $attributes = Attribute::orderBy('name', 'DESC')->where('status', 1)->latest()->get();
        // End Shop Product //

        return view('frontend.product.product_shop', compact('categories','attributes','products','sort_by','brand_id'));
    }


    public function CampaingIndex(Request $request)
    {

        // Header Category Start
        $categories = Category::orderBy('name_en','DESC')->where('status', 1)->get();

        // Sort and brand filter Start
        $sort_by = $request->sort_by;
        $brand_id = $request->brand;

        $conditions = ['status' => 1];

        if($brand_id != null){
            $conditions = array_merge($conditions, ['brand_id' => $brand_id]);
        }elseif ($request->brand != null) {
            $brand_id = (Brand::where('id', $request->brand)->first() != null) ? Brand::where('id', $request->brand)->first()->id : null;
            $conditions = array_merge($conditions, ['brand_id' => $brand_id]);
        }

        // if($brand_id != null){
        //     $products = Product::whereIn('brand_id', $brand_id)->where('status', 1)->latest()->paginate(30);
        // }elseif ($request->brand != null) {
        //     $brand_id = (Brand::where('slug', $request->brand)->first() != null) ? Brand::where('slug', $request->brand)->first()->id : null;
        //     $conditions = array_merge($conditions, ['brand_id' => $brand_id]);
        // }

        $products_sort_by = Product::where($conditions);
        switch ($sort_by) {
            case 'newest':
                $products_sort_by = $products_sort_by->orderBy('created_at', 'desc')->paginate(30)->appends(request()->query());
                break;
            case 'oldest':
                $products_sort_by = $products_sort_by->orderBy('created_at', 'asc')->paginate(30)->appends(request()->query());
                break;
            case 'price-asc':
                $products_sort_by = $products_sort_by->orderBy('regular_price', 'asc')->paginate(30)->appends(request()->query());
                break;
            case 'price-desc':
                $products_sort_by = $products_sort_by->orderBy('regular_price', 'desc')->paginate(30)->appends(request()->query());
                break;
            default:
                $products_sort_by = $products_sort_by->orderBy('id', 'desc')->paginate(30)->appends(request()->query());
                break;
        }

        // Sort and brand filter end


        //dd($products_sort_by);
        // Start Shop Product //

        $products = Product::orderBy('name_en', 'ASC')->where('brand_id', $brand_id)->latest()->paginate(30)->appends(request()->query());


        $min_price = $request->get('filter_price_start');
        $max_price = $request->get('filter_price_end');
        //dd($min_price);
        if($min_price != null && $max_price != null){

            //$products = $products->where('regular_price', '>=', $min_price)->where('regular_price', '<=', $max_price);
            $products = Product::orderBy('name_en', 'ASC')->where('status', 1)->where('regular_price', '>=', $min_price)->where('regular_price', '<=', $max_price)->paginate(30)->appends(request()->query());
            // dd($products);
        }

        // Category Filter Start
        if ($request->get('filtercategory')){

            $checked = $_GET['filtercategory'];
            // filter With name start
            $category_filter = Category::whereIn('name_en', $checked)->get();
            $catId = [];
            foreach($category_filter as $cat_list){
                array_push($catId, $cat_list->id);
            }
            // filter With name end

            $products = Product::whereIn('category_id', $catId)->where('status', 1)->latest()->paginate(30)->appends(request()->query());
            //dd($products);
            // dd($products);
        }

        $attributes = Attribute::orderBy('name', 'DESC')->where('status', 1)->latest()->get();
        // End Shop Product //

        return view('frontend.product.campaing', compact('categories','attributes','products','sort_by','brand_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $varient
     * @return \Illuminate\Http\Response
     */
    public function getVarient($id, $varient)
    {
        $stock = ProductStock::where('product_id', $id)->where('varient', $varient)->first();
        $product= Product::find($id);

        if($product){
            $discount_percent = $product->reseller_discount_variant;
            if($stock){
                $stock->reseller_discount_percent = $discount_percent;
                if(auth()->check() && auth()->user()->role==7){
                    $stock->reseller = 1;
                }else{
                    $stock->reseller = 0;
                }
                return ['stock' => $stock, 'product' => $product];
            }else{
                return null;
            }
        }else{
            return null;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
