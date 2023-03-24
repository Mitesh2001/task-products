<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductStoreRequest;
use Illuminate\Support\Facades\Auth;
use DataTables;


class ProductController extends Controller
{

    public $categories = [
        'Household',
        'Clothing',
        'Electronic',
        'Stationary',
        'Food'
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $user = Auth::user();
            $data = $user->products;
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $html = '<div class="d-flex">';
                $html .= '<a href="'.route('products.show', $row).'" class="btn btn-secondary btn-sm m-1"><i class="fa-solid fa-eye"></i></a>';
                $html .= '<a href="'. route('products.edit', $row->id) .'" class="btn btn-primary btn-sm m-1"><i class="fa-solid fa-pen-to-square"></i></a>';
                $html .= '<form action="'.route('products.destroy', $row->id).'" class="d-flex" method="POST">';
                $html .= method_field("DELETE");
                $html .= '<button type="submit" class="btn btn-danger btn-sm m-1"><i class="fa-solid fa-trash"></i></button>';
                $html .= csrf_field();
                $html .= '</form>';
                $html .= '</div>';
                return $html;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('products.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create',[
            'categories' => $this->categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        $product_image = "";

        if ($request->hasfile('image')) {
            $imageFile = $request->file('image');
            $name = $imageFile->getClientOriginalName();
            $imageFile->move(public_path().'/products_images/',$name);
            $product_image = '/products_images/'.$name;
        }

        $product = Product::create([
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'discount' => $request->discount,
            'image' => $product_image,
            'user_id' => Auth::id(),
            'description' => $request->description,
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {

        return view('products.show', [
            'product' => $product,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit',[
            'product' => $product,
            'categories' => $this->categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductStoreRequest $request, Product $product)
    {

        $product_image = "";

        if ($request->hasfile('image')) {
            $imageFile = $request->file('image');
            $name = $imageFile->getClientOriginalName();
            $imageFile->move(public_path().'/products_images/', $name);
            $product_image = '/products_images/'.$name;
        }

        $product->update([
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'discount' => $request->discount,
            'image' => $product_image,
            'user_id' => Auth::id(),
            'description' => $request->description
        ]);

        return redirect()->route('products.index')->with('success', 'Product Updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product Deleted successfully.');

    }
}
