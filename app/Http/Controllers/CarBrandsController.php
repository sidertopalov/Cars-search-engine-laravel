<?php

namespace App\Http\Controllers;

use Auth;
use App\CarBrandsModel;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;

class CarBrandsController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = DB::table('car_brands')->paginate(5);

        return view('brand/list', ["brands" => $brands]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->isAdmin != 1) {
            return redirect('brands');
        }
        return view('brand/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'brand' => 'required|unique:car_brands,brand|max:120',
        ]);

        $brandName = $request->input('brand');

        $model = new CarBrandsModel();
        $model->brand = $brandName;
        $model->save();
        return redirect('brands')->with('status', 'Create succesfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $name
     * @return \Illuminate\Http\Response
     */
    public function show($name)
    {
        $brand = DB::table('car_brands')->where('brand', $name)->first();
        
        return view('brand/show', ["brand" => $brand]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $brandName
     * @return \Illuminate\Http\Response
     */
    public function edit($brandName)
    {

        if (Auth::user()->isAdmin != 1) {
            return redirect('brands');
        }
        $brand = DB::table('car_brands')->where('brand', $brandName)->first();

        return view('brand/edit', ["brand" => $brand]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $brandName
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $brandName)
    {
        $this->validate($request, [
            'newBrand' => 'required|unique:car_brands,brand|max:120',
            'oldBrand' => 'required',
        ]);

        $newBrand = $request->input('newBrand');
        $oldBrand = $request->input('oldBrand');
        if ($brandName != $oldBrand) {
            return redirect('brands')->with('error', 'Update fail! Try again but this time without any tricks!');
        }

        $model = new CarBrandsModel();
        $data = $model::find($oldBrand);
        $data->brand = $newBrand;
        $data->save();
        DB::table('models_brand')->where('brand', $oldBrand)->update(['brand' => $newBrand]);

        return redirect('brands')->with('status', 'Update succesed!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $brandName
     * @return \Illuminate\Http\Response
     */
    public function destroy($brandName)
    {
        $model = CarBrandsModel::find($brandName);
        if ($model === null) {
            return redirect('brands')->with('error', 'Delete fail!');
        }
        $model->delete();
        return redirect('brands')->with('status', 'Brand was deleted!');
    }
}
