<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Product;
use App\Stock;
use App\UnitType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Log;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index()
    {
        return view('product.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::all();
        $unitTypes = UnitType::all();

        return view('product.new', compact('categories', 'unitTypes'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param ProductoRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductRequest $request)
    {
        DB::beginTransaction();

        try{
            $stock = Stock::create([
                'quantity' => $request->quantity,
            ]);

            Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'unit_type_id' => $request->unit_type_id,
                'category_id' => $request->category_id,
                'stock_id' => $stock->id,
                'cost' => $request->cost,
                'profit' => $request->price - $request->cost,
                'bar_code' => $request->bar_code,
            ]);

            DB::commit();

            return back()->with('mensaje', 'Producto agregado correctamente.');
        }catch(Exception $e) {
            DB::rollBack();

            Log::channel('products')->error('Error al crear producto: ');
            Log::channel('products')->error($e->getMessage());
            Log::channel('products')->error($e->getTraceAsString());

            return back()->with('error', 'Hubo un error al crear el producto. Intente nuevamente.');
        }

    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::with('unitType')->find($id);

        return view('product.detail', compact('product'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $unitTypes = UnitType::all();

        return view('product.edit', compact('product', 'categories', 'unitTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductoRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateProductRequest $request)
    {
        try {

        } catch (Exception $e) {
            return back()->with('error', 'Hubo un error al actualizar el producto. Intente nuevamente');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {

        } catch(Exception $e) {
            return back()->with('error', 'Hubo un error al eliminar el producto');
        }

    }
}
