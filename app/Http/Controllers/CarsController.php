<?php

namespace App\Http\Controllers;

use Auth;
use File;
use App\User;
use App\CarsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = DB::table('cars')->paginate(5);

        return view('cars/list', ["cars" => $cars]);
    }

    /**
     * Show the form for searching cars.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchForm(Request $request)
    {
        $carsCount = DB::table('cars')->get();
        $brands = DB::table('car_brands')->get();
        $models_brand = DB::table('models_brand')->get();
        $engines = DB::table('car_engines')->get();
        $colors = DB::table('colors')->get();

        $data = [
            "brands"    => $brands,
            "models"    => $models_brand,
            "engines"   => $engines,
            "colors"    => $colors,
            "carsCount" => count($carsCount),
        ];

        return view('search/search', $data);
    }

    /**
     * Display a listing of searching form.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchResult(Request $request)
    {
        $this->validate($request, [
            'model'         => 'string|nullable',
            'brand'         => 'string|nullable',
            'engine'        => 'string|nullable',
            'color'         => 'string|nullable',
            'range_input'   => 'string',
        ]);

        $range = str_replace(['BGN',','], '', $request->input('range_price'));
        $price_range = explode("-", $range);
        $lowerPrice = (int)$price_range[0];
        $higherPrice = (int)$price_range[1];

        $conditions = array();
        foreach ($request->all() as $key => $value) {
            if ($value !== null) {
                switch ($key) {
                    case 'brand':
                            $conditions['car_brand'] = $value;
                        break;
                    case 'engine':
                            $conditions['car_engine'] = $value;
                        break;
                    case 'color':
                            $conditions['car_color'] = $value;
                        break;
                    case 'model':
                            $conditions['car_model'] = $value;
                        break;
                }
            }
        }
        $result = DB::table('cars')
                    ->whereBetween('car_price',[$lowerPrice, $higherPrice])
                    ->where($conditions)->paginate(5);

        if ($request->ajax()) {
            $result = DB::table('cars')
                    ->whereBetween('car_price',[$lowerPrice, $higherPrice])
                    ->where($conditions)->get();
            return response()->json(['count' => count($result)]);
        }

        return view('cars/list', ["cars" => $result]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->isAdmin != 1) {
            return redirect('cars');
        }

        $brands = DB::table('car_brands')->get();
        $models_brand = DB::table('models_brand')->get();
        $engines = DB::table('car_engines')->get();
        $colors = DB::table('colors')->get();

        $data = [
            "brands"    => $brands,
            "models"    => $models_brand,
            "engines"   => $engines,
            "colors"    => $colors,
        ];
        return view('cars/create', $data);
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
            'image'     => 'required|mimes:jpeg,png',
            'model'     => 'required',
            'brand'     => 'required',
            'engine'    => 'required',
            'color'     => 'required',
            'price'     => 'required|numeric',
        ]);
        
        $file = $request->file('image');
        $input = $request->all();

        $origName = $file->getClientOriginalName();
        $unique = date("Y_m_d_his_");
        $fileName = $unique . $origName;
        $storePath = 'images/' .  $fileName;
        $destinationPath = public_path().'/images/';

        $model = new CarsModel();
        $model->car_brand = $input['brand'];
        $model->car_model = $input['model'];
        $model->car_engine = $input['engine'];
        $model->car_color = $input['color'];
        $model->car_photo_dir = $storePath;
        $model->car_price = $input['price'];
        $model->save();
        $file->move($destinationPath, $fileName);

        return redirect('cars')->with('status', 'Create succesfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $car = DB::table('cars')->where('id_car', $id)->first();
        return view('cars/show', ["car" => $car]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->isAdmin != 1) {
            return redirect('models');
        }

        $car = DB::table('cars')->where('id_car', $id)->first();
        $brands = DB::table('car_brands')->get();
        $models_brand = DB::table('models_brand')->get();
        $engines = DB::table('car_engines')->get();
        $colors = DB::table('colors')->get();

        $data = [
            "brands"    => $brands,
            "models"    => $models_brand,
            "engines"   => $engines,
            "colors"    => $colors,
            "car"       => $car,
        ];
        return view('cars/edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'image'     => 'mimes:jpeg,png',
            'model'     => 'required',
            'brand'     => 'required',
            'engine'    => 'required',
            'color'     => 'required',
            'price'     => 'required|numeric',
        ]);

        $file = $request->file('image');
        $input = $request->all();

        $model = new CarsModel();
        $data = $model::find($id);
        $data->car_brand = $input['brand'];
        $data->car_model = $input['model'];
        $data->car_engine = $input['engine'];
        $data->car_color = $input['color'];

        if ($file !== null) {
            File::delete($data->car_photo_dir);
            $origName = $file->getClientOriginalName();
            $unique = date("Y_m_d_his_");
            $fileName = $unique . $origName;
            $storePath = 'images/' .  $fileName;
            $destinationPath = public_path().'/images/';

            $data->car_photo_dir = $storePath;
            $file->move($destinationPath, $fileName);
        }
        
        $data->car_price = $input['price'];
        $data->save();

        return redirect('cars')->with('status', 'Update succesed!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = CarsModel::find($id);
        if ($model === null) {
            return redirect('cars')->with('error', 'Delete fail!');
        }
        File::delete($model->car_photo_dir);
        $model->delete();
        return redirect('cars')->with('status', 'Model was deleted!');
    }
}
