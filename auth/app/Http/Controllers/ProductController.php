<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
class ProductController extends Controller
{
    public function create(Request $request)
    {
    
        $product = new Product([
            'name' => $request->name,
            'detail' => $request->detail,
           
        ]);
        $product->save();
        return response()->json([
            'message' => 'Successfully created product!'
        ], 201);
    }
    public function show()
    {
        return response()->json([
            "data" => Product::all(),
            'message' => 'Successfully show product!'
        ], 201); 
    }
    public function find(Request $request){
        $id = $request->id;
        $product = Product::find($id);
        if(is_null($product)){
            return response()->json([
                'message'=> "No have this product"
            ]);
        };
        return response() -> json([
            "data" => $product
        ]);
    }
    public function update(Request $request, Product $product)
    {
        $updateProduct = new Product([
            $id = $request->id,
            $updateName= $request->name,
            $updateDetail= $request->detail,
        ]);
        $productNeedUpdate = Product::find($id);
        if(is_null($productNeedUpdate)){
            return response()->json([
                'message'=> "No have this product"
            ]);
        };
        $productNeedUpdate->name=$updateName;
        $productNeedUpdate->detail=$updateDetail;
        $productNeedUpdate->save();
        return response()-> json([
            "message" => "Update success"
        ]);
    }
    public function delete(Request $request)
    {
        $id = $request -> id;
        $productDelete = Product::find($id);
        if(is_null($productDelete)){
            return response()->json([
                "message"=>"No have this product"
            ]);
        };
        $productDelete->delete();
        DB::statement('ALTER TABLE products AUTO_INCREMENT = '.(count(Product::all())+1).';');
        return response() ->json([
            "message" => "Delete success"
        ]);
    }

}