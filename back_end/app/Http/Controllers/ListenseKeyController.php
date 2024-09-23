<?php

namespace App\Http\Controllers;

use App\Models\ListenseKey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ListenseKeyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $title = "Danh sách";

        // Lấy các tham số từ request
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10); // Số lượng bản ghi trên mỗi trang
        $orderBy = $request->input('order_by', 'created_at'); // Cột để sắp xếp
        $direction = $request->input('direction', 'desc'); // Hướng sắp xếp

        // Các tham số tùy chỉnh khác
        $customWhere = []; // Điều kiện tùy chỉnh
        // $filters = $request->only(['category_id', 'brand_id']); // Các bộ lọc từ request
        $filters = []; // Các bộ lọc từ request

        // Tạo instance của ListenseKey
        $listenseKeyModel = new ListenseKey();

        // Gọi phương thức customPaginate
        $response = $listenseKeyModel->customPaginate(
            columns: ['*'], // Các cột cần lấy
            relations: [], // Các quan hệ cần eager load
            perPage: $perPage,
            orderBy: $orderBy,
            search: $search,
            customWhere: $customWhere,
            searchColumns: ['code'],
            relationSearchColumns: [],
            filters: $filters,
            all: '',
            direction: $direction
        );
        if (request()->ajax()) {
            return response()->json([
                'results' => view('listense-key.tbody', compact('response'))->render(),
                'pagination' => view('custom-pagination', compact('response'))->render(),
            ]);
        }

        // Trả về view với dữ liệu đã phân trang
        return view('listense-key.index', compact('response', 'title'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('listense-key.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {
            $credentials = Validator::make(
                $request->all(),
                [
                    'code' => 'required|unique:listense_keys',
                ],
                [
                    'code.required' => 'Mã không được để trống!',
                    'code.unique' => 'Mã đã được sử dụng!',
                ]
            );

            if ($credentials->fails()) {
                return response()->json(['status' => false, 'message' => $credentials->errors()->first()]);
            }

            ListenseKey::create($request->all());

            return response()->json(['status' => true, 'message' => 'Listense Key đã được tạo'], 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $listenseKey = ListenseKey::find($id);

        if ($listenseKey) {
            return response()->json(['status' => true, 'data' => $listenseKey], 200);
        }

        return response()->json(['status' => false, 'message' => 'Dữ liệu không tồn tại trên hệ thống!'], 500);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->ajax()) {
            $credentials = Validator::make(
                $request->all(),
                [
                    'code' => 'required|unique:listense_keys,code,' . $id,
                ],
                [
                    'code.required' => 'Mã không được được để trống!',
                    'code.unique' => 'Mã đã được sử dụng!',
                ]
            );

            if ($credentials->fails()) {
                return response()->json(['status' => false, 'message' => $credentials->errors()->first()]);
            }

            $listenseKey = ListenseKey::find($id);
            $listenseKey->update($request->all());

            return response()->json(['status' => true, 'message' => 'Listense Key đã được cập nhật'], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $listenseKey = ListenseKey::find($id);

        if ($listenseKey) {
            $listenseKey->delete();

            return response()->json(['status' => true, 'message' => 'Listense Key đã được xóa'], 200);
        }

        return response()->json(['status' => false, 'message' => 'Dữ liệu không tồn tại trên hệ thống!'], 500);
    }
}
