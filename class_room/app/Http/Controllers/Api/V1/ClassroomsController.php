<?php

namespace App\Http\Controllers\Api\V1;

use Throwable;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use App\Http\Resources\ClassroomResource;
use App\Http\Resources\ClassroomCollection;

class ClassroomsController extends Controller
{
    public function index()
    {
        if (!Auth::guard('sanctum')->user()->tokenCan('classrooms.read')) {
            abort(403);
        }
        $classrooms = Classroom::with('user:id,name', 'topics')
            ->withCount('students')
            ->get();

        return new ClassroomCollection($classrooms);
    }


    public function store(Request $request)
    {
        if (!Auth::guard('sanctum')->user()->tokenCan('classrooms.create')) {
            abort(403);
        }
        // try {
        //     $request->validate([
        //         'name' => ['required']
        //     ]);

        //     $classroom = Classroom::create($request->all());
        // } catch (Throwable $e) {
        //     return response()->json([
        //         'message' => $e->getMessage(),
        //     ], 422);
        // }

        $request->validate([
            'name' => ['required']
        ]);

        $classroom = Classroom::create($request->all());

        return [
            'code' => 100,
            'message' => __('Classroom created.'),
            'classroom' => $classroom,
        ];
    }


    public function show(Classroom $classroom)
    {
        if(!Auth::guard('sanctum')->user()->tokenCan('classrooms.read')){
            abort(403);
        }

        $classroom->load('user')->loadCount('students');
        return new ClassroomResource($classroom);
    }


    public function update(Request $request, Classroom $classroom)
    {
        if(!Auth::guard('sanctum')->user()->tokenCan('classrooms.update')){
            abort(403 , 'you cant edit this classroom');
        }

        $request->validate([
            'name' => ['sometimes', 'required', Rule::unique('classrooms', 'name')->ignore($classroom->id)],
            'section' => ['sometimes', 'required']
        ]);

        $classroom->update($request->all());

        return [
            'code' => 100,
            'message' => __('Classroom updated.'),
            'classroom' => $classroom,
        ];
    }


    public function destroy(Classroom $classroom)
    {
        if(!Auth::guard('sanctum')->user()->tokenCan('classrooms.delete')){
            abort(403 , 'you cant delete this classroom');
        }
        // Classroom::destroy($id);
        $classroom->delete();

        // 204: no response (no content)
        return Response::json([], 204);
    }
}
