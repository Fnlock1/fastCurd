<?php

namespace App\Http\Controllers;

use App\Models\client;
use Illuminate\Http\Request;

class clientController extends Controller
{
    public function index()
    {
        $items = client::all();
        return response()->json($items);
    }

    public function store(Request $request)
    {
        $item = client::create($request->all());
        return response()->json($item, 201);
    }

    public function show($id)
    {
        $item = client::find($id);
        if (!$item) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $item = client::find($id);
        if (!$item) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($id)
    {
        $item = client::find($id);
        if (!$item) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        $item->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
