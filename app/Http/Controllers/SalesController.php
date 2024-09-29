<?php

namespace App\Http\Controllers;

use App\ContentSale;
use App\Http\Requests\NewSaleRequest;
use App\PaymentType;
use App\Product;
use App\Sale;
use App\Stock;
use App\UnitType;
use Exception;
use Illuminate\Http\Request;
use Log;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sales.list');
    }

    public function getSales()
    {
        $sales = Sale::select('*')->orderBy('id', 'DESC');

        return DataTables::of($sales)
            ->addColumn('created_at', function($sale) {
                return $sale->created_at->format('Y-m-d');
            })
            ->make(true)
        ;
    }

    public function getSaleProducts()
    {
        $products = DB::table('products')
            ->join('stocks', 'stock_id', 'stocks.id')
            ->where('stocks.quantity', '>', 0)
            ->orderBy('products.name', 'ASC')
            ->get(['products.id', 'products.name', 'products.bar_code', 'products.price', 'stocks.quantity'])
        ;

        return $products;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sales.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewSaleRequest $request)
    {
        try {

            $sale = Sale::create([
                'total' => $request->total,
            ]);

            return $sale;
        }catch(Exception $e) {
            Log::channel('sales')->error('Error al guardar la venta: ');
            Log::channel('sales')->error($e->getMessage());
            Log::channel('sales')->error($e->getTraceAsString());
        }
    }

    public function addProductToSale(Request $request)
    {
        try {
            foreach($request->all() as $req) {
                /** @var Product */
                $product = Product::find($req['product_id']);

                if(!isset($requ['quantity'])) {
                    $req['quantity'] = 0;
                }

                ContentSale::create([
                    'sale_id' => $req['sale_id'],
                    'product_id' => $req['product_id'],
                    'quantity' => $req['quantity'],
                    'subtotal' => $req['quantity'] * $product->price
                ]);
            }

            return;
        }catch(Exception $e) {
            Log::channel('sales')->error('Error al agregar producto al pedido');
            Log::channel('sales')->error($e->getMessage());
            Log::channel('sales')->error($e->getTraceAsString());

            return;
        }
    }


    public function updateStock(Request $request)
    {
        try {
            foreach($request->all() as $req) {
                $product = Product::find($req['product_id']);
                $id = $product->stock_id;
                $stock = Stock::find($id);

                $stock->quantity = $stock->quantity - $req['quantity'];
                $stock->update();
            }
            return;
        }catch(Exception $e) {
            Log::channel('sales')->error('Error al actualizar stock: ');
            Log::channel('sales')->error($e->getMessage());
            Log::channel('sales')->error($e->getTraceAsString());

            return;
        }

    }

    public function completeSale(Request $request)
    {
        DB::beginTransaction();

        try {
            $sale = Sale::create([
                'total' => $request->total,
                'payment_type_id' => PaymentType::PAYMENT_TYPE[$request->payment_type],
            ]);

            foreach($request->products as $req) {
                $product = Product::find($req['product_id']);

                if(!$product) {
                    throw new Exception('Producto no encontrado');
                }

                $quantity = $req['quantity'] ?? 0;


                $stock = Stock::find($product->stock_id);


                if(!$stock || $stock->quantity < $quantity) {
                    throw new \Exception("Stock insuficiente para el producto: {$product->name}");
                }

                ContentSale::create([
                    'sale_id' => $sale->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'subtotal' => $quantity * $product->price,
                ]);

                $stock->quantity -= $quantity;

                $stock->save();
            }

            DB::commit();

            return response()->json(['message' => 'Venta completada con éxito', 'sale_id' => $sale->id], 201);
        } catch(Exception $e) {
            DB::rollBack();

            Log::channel('sales')->error('Error al completar la venta: '. $e->getMessage());
            Log::channel('sales')->error($e->getTraceAsString());

            return response()->json(['message' => 'Error al completar la venta: ' . $e->getMessage()], 500);
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
        // try{

            $products = ContentSale::with(['product', 'sale'])
                ->where('sale_id', '=', $id)
                ->get();


            $unitTypes = UnitType::all();

            $sale = Sale::findOrFail($id);


            return view('sales.details', compact('products','unitTypes', 'sale'));

        // }catch(Exception $e){
        //     Log::channel('sales')->error('Error al obtener datos de la venta: ');
        //     Log::channel('sales')->error($e->getMessage());
        //     Log::channel('sales')->error($e->getTraceAsString());

        //     return back()->with('error', 'Hubo un error al mostrar la venta. Intente nuevamente.');
        // }
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
