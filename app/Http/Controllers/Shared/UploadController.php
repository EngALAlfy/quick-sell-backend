<?php

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UploadController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        try {
            $request->validate([
                "file" => 'required|mimes:jpg,png,jpeg|max:10000'
            ]);

            $input = $request->all();

            $file_data = upload_file($input["file"] , true);

            return $this->sendJsonSuccess($file_data);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'error' => ($e->errors())["file"],
            ], 422);
        }
    }
}
