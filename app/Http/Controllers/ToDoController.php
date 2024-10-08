<?php

namespace App\Http\Controllers;

use App\Models\ToDo;
use App\Traits\ApiResponseTraits;
use DB;
use Illuminate\Http\Request;

class ToDoController extends Controller
{
    use ApiResponseTraits;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = request()->get("user_id");
        $data = ToDo::where("user_id", $userId)
            ->with("user")
            ->latest()
            ->paginate(10);
        return $this->sendResponse($data, "To do list of current user.");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formData = $request->validate([
            "description" => "required",
            "status" => ["required", "in:ongoing,done"],
        ]);
        try {
            DB::beginTransaction();

            $formData["user_id"] = auth()->user()->id;
            ToDo::create($formData);

            DB::commit();
            return $this->sendResponse([], "To Do Item Successfully Created.");
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->sendError($th, "Something went wrong");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ToDo $toDo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ToDo $toDo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $formData = $request->validate([
            "description" => "required",
            "status" => ["required", "in:ongoing,done"],
        ]);

        try {
            $toDo = ToDo::findOrFail($id);
            $toDo->update($formData);
            return $this->sendResponse([], "To Do Item Successfully Updated.");
        } catch (\Throwable $th) {
            return $this->sendError($th, "Something went wrong");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $toDo = ToDo::findOrFail($id);
        $toDo->delete();
        return $this->sendResponse([], "To Do Item Successfully Deleted.");
    }
}
