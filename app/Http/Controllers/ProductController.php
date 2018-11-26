<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return $products;
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

        /* ¡¡FIX THIS CODE!!*/
        /* Get, transform and save the image */
            /*ONE*/
            $exploded1 = explode(',', $request->img1);
            $decoded1 = base64_decode($exploded1[1]);
            
            if(str_contains($exploded1[0], 'jpeg')){ /* ATENTION TO THIS LINE! */
                $extension1 = 'jpg';
            } else {
                $extension1 = 'png';
            }
    
            $filename1 = $request->model.'_img1'.'.'.$extension1;
            $path1 = public_path('items_img').'/'.$filename1;
            file_put_contents($path1, $decoded1); 
            /*ONE*/

            /*TWO*/
            $exploded2 = explode(',', $request->img2);
            $decoded2 = base64_decode($exploded2[1]);
            
            if(str_contains($exploded2[0], 'jpeg')){ /* ATENTION TO THIS LINE! */
                $extension2 = 'jpg';
            } else {
                $extension2 = 'png';
            }
    
            $filename2 = $request->model.'_img2'.'.'.$extension2;
            $path2 = public_path('items_img').'/'.$filename2;
            file_put_contents($path2, $decoded2); 
            /*TWO*/

            /*THREE*/
            $exploded3 = explode(',', $request->img3);
            $decoded3 = base64_decode($exploded3[1]);
            
            if(str_contains($exploded3[0], 'jpeg')){ /* ATENTION TO THIS LINE! */
                $extension3 = 'jpg';
            } else {
                $extension3 = 'png';
            }
    
            $filename3 = $request->model.'_img3'.'.'.$extension3;
            $path3 = public_path('items_img').'/'.$filename3;
            file_put_contents($path3, $decoded3); 
            /*THREE*/

            /*FOUR*/
            $exploded4 = explode(',', $request->img4);
            $decoded4 = base64_decode($exploded4[1]);
            
            if(str_contains($exploded4[0], 'jpeg')){ /* ATENTION TO THIS LINE! */
                $extension4 = 'jpg';
            } else {
                $extension4 = 'png';
            }
    
            $filename4 = $request->model.'_img4'.'.'.$extension4;
            $path4 = public_path('items_img').'/'.$filename4;
            file_put_contents($path4, $decoded4); 
            /*FOUR*/
        /* Get, transform and save the image */
        /* ¡¡FIX THIS CODE!!*/
 

        $item = new Product;

        $item->model = $request->model;
        $item->description = $request->description;
        $item->stock = $request->stock;
        $item->internal_code = $request->internal_code;
        $item->type = $request->type;
        $item->img1 = $filename1; 
        $item->img2 = $filename2; 
        $item->img3 = $filename3; 
        $item->img4 = $filename4; 

        $item->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
       return $product;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
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
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
