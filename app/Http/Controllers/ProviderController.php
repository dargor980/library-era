<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewProviderRequest;
use App\Provider;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class ProviderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('provider.index');
    }

    public function getProviders()
    {
        $providers = Provider::select('*');

        return DataTables::of($providers)
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('provider.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewProviderRequest $request)
    {
        try{
            Provider::create([
                'name' => $request->name,
                'company' => $request->company,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
                'description' => $request->description,
            ]);

            return back()->with('mensaje', 'Proveedor añadido correctamente.');
        }catch (Exception $e) {
            Log::channel('providers')->error('Error al agregar proveedor');
            Log::channel('providers')->error($e->getMessage());
            Log::channel('providers')->error($e->getTraceAsString());

            return back()->with('error', 'Error al agregar proveedor. Intente nuevamente.');
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
        $provider = Provider::findOrFail($id);

        return view('provider.details', compact('provider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $provider = Provider::findOrFail($id);

        return view('provider.edit', compact('provider'));
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
        try {
            Provider::find($id)
                ->update([
                    'name' => $request->name,
                    'company' => $request->company,
                    'address' => $request->address,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'description' => $request->description,
                ]);
            
            return back()->with('mensaje', 'Proveedor actualizado correctamente.');
        }catch(Exception $e) {
            Log::channel('providers')->error('Error al actualizar proveedor');
            Log::channel('providers')->error($e->getMessage());
            Log::channel('providers')->error($e->getTraceAsString());

            return back()->with('error', 'Error al actualizar proveedor. Intente nuevamente.');
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
        try{
            $provider = Provider::findOrFail($id);
            $provider->delete();
            return redirect()->route('providerlist')->with('mensaje', 'Proveedor eliminado correctamente.');

        }catch (Exception $e) {
            Log::channel('providers')->error('Error al eliminar proveedor');
            Log::channel('providers')->error($e->getMessage());
            Log::channel('providers')->error($e->getTraceAsString());
        }
    }
}
