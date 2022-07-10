<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products= Product::All();
        return response()->json(['succes'=>true,'products'=>$products],200);
        
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
    public function upProduct(Request $request)
    {
        $validations= request()->validate([
            'nombre'=>'required',
            'descripcion'=>'required',
            'precio'=>'required',
        ]);
        if(isset( $validations))
        {
            $product= new Product();
            $product->nombre= $request->nombre;
            $product->descripcion= $request->descripcion;
            $product->precio= $request->precio;
            $product->save();
            return response()->json(['succes'=>true,'product'=>$product],200);
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validations=Validator::make($request->all(),[
            'nombre'=>'required',
            'descripcion'=>'required',
            'precio'=>'required',
        ]);
        if($validations->fails()){
            return response()->json($validations->errors());
        }
         $product=Product::findOrfail($request->id);
         $product->nombre=$request->nombre;
         $product->descripcion=$request->descripcion;
         $product->precio=$request->precio;
         $product->save();
         return response()->json(['succes'=>true,'product'=>$product],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Product $product)
    {
        $product=Product::destroy($request->id);
        return response()->json(['succes'=>true,'product'=>'producto eliminado correctamente'],200);
    }
}
