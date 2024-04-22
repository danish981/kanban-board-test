<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePhaseRequest;
use App\Http\Requests\UpdatePhaseRequest;
use App\Models\Phase;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PhaseController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @param StorePhaseRequest $request
     */
    public function store(StorePhaseRequest $request) {
        //
    }

    /**
     * Display the specified resource.
     * @param Phase $phase
     * @return string
     */
    public function show(Phase $phase) {
        return $phase->load('tasks.user')->toJson();
    }

    public function markPhaseStateAsCompleted(Request $request) {
        $phase = Phase::find($request['phase_id']);
        if ($phase) {
            $phase['is_completion_phase'] = true;
            $phase->save();
            $phase->tasks()->update([
                'phase_id' => Phase::whereName('Completed')->first()->id,
                'completed_at' => now()->format('Y-m-d H:i:s')
            ]);
            return response()->json(['marked' => true]);
        }
        return response()->json(['marked' => false]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param Phase $phase
     */
    public function edit(Phase $phase) {
        //
    }

    /**
     * Update the specified resource in storage.
     * @param UpdatePhaseRequest $request
     * @param Phase $phase
     */
    public function update(UpdatePhaseRequest $request, Phase $phase) {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param Phase $phase
     * @return JsonResponse
     */
    public function destroy(Phase $phase) {

        if ($phase->name !== 'Completed') {

            $phaseName = $phase->name;
            $phaseTasksCount = $phase->tasks->count();

            foreach ($phase->tasks as $task) {
                $task->delete();
            }

            $phase->delete();
            return response()->json([
                'deleted_phase' => $phaseName,
                'message' => 'Phase ' . $phaseName . ' and ' . $phaseTasksCount . ' of its underlying tasks deleted',
                'deleted' => true
            ]);

        } else if($phase->name === 'Completed') {
            return response()->json([
                'message' => 'Cannot delete the completd phase',
                'deleted' => false
            ], 409);
        }

        return response()->json([
            'message' => 'Unable to delete the phase, please try again later',
            'deleted' => false
        ], 409);


    }
}
