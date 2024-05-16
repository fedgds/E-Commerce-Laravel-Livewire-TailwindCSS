<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::all();

        if($cities->count() > 0){
            return response()->json([
                'status' => 200,
                'cities' => $cities
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'Không có thành phố nào'
            ], 404);
        }
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'city_name' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }else{
            $city = City::create([
                'city_name' => $request->city_name
            ]);

            if($city){
                return response()->json([
                    'status' => 200,
                    'message' => 'Thêm thành công thành phố'
                ], 200);
            }else{
                return response()->json([
                    'status' => 500,
                    'message' => 'Lỗi'
                ], 500);
            }
        }
    }

    public function show($id){
        $city = City::find($id);
        if($city){
            return response()->json([
                'status' => 200,
                'city' => $city
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'Không tìm thấy thành phố'
            ], 404);
        }
    }


    public function update(Request $request, int $id){
        $validator = Validator::make($request->all(), [
            'city_name' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }else{
            $city = City::find($id);

            if($city){
                $city->update([
                    'city_name' => $request->city_name
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'Cập nhật thành công thành phố'
                ], 200);
            }else{
                return response()->json([
                    'status' => 404,
                    'message' => 'Không tìm thấy thành phố'
                ], 404);
            }
        }
    }

    public function destroy($id){
        $city = City::find($id);

        if($city){
            $city->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Xóa thành công thành phố'
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'Không tìm thấy thành phố'
            ], 404);
        }
    }
}
