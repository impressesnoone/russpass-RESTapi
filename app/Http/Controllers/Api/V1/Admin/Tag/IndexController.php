<?php

namespace App\Http\Controllers\Api\V1\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        try {
            $tags = Tag::paginate(10);
            return response()->json([
                'data' => [
                    'status' => true,
                    'code' => 200,
                    'tags' => $tags
                ]
            ], 200);
        } catch (\Throwable $tr) {
            return response()->json([
                'error' => [
                    'code' => 500,
                    'message' => 'Server Error',
                    'errors' => $tr->getMessage(),
                ]
            ], 500);
        }

    }
}
