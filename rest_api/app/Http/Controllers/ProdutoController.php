<?php
namespace App\Http\Controllers;

use App\Category;
use Illuminate\Support\Facades\DB;
use App\Product;
/**
 * Class UserController
 * @package App\Http\Controllers
 */
class ProdutoController extends Controller
{
    /**
     * return to the users index view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    private $product;
    public function __construct(Product $product)
    {
        $this ->product = $product ;
    }

    public function index(){
        
        // $products = $this->product->paginate(5);
        
        $products = DB::table('products')->paginate(5);
        //$products = Product::all();
        //$data = ['data' => $product];
      //  return response()->json($data);
        return view('produtos.lista', compact('products'));
        
    }
}