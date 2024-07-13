<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CodeGeneratorService;

class CodeGeneratorController extends Controller
{
    protected $codeGenerator;

    public function __construct(CodeGeneratorService $codeGenerator)
    {
        $this->codeGenerator = $codeGenerator;
    }

    public function generate(Request $request)
    {
        $request->validate([
            'type' => 'required|string|in:controller,model,migration',
            'name' => 'required|string'
        ]);

        try {
            $this->codeGenerator->generate($request->type, $request->name);
            return response()->json(['message' => "{$request->type} {$request->name} created successfully."]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
