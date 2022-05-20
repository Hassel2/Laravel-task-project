<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Http;

class TaskController extends Controller
{
	public function show(Request $request) {
		/* $task = Task::all(); */

		$token = $request->bearerToken();	
		$usr_data = Http::withHeaders([
			'Accept'        => 'application/json',
			'Authorization' => 'Bearer '.$token,
		])->get('http://127.0.0.1:8000/api/user')->json();

		$task = Task::where('user_id','=', $usr_data['id'])->get();
		return $this->sendResponse($task->toArray(), 'Tasks retrieved successfully');	
	}

	public function find(Request $request, $id) {
		$task = Task::find($id);

		if (is_null($task)) {
			return $this->sendError('Task not found');
		}
		
		$token = $request->bearerToken();	
		$usr_data = Http::withHeaders([
			'Accept'        => 'application/json',
			'Authorization' => 'Bearer '.$token,
		])->get('http://127.0.0.1:8000/api/user')->json();

		if ($usr_data['id'] == $task->user()['id']){
			return $this->sendResponse($task->toArray(), 'Task retrieved successfully.');
		}

		return $this->sendError('Task not found'); 
	}

	public function create(Request $request) {
		$input = $request->all();
		
		$request->validate([
			'user_id' => 'required',
			'title' => 'required|string',
			'description' => 'required|string'
		]);

		$task = Task::create($input);

		return $this->sendResponse($task->toArray(), 'Task created succesfully');
	} 

	public function update(Request $request, Task $task) {
		$input = $request->all();

		$request->validate([
			'id' => 'required|exists:tasks,id',
			'title' => 'required|string',
			'description' => 'required|string',
		]);	

		$task->title = $input['title'];
		$task->description = $input['description'];
		$task->save();

		return $this->sendResponse($task->toArray(), 'Task updated successfully');
	}	

	public function delete(Task $task) {
		$task->delete();

		return $this->sendResponse($task->toArray(), 'Task deleted successfully');
	}
}
