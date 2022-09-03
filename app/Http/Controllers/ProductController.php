<?php

namespace App\Http\Controllers;

use App\Models\ProductImage;
use Exception;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $data['products']=Product::paginate(12);

        return view('product.productindex', $data);
    }
    public function productShop()
    {
        $data['products']=Product::with('category')->paginate(12);
        return view('product.productshopgeneral', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $categories = Category::select('id','cat_name')->get();
        return view('product.productcreate', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'title' => 'required',
            'price' => 'required',
            'image_prod' => 'image|mimes:jpeg,bmp,png,svg,webp,jpg',
            'image_prods.*' => 'image|mimes:jpeg,bmp,png,svg,webp,jpg',
            'status' => 'required'
        ]);
        try {
            $filename = '';
            if ($request->file('image_prod')) {

                    $prodImgname = Str::of($request->input('title'))->trim();
                    $file = $request->file('image_prod');
                    $filename = $prodImgname.time().'.'.$file->getClientOriginalExtension();
                    $file->move(public_path('/uploads/products'), $filename);
            }

            $input = Product::create([
                'title' => trim($request->input('title')),
                'price' => trim($request->input('price')),
                'sale_price' => trim($request->input('sale_price')),
                'slug' => Str::slug(trim($request->input('title'))),
                'description' => trim($request->input('description')),
                'image_prod' =>$filename,
                'category_id'=>$request->input('category_id'),
                'status' => $request->input('status')

            ]);
                if ($request->file('image_prods')) {

                    $photos = $request->file('image_prods');
                    foreach ($photos as $photo) {
                    $prodImgnamenew = Str::of($request->input('title'))->trim();
                    $filenew = $photo;
                    $filenamenew = $prodImgnamenew.time().'.'.$filenew->getClientOriginalExtension();
                    $filenew->move(public_path('/uploads/products'), $filenamenew);

                        ProductImage::create([
                            'product_id' => $input->id,
                            'pi_sub_image' => $filenamenew
                        ]);
                }
            }

            session()->flash('message','Submitted!');
            session()->flash('type','success');
            return redirect()->back();
        }
        catch(Exception $e){

            session()->flash('message',$e->getMessage());
            session()->flash('type','danger');

            return redirect()->back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id)
    {
        try {
            $data['product'] = Product::with('category','productImages')->findOrFail($id);
            $data['randomproducts'] = Product::all()->random(4);
            return view('product.productshow', $data);
        }
        catch(Exception $e){

            session()->flash('message',$e->getMessage());
            session()->flash('type','danger');
            $products=Product::paginate(10);

            return view('product.productindex', compact('products'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $product=Product::with('category')->findOrFail($id);
        $categories = Category::select('id','cat_name')->get();
        return view('product.productedit', compact(['product', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        try {
            $data = Product::findOrFail($id);
            $productimage = ProductImage::where('product_id', $id)->get();
        }
        catch (Exception $e)
        {session()->flash('message',$e->getMessage());
            session()->flash('type','danger');

            return redirect()->back();}

        $this->validate($request, [
            'title' => 'required',
            'price' => 'required',
            'image_prod' => 'image|mimes:jpeg,bmp,png,svg,webp,jpg',
            'image_prods.*' => 'image|mimes:jpeg,bmp,png,svg,webp,jpg',
            'status' => 'required'
    ]);
        try {
            if($request->file('image_prod')) {

                if( File::exists(public_path('/uploads/products/'.$data->image_prod)) ) {
                    File::delete(public_path('/uploads/products/'.$data->image_prod));
                }

                $prodImgname = Str::of($request->input('title'))->trim();
                $file = $request->file('image_prod');
                $filename = $prodImgname.time().'.'.$file->getClientOriginalExtension();
                $file->move(public_path('/uploads/products'), $filename);

               $data->update([
                    'title' => trim($request->input('title')),
                    'price' => trim($request->input('price')),
                    'sale_price' => trim($request->input('sale_price')),
                    'slug' => Str::slug(trim($request->input('title'))),
                    'description' => trim($request->input('description')),
                    'image_prod' =>$filename,
                    'category_id'=>$request->input('category_id'),
                    'status' => $request->input('status')
                ]);

                if ($request->file('image_prods')) {
                        $c= 0;
                    $photos = $request->file('image_prods');
                    foreach ($photos as $photo) {
                        $prodImgnamenew = Str::of($request->input('title'))->trim();
                        $filenew = $photo;
                        $filenamenew = $prodImgnamenew.time().'.'.$filenew->getClientOriginalExtension();
                        $filenew->move(public_path('/uploads/products'), $filenamenew);

                        $productimage[$c]->update([
                            'pi_sub_image' => $filenamenew
                        ]);
                        $c+=1;
                    }
                }


                session()->flash('message','Submitted!');
                session()->flash('type','success');
                return redirect()->back();

            }
            else {
                $data->update([
                    'title' => trim($request->input('title')),
                    'price' => trim($request->input('price')),
                    'sale_price' => trim($request->input('sale_price')),
                    'slug' => Str::slug(trim($request->input('title'))),
                    'description' => trim($request->input('description')),
                    'category_id'=>$request->input('category_id'),
                    'status' => $request->input('status')
                ]);
                session()->flash('message', 'Submitted!');
                session()->flash('type', 'success');
                return redirect()->back();
            }
        }
        catch(Exception $e){

            session()->flash('message',$e->getMessage());
            session()->flash('type','danger');

            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        try {
            $data = Product::find($id);
            $productimage = ProductImage::where('product_id', $id)->get();
            if (File::exists(public_path('/uploads/products/' . $data->image_prod))) {
                File::delete(public_path('/uploads/products/' . $data->image_prod));
            }
            foreach ($productimage as $instance)
            {
                if (File::exists(public_path('/uploads/products/'.$instance->pi_sub_image))) {
                    File::delete(public_path('/uploads/products/'.$instance->pi_sub_image));
                }
                $instance->delete();
            }

            $data->delete();
            session()->flash('message', 'Deleted!');
            session()->flash('type', 'success');
            return redirect()->route("products.index");
        }
        catch(Exception $e){
            session()->flash('message',$e->getMessage());
            session()->flash('type','danger');

            return redirect()->back();
        }
    }
}
