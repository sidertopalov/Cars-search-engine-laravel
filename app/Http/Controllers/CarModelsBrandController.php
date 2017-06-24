<?php

namespace App\Http\Controllers;

use Auth;
use App\CarModelsBrandModel;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;

class CarModelsBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $brands = DB::table('car_brands')->get();
        $search = $request->input('search');
        if ($search !== null) {
            $models = DB::table('models_brand')->where('brand', $search)->paginate(5);
        } else {
            $models = DB::table('models_brand')->paginate(5);
        }
        return view('models_brand/list', ["models" => $models, "brands" => $brands]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->isAdmin != 1) {
            return redirect('models');
        }
        $brands = DB::table('car_brands')->get();

        return view('models_brand/create', ["brands" => $brands]);
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
            'model' => 'required|unique:models_brand,model|max:120',
            'brand' => 'required',
        ]);

        $modelName = $request->input('model');
        $modelBrand = $request->input('brand');

        $model = new CarModelsBrandModel();
        $model->model = $modelName;
        $model->brand = $modelBrand;
        $model->save();
        return redirect('models')->with('status', 'Create succesfully');
     }

    /**
     * Display the specified resource.
     *
     * @param  string  $modelName
     * @return \Illuminate\Http\Response
     */
    public function show($modelName)
    {
        $model = DB::table('models_brand')->where('model', $modelName)->first();

        return view('models_brand/show', ["model" => $model]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $modelName
     * @return \Illuminate\Http\Response
     */
    public function edit($modelName)
    {
        if (Auth::user()->isAdmin != 1) {
            return redirect('models');
        }

        $model = DB::table('models_brand')->where('model', $modelName)->first();
        return view('models_brand/edit', ["model" => $model]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $modelName
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $modelName)
    {

        $this->validate($request, [
            'newModel' => 'required|unique:models_brand,model|max:120',
            'oldModel' => 'required',
        ]);

        $newModelName = $request->input('newModel');
        $oldModelName = $request->input('oldModel');

        $model = new CarModelsBrandModel();
        $data = $model::find($modelName);
        $data->model = $newModelName;
        $data->save();
        return redirect('models')->with('status', 'Update succesed!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $modelName
     * @return \Illuminate\Http\Response
     */
    public function destroy($modelName)
    {
        $model = CarModelsBrandModel::find($modelName);
        if ($model === null) {
            return redirect('models')->with('error', 'Delete fail!');
        }
        $model->delete();
        return redirect('models')->with('status', 'Model was deleted!');
    }
}
