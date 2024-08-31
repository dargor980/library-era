<?php

namespace App\Http\Controllers;

use App\Sale;
use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

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
            ->addColumn('link', function($sale){
                return '<a href="/sales/detail/'. $sale->id . '"> aaaa</a>';
            })
            ->addColumn('created_at', function($sale) {
                return $sale->created_at->format('Y-m-d');
            })
            ->rawColumns(['link'])
            ->make(true)
        ;
    }

    public function getSaleProducts()
    {
        $products = DB::table('products')
            ->join('stocks', 'stock_id', 'stocks.id')
            ->where('stocks.quantity', '>', 0)
            ->orderBy('products.name', 'ASC')
            ->get()
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
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
