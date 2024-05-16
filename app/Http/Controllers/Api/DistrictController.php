<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DistrictController extends Controller
{
    public function index()
    {
        $districts = District::all();

        if($districts->count() > 0){
            return response()->json([
                'status' => 200,
                'districts' => $districts
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'Không có quận huyện nào'
            ], 404);
        }
    }

    public function store(Request $request){
        // Đảm bảo rằng dữ liệu gửi lên là mảng
        $validator = Validator::make($request->all(), [
            '*.district_name' => 'required', // Sử dụng wildcard để kiểm tra mỗi phần tử
            '*.city_id' => 'required'
        ]);
    
        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $districts = [];
            // Xử lý từng đối tượng trong mảng
            foreach ($request->all() as $item) {
                $district = District::create([
                    'district_name' => $item['district_name'],
                    'city_id' => $item['city_id']
                ]);
                $districts[] = $district;
            }
    
            if(count($districts) > 0){
                return response()->json([
                    'status' => 200,
                    'message' => 'Thêm thành công các quận/huyện',
                    'districts' => $districts
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Lỗi'
                ], 500);
            }
        }
    }

    public function showOne($city_id, $id){
        $city = City::find($city_id);
        $district = District::find($id);
        if($district){
            return response()->json([
                'status' => 200,
                'city' => $city,
                'district' => $district
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'Không tìm thấy quận/huyện'
            ], 404);
        }
    }

    public function show($city_id){
        $city = City::find($city_id);
        $district = District::where('city_id', '=', $city_id)->get();
        if($district){
            return response()->json([
                'status' => 200,
                'city' => $city,
                'district' => $district
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'Không tìm thấy quận/huyện'
            ], 404);
        }
    }

    public function update(Request $request, int $id){
        $validator = Validator::make($request->all(), [
            'district_name' => 'required',
            'city_id' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }else{
            $district = District::find($id);

            if($district){
                $district->update([
                    'district_name' => $request->district_name,
                    'city_id' => $request->city_id
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
        $district = District::find($id);

        if($district){
            $district->delete();
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
