<?php

namespace App\Http\Controllers\Api;

use App\API\ApiError;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UserStoreRequest;
//use Illuminate\Foundation\Validation\ValidatesRequests;


class ProductController extends Controller
{
    private $product;
    public function __construct(Product $product)
    {
        $this ->product = $product;
    }

    public function index()
    {

        return response()->json($this->product->paginate(5));
        
        
    }

    public function show($id)
    {
        $product = $this->product->find($id);

        if(! $product) return response()->json(ApiError::errorMessage('Produto não encontrado!', 4040), 404);
        
        $data = ['data' => $product];
        return response()->json($data);

    }

/*     public function validate(Request $request, array $rules, array $messages = [], array $customAttributes = [])
    {
        $validator = $this->getValidationFactory()->make($request->all(), $rules, $messages, $customAttributes);

        if ($validator->fails()) {
            $this->formatValidationErrors($validator);
        }
    } */

    public function store2(Request $request)
{   $productData = $request ->all();
    $validator = Validator::make($productData, [
        'name' => 'required|unique:posts|max:255',
        'description' => 'required',
    ]);

    $this->product->create($productData);

    if ($validator->fails()) {
        return redirect('post/create')
                    ->withErrors($validator)
                    ->withInput();
    }
}



    public function store(Request $request)
    {
        //$validated = $request->validated();
        try{
        $productData = $request ->all();//-> $validated;
        
        $this->product->create($productData);
        
        $return =['data' => ['msg' => 'Produto criado com sucesso!'], 201];
        return response()->json($return, 201);

    } catch(\Exception $e){
        if(config('app.debug')) {
            
            //return response()->json($productData,500);
            return response()->json(ApiError::errorMessage($e->getMessage(), 1010),500);
            }
            return response()->json(ApiError::errorMessage('Houve um erro ao realizar operação de salvar', 1010),500);
        }
    }


    public function update(Request $request, $id)
    {
        try{
        $productData = $request ->all();
        $product     = $this->product->find($id);
        $product->update($productData);
        
        $return =['data' => ['msg' => 'Produto atualizado com sucesso!'], 201];
        return response()->json($return, 201);

    } catch(\Exception $e){
        if(config('app.debug')) {
            return response()->json(ApiError::errorMessage($e->getMessage(), 1010),500);
        }
        return response()->json(ApiError::errorMessage('Houve um erro ao realizar operação de atualizar', 1011),500);

        }
    }

    public function delete(Product $id)
    {
        try{
            $id -> delete();

            return response()->json(['data' => ['msg'=> 'Produto: ' . $id->name . ' removido com sucesso!']], 200);

        }catch(\Exception $e) {
            if(config('app.debug')){
                return response()->json(ApiError::errorMessage($e->getMessage(), 1012),500);
            }
            return response()->json(ApiError::errorMessage('Houve um erro ao realizar a operação de remover',1012),500);

        }

        
    }
    public function verbosrecurso()
        {
            return response()-> 
            json([
                'data'=> $this->product::all()
            
            ],200);
           // return response()->json($this->product->paginate(5));
        }
}