<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TodoUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $user = auth()->user();

        $todos = $user->todos;

        return response()->json([
            'status' => true,
            'data' => $todos
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo): JsonResponse
    {

        if (!$todo || $todo->user_id !== auth()->id()) {
            return response()->json([
                'status' => false,
                'message' => 'This data doesn\'t belong to you',
            ], Response::HTTP_FORBIDDEN);
        }

        return response()->json([
            'status' => true,
            'user' => $todo
        ], Response::HTTP_OK);
    }
}
