<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\UpdateStockRequest;
use App\Product;
use App\Stock;
use App\UnitType;
use Exception;
use Illuminate\Http\Request;
use Log;
use Yajra\DataTables\DataTables;

class StockController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('stock.list');
    }

    public function getStocks()
    {
        $products = Product::with([
            'category',
            'unitType',
            'stock',
        ])
        ->select('*');

        return DataTables::of($products)
            ->make(true)
        ;

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
     * 
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $stocks = Stock::all();
        $products = Product::orderBy('name')->paginate(12);
        $categories = Category::all();
        $unitTypes = UnitType::all();
        return view('stock.new',compact('stocks','products','categories','unitTypes'));
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
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStockRequest $request)
    {
        try {
            Stock::find($request->stock_id)
                ->update([
                    'quantity' => $request->quantity
                ])
            ;

            return back()->with('mensaje', 'Stock del producto actualizado correctamente.');

        } catch(Exception $e) {
            Log::channel('stock')->error('Error al actualizar el stock.');
            Log::channel('stock')->error($e->getMessage());
            Log::channel('stock')->error($e->getTraceAsString());

            return back()->with('error', 'Hubo un error al actualizar el stock. Intente nuevamente.');
        }
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
