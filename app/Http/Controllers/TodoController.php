<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoRequest;
use App\Models\Todo;
use App\Http\Requests\UpdateTodoRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $todos = Todo::all();

        return response()->json([
            'status' => true,
            'data' => $todos
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTodoRequest $request): JsonResponse
    {
        $user = auth()->id();

        $todo = Todo::create([
            'user_id' => $user,
            'title' => $request['title'],
            'description' => $request['description'],
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Todo item created successfully',
            'data' => $todo
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo): JsonResponse
    {
        return response()->json([
            'status' => true,
            'data' => $todo
        ], Response::HTTP_OK);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTodoRequest $request, Todo $todo): JsonResponse
    {
        $validated = $request->validated();

        if (!$todo || $todo->user_id !== auth()->id()) {
            return response()->json([
                'status' => false,
                'message' => 'You can\'t Update this Todo item'
            ], Response::HTTP_FORBIDDEN);
        }

        $todo->update($validated);

        return response()->json([
            'status' => true,
            'message' => 'Todo item updated successfully',
            'data' => $todo
        ], Response::HTTP_OK);
    }

    /**
     * Update the Status of the Specified Resource
     */
    public function completed(Todo $todo): JsonResponse
    {
        if (!$todo || $todo->user_id !== auth()->id()) {
            return response()->json([
                'message' => 'Unauthorized'
            ], Response::HTTP_FORBIDDEN);
        }

        $todo->status = 1;
        $todo->update();

        return response()->json([
           'status' => true,
           'message' => 'Todo item completed successfully',
           'data' => $todo
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo): JsonResponse
    {

        if (!$todo || $todo->user_id !== auth()->id()) {
            return response()->json([
                'status' => false,
                'message' => 'You can\'t delete this Todo item',
            ], Response::HTTP_FORBIDDEN);
        }

        $todo->delete();

        return response()->json([
            'status' => true,
            'message' => 'Todo item deleted successfully'
        ], Response::HTTP_OK);
    }
}
