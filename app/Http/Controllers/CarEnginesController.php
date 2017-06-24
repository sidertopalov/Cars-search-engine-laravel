<?php

namespace App\Http\Controllers;

use Auth;
use App\CarEnginesModel;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;

class CarEnginesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $engines = DB::table('car_engines')->paginate(5);
        return view('engines/list', ["engines" => $engines]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->isAdmin != 1) {
            return redirect('engines');
        }
        return view('engines/create');
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
            'engine' => 'required|unique:car_engines,engines|max:120',
        ]);

        $engineName = $request->input('engine');

        $model = new CarEnginesModel();
        $model->engines = $engineName;
        $model->save();
        return redirect('engines')->with('status', 'Create succesfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $name
     * @return \Illuminate\Http\Response
     */
    public function show($name)
    {
        $engines = DB::table('car_engines')->where('engines', $name)->first();

        return view('engines/show', ["engines" => $engines]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $engineName
     * @return \Illuminate\Http\Response
     */
    public function edit($engineName)
    {
        if (Auth::user()->isAdmin != 1) {
            return redirect('brands');
        }
        $engine = DB::table('car_engines')->where('engines', $engineName)->first();

        return view('engines/edit', ["engines" => $engine]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $engineName
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $engineName)
    {
        $this->validate($request, [
            'newEngine' => 'required|unique:car_engines,engines|max:120',
            'oldEngine' => 'required',
        ]);
        $newEngineName = $request->input('newEngine');
        $oldEngineName = $request->input('oldEngine');

        $model = new CarEnginesModel();
        $data = $model::find($engineName);
        $data->engines = $newEngineName;
        $data->save();
        return redirect('engines')->with('status', 'Update succesed!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $engineName
     * @return \Illuminate\Http\Response
     */
    public function destroy($engineName)
    {
        $model = CarEnginesModel::find($engineName);
        if ($model === null) {
            return redirect('engines')->with('error', 'Delete fail!');
        }
        $model->delete();
        return redirect('engines')->with('status', 'Engine was deleted!');
    }
}
