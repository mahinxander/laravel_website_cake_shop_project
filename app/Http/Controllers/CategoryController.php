<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $data['categories']=Category::select('id','cat_name', 'slug','status','description','image_cat')->paginate(10);
        return view('category.categoryindexuser', $data);// category/categoryindex works too
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $categories = Category::select('id','cat_name')->get();
        return view('category.categorycreate', compact('categories'));

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
            'cat_name' => 'required|unique:categories,cat_name',
            'status' => 'required'
        ]);
        try {
            $filename='';
            if($request->file('image_cat'))
            {
                $catename= Str::of($request->input('cat_name'))->trim();
                $file= $request->file('image_cat');
                $filename= $catename.time().'.'.$file->getClientOriginalExtension();
                $file-> move(public_path('/uploads/categories'), $filename);
            }
        Category::create([
            'cat_name' => trim($request->input('cat_name')),
            'slug' => Str::slug(trim($request->input('cat_name'))),
            'description' => trim($request->input('description')),
            'image_cat' =>$filename,
            'category_id'=>$request->input('category_id'),
            'status' => $request->input('status')

        ]);
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
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        try {
            $data['category'] = Category::findOrFail($id);
            $data['category'] = $data['category']->setRelation('products', $data['category']->products()->paginate(10));

            return view('category.categoryshowuser', $data);
        }
        catch(Exception $e){

        session()->flash('message',$e->getMessage());
        session()->flash('type','danger');
        $categories=Category::paginate(10);

        return view('category.categoryindexuser', compact('categories'));
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
        $category=Category::find($id);
        $categories_name = Category::select('id','cat_name')->get();
        return view('category.categoryedit', compact(['category', 'categories_name']));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, $id): RedirectResponse
    {
        try {
            $data = Category::findOrFail($id);
        }
        catch (Exception $e)
        {session()->flash('message',$e->getMessage());
            session()->flash('type','danger');

            return redirect()->back();}

        $this->validate($request, [
            'cat_name' => 'required|unique:categories,cat_name,'.$id,
            'status' => 'required'
        ]);
        try {
            if($request->file('image_cat'))
            {
                if( File::exists(public_path('/uploads/categories/'.$data->image_cat)) ) {
                    File::delete(public_path('/uploads/categories/'.$data->image_cat));
                }

                $catename= Str::of($request->input('cat_name'))->trim();
                $file= $request->file('image_cat');
                $filename= $catename.time().'.'.$file->getClientOriginalExtension();
                $file-> move(public_path('/uploads/categories'), $filename);

                $data->update([
                    'cat_name' => trim($request->input('cat_name')),
                    'slug' => Str::slug(trim($request->input('cat_name'))),
                    'description' => trim($request->input('description')),
                    'image_cat' =>$filename,
                    'category_id'=>$request->input('category_id'),
                    'status' => $request->input('status')
                ]);
                session()->flash('message','Submitted!');
                session()->flash('type','success');
                return redirect()->back();

            }
            else {
                $data->update([
                    'cat_name' => trim($request->input('cat_name')),
                    'slug' => Str::slug(trim($request->input('cat_name'))),
                    'description' => trim($request->input('description')),
                    'category_id' => $request->input('category_id'),
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
            $data = Category::find($id);
            $data->delete();
            session()->flash('message', 'Deleted!');
            session()->flash('type', 'success');
            return redirect()->route("categories.index");
        }
        catch(Exception $e){
        session()->flash('message',$e->getMessage());
        session()->flash('type','danger');

        return redirect()->back();
    }

    }
}
