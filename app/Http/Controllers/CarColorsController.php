<?php

namespace App\Http\Controllers;

use Auth;
use App\CarColorsModel;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;

class CarColorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colors = DB::table('colors')->paginate(5);

        return view('colors/list', ["colors" => $colors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->isAdmin != 1) {
            return redirect('colors');
        }
        return view('colors/create');
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
            'model' => 'required|unique:colors,color|max:120',
        ]);

        $colorName = $request->input('color');

        $model = new CarColorsModel();
        $model->color = $colorName;
        $model->save();
        return redirect('colors')->with('status', 'Create succesfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $name
     * @return \Illuminate\Http\Response
     */
    public function show($name)
    {
        $color = DB::table('colors')->where('color', $name)->first();
        
        return view('colors/show', ["color" => $color]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $colorName
     * @return \Illuminate\Http\Response
     */
    public function edit($colorName)
    {
        if (Auth::user()->isAdmin != 1) {
            return redirect('colors');
        }
        $color = DB::table('colors')->where('color', $colorName)->first();

        return view('colors/edit', ["colors" => $color]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $colorName
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $colorName)
    {
        $this->validate($request, [
            'newColor' => 'required|unique:colors,color|max:120',
            'oldColor' => 'required',
        ]);
        
        $newColorName = $request->input('newColor');
        $oldColorName = $request->input('oldColor');

        $model = new CarColorsModel();
        $data = $model::find($colorName);
        $data->color = $newColorName;
        $data->save();
        return redirect('colors')->with('status', 'Update succes!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $color
     * @return \Illuminate\Http\Response
     */
    public function destroy($color)
    {
        $model = CarColorsModel::find($color);
        if ($model === null) {
            return redirect('colors')->with('error', 'Delete fail!');
        }
        $model->delete();
        return redirect('colors')->with('status', 'Color was deleted!');
    }
}
