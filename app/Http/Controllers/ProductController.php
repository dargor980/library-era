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
use JeroenNoten\LaravelAdminLte\View\Components\Tool\Datatable;
use Log;
use Intervention\Image\Facades\Image;
use Milon\Barcode\Facades\DNS1DFacade;
use Psy\Command\DumpCommand;
use Yajra\DataTables\Facades\DataTables;

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
        return view('product.index');
    }

    public function getProducts(){
        $products = Product::with(['category', 'unitType'])->select(['*']);
       
        return DataTables::of($products)->make(true);
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

            $barCode = $request->bar_code ?? Product::generateEAN13BarCodeNumber();

            Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'unit_type_id' => $request->unit_type_id,
                'category_id' => $request->category_id,
                'stock_id' => $stock->id,
                'cost' => $request->cost,
                'profit' => $request->price - $request->cost,
                'bar_code' => $barCode,
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
    public function update(UpdateProductRequest $request, $id)
    {
        try {
          
            $updateProduct = Product::find($id)->update([
                'name' => $request->name,
                'price' => $request->price,
                'unit_type_id' => $request->unit_type_id,
                'category_id' => $request->category_id,
                'cost' => $request->cost,
                'profit' => $request->price - $request->cost,
            ]);

            return back()->with('mensaje','Producto actualizado. ');

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
            $destroyProduct = Product::find($id);
            $destroyProduct->delete();

            return redirect()->route('productList')->with('mensaje','Producto eliminado.');
        } catch(Exception $e) {
            Log::channel('products')->error('Error al eliminar producto: ');
            Log::channel('products')->error($e->getMessage());
            Log::channel('products')->error($e->getTraceAsString());

            return back()->with('error', 'Hubo un error al eliminar el producto');
        }

    }

    public function downloadBarCode($id)
    {
        $product = Product::findOrFail($id);

        $barcode = DNS1DFacade::getBarcodePNG($product->bar_code, 'EAN13');

        $fontPath = public_path('/fonts/Roboto-Regular.ttf');
        $initialFontSize = 24;

        // Fixed image dimensions
        $imageWidth = 800;
        $imageHeight = 350;

        // Create the canvas
        $img = Image::canvas($imageWidth, $imageHeight, '#ffffff');

        // Wrap the product name into multiple lines
        $maxTextWidth = $imageWidth - 40; // Adjust for padding
        $wrappedText = $this->wrapText($product->name, $fontPath, $initialFontSize, $maxTextWidth);

        // Calculate the height of the text block
        $textHeight = $this->getTextBlockHeight($wrappedText, $fontPath, $initialFontSize);

        // Positioning variables
        $topMargin = 30;
        $barcodeHeight = 90;
        $bottomMargin = 0;
        $availableHeight = $imageHeight - $topMargin - $textHeight - $barcodeHeight - $bottomMargin;

        // Adjust barcode size if needed
        $barcodeWidth = $imageWidth * 0.75;
        $barcodeImg = Image::make(base64_decode($barcode))->resize($barcodeWidth, $barcodeHeight*1.2);

        // Add the wrapped text
        $img->text($wrappedText, $imageWidth / 2, $topMargin, function($font) use ($fontPath, $initialFontSize) {
            $font->file($fontPath);
            $font->size($initialFontSize);
            $font->color('#000000');
            $font->align('center');
            $font->valign('top');
        });

        // Insert the barcode image
        $img->insert($barcodeImg, 'center', 0, -($bottomMargin + $barcodeHeight / 15));

        // Add the barcode number
        $img->text($product->bar_code, $imageWidth / 2, $barcodeHeight*3 , function($font) use ($fontPath) {
            $font->file($fontPath);
            $font->size(24);
            $font->color('#000000');
            $font->align('center');
            $font->valign('bottom');
        });

        $filename = $product->name . '_barcode.png';

        return $img->response('png')->withHeaders([
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    /**
     * Wrap text into multiple lines based on maximum width.
     */
    private function wrapText($text, $fontPath, $fontSize, $maxWidth)
    {
        $words = explode(' ', $text);
        $lines = '';
        $currentLine = '';

        foreach ($words as $word) {
            $testLine = $currentLine . (empty($currentLine) ? '' : ' ') . $word;
            $bbox = imagettfbbox($fontSize, 0, $fontPath, $testLine);
            $lineWidth = abs($bbox[4] - $bbox[0]);

            if ($lineWidth < $maxWidth) {
                $currentLine = $testLine;
            } else {
                $lines .= $currentLine . "\n";
                $currentLine = $word;
            }
        }

        $lines .= $currentLine;

        return $lines;
    }

    /**
     * Calculate the total height of the text block.
     */
    private function getTextBlockHeight($text, $fontPath, $fontSize)
    {
        $lines = explode("\n", $text);
        $lineHeight = $fontSize + 5; // Adjust line spacing as needed

        return count($lines) * $lineHeight;
    }

    // public function downloadBarCode($id)
    // {
    //     $product = Product::findOrFail($id);

    //     $barcode = DNS1DFacade::getBarcodePNG($product->bar_code, 'EAN13');

    //     $fontPath = public_path('/fonts/Roboto-Regular.ttf');
    //     $fontSize = 24;

    //     $bbox = imagettfbbox($fontSize, 0, $fontPath, $product->name);
    //     $textWidth = abs($bbox[4] - $bbox[0]) + 40;
    //     $textHeight = abs($bbox[5] - $bbox[1]) + 20;

    //     $imageWidth = max(800, $textWidth);
    //     $imageHeight = 250;

    //     $img = Image::canvas($imageWidth, $imageHeight, '#ffffff');

    //     $barcodeImg = Image::make(base64_decode($barcode))->resize($imageWidth * 0.75, 80);

    //     $img->text($product->name, $imageWidth / 2, 30, function($font) use ($fontPath, $fontSize) {
    //         $font->file($fontPath);
    //         $font->size($fontSize);
    //         $font->color('#000000');
    //         $font->align('center');
    //         $font->valign('top');
    //     });

    //     $img->insert($barcodeImg, 'center', 0, -20);

    //     $img->text($product->bar_code, $imageWidth / 2, $imageHeight - 80, function($font) use ($fontPath) {
    //         $font->file($fontPath);
    //         $font->size(18);
    //         $font->color('#000000');
    //         $font->align('center');
    //         $font->valign('bottom');
    //     });

    //     return $img->response('png');



    //     // $tempImage = Image::canvas(1, 1);
    //     // $tempImage->text($product->name, 0, 0, function($font) use ($fontPath, $fontSize) {
    //     //     $font->file($fontPath);
    //     //     $font->size($fontSize);
    //     // });

    //     // $textWidth = $tempImage->width() + 40;
    //     // $imageWidth = max(800, $textWidth);
    //     // $imageHeight = 250;

    //     // $img = Image::canvas($imageWidth, $imageHeight, '#ffffff');


    //     // $barcodeImg = Image::make(base64_decode($barcode))->resize($imageWidth * 0.75, 80);


    //     // $img->text($product->name, $imageWidth / 2, 30, function($font) use ($fontPath, $fontSize) {
    //     //     $font->file($fontPath);
    //     //     $font->size($fontSize);
    //     //     $font->color('#000000');
    //     //     $font->align('center');
    //     //     $font->valign('top');
    //     // });

    //     // $img->insert($barcodeImg, 'center', 0, -20);

    //     // $img->text($product->bar_code, $imageWidth / 2, $imageHeight - 80, function($font) use ($fontPath) {
    //     //     $font->file($fontPath);
    //     //     $font->size(18);
    //     //     $font->color('#000000');
    //     //     $font->align('center');
    //     //     $font->valign('bottom');
    //     // });

    //     // return $img->response('png');
    // }
}
