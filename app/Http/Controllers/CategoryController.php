<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\NewCategoryRequest;
use Exception;
use Illuminate\Http\Request;
use Log;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('category.index', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewCategoryRequest $request)
    {
        try {
            Category::create([
                'name' => $request->name,
            ]);

            return back()->with('mensaje', 'Categoría añadida.');
        } catch (Exception $e) {
            Log::channel('categories')->error('Error al crear categoría: ');
            Log::channel('categories')->error($e->getMessage());
            Log::channel('categories')->error($e->getTraceAsString());

            return back()->with('error', 'Hubo un error al crear la categoría. Intente nuevamente.');
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
        try {
            $category = Category::find($id);
            $category->delete();

            return back()->with('mensaje2', 'Categoría eliminada');
        }catch(\Illuminate\Database\QueryException $ex) {
            Log::channel('categories')->error('error al eliminar la categoría: ');
            Log::channel('categories')->error($ex->getMessage());
            Log::channel('categories')->error($ex->getTraceAsString());

            return back()->with('error', 'No se puede eliminar esta categoría, ya que hay productos en ella.');
        }
    }
}
