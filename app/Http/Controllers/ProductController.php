<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;

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

            //Pequeña
            $path11 = public_path('items_img/thumb').'/'.$filename1;
            file_put_contents($path11, $decoded1); 
            //Pequeña
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
            
            //Pequeña
            $path22 = public_path('items_img/thumb').'/'.$filename2;
            file_put_contents($path22, $decoded2); 
            //Pequeña
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

            //Pequeña
            $path33 = public_path('items_img/thumb').'/'.$filename3;
            file_put_contents($path33, $decoded3); 
            //Pequeña

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

            //Pequeña
            $path44 = public_path('items_img/thumb').'/'.$filename4;
            file_put_contents($path44, $decoded4); 
            //Pequeña
            /*FOUR*/
        /* Get, transform and save the image */
        /* ¡¡FIX THIS CODE!!*/
 

        $item = new Product;

        $item->model = $request->model;
        $item->description = $request->description;
        $item->data_sheet = $request->data_sheet;
        $item->price = $request->price;
        $item->stock = $request->stock;
        $item->internal_code = $request->internal_code;
        $item->type = $request->type;
        $item->img1 = $filename1; 
        $item->img2 = $filename2; 
        $item->img3 = $filename3; 
        $item->img4 = $filename4; 

        $item->save();

        //Minimizarlas y guardarlas

        $thumbnailpath = public_path('items_img/'. $filename1);
        $img = Image::make($thumbnailpath)->resize(1000, 1000, function($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($thumbnailpath);

        $thumbnailpath = public_path('items_img/'. $filename2);
        $img = Image::make($thumbnailpath)->resize(1000, 1000, function($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($thumbnailpath);

        $thumbnailpath = public_path('items_img/'. $filename3);
        $img = Image::make($thumbnailpath)->resize(1000, 1000, function($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($thumbnailpath);

        $thumbnailpath = public_path('items_img/'. $filename4);
        $img = Image::make($thumbnailpath)->resize(1000, 1000, function($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($thumbnailpath);


        //Imagenes thumb pequeñas
        $thumbnailpath = public_path('items_img/thumb/'. $filename1);
        $img = Image::make($thumbnailpath)->resize(300, 300, function($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($thumbnailpath);

        $thumbnailpath = public_path('items_img/thumb/'. $filename2);
        $img = Image::make($thumbnailpath)->resize(300, 300, function($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($thumbnailpath);

        $thumbnailpath = public_path('items_img/thumb/'. $filename3);
        $img = Image::make($thumbnailpath)->resize(300, 300, function($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($thumbnailpath);

        $thumbnailpath = public_path('items_img/thumb/'. $filename4);
        $img = Image::make($thumbnailpath)->resize(300, 300, function($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($thumbnailpath);
    }

    public function algo(Request $request){

        /* $exploded4 = explode(',', $request);
        $decoded4 = base64_decode($exploded4[1]);

        $respuesta = base64_decode($exploded4[0]);

        echo $respuesta; */
        $thumbnailpath = public_path('items_img/ASP-8118_img1.jpg');
        $img = Image::make($thumbnailpath)->resize(1000, 1000, function($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($thumbnailpath);

        $thumbnailpath = public_path('items_img/ASP-8118_img2.jpg');
        $img = Image::make($thumbnailpath)->resize(1000, 1000, function($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($thumbnailpath);

        $thumbnailpath = public_path('items_img/ASP-8118_img3.jpg');
        $img = Image::make($thumbnailpath)->resize(1000, 1000, function($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($thumbnailpath);

        $thumbnailpath = public_path('items_img/ASP-8118_img4.jpg');
        $img = Image::make($thumbnailpath)->resize(1000, 1000, function($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($thumbnailpath);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $item = Product::where('id', $id)->get();
       return $item;
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

    public function poto(Request $request){

        if($request->hasFile('profile_image')) {
            //get filename with extension
            $filenamewithextension = $request->file('profile_image')->getClientOriginalName();
     
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
     
            //get file extension
            $extension = $request->file('profile_image')->getClientOriginalExtension();
     
            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;
     
            //Upload File
            $request->file('profile_image')->storeAs('public/profile_images', $filenametostore);
            $request->file('profile_image')->storeAs('public/profile_images/thumbnail', $filenametostore);
     
            //Resize image here
            $thumbnailpath = public_path('storage/profile_images/thumbnail/'.$filenametostore);
            $img = Image::make($thumbnailpath)->resize(400, 400, function($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($thumbnailpath);
     
            return 'wena. la hiciste';
        }

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
