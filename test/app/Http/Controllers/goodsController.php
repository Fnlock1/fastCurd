<?php

namespace App\Http\Controllers;

use App\Models\goods;
use Illuminate\Http\Request;

class goodsController extends Controller
{
    public function index()
    {
        $items = goods::all();
        return response()->json($items);
    }

    public function store(Request $request)
    {
        $item = goods::create($request->all());
        return response()->json($item, 201);
    }

    public function show($id)
    {
        $item = goods::find($id);
        if (!$item) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $item = goods::find($id);
        if (!$item) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($id)
    {
        $item = goods::find($id);
        if (!$item) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        $item->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
