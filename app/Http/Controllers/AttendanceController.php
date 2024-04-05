<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttedanceStoreRequest;
use App\Http\Resources\AttendanceResource;
use App\Models\Attendance;
use App\Models\Event;
use App\Traits\ApiResponse;
use Spatie\QueryBuilder\QueryBuilder;

class AttendanceController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $attendances = QueryBuilder::for(Attendance::class)
            ->paginate(10);

        return AttendanceResource::collection($attendances);
    }

    public function store(AttedanceStoreRequest $request)
    {
        $event = Event::find($request->event_id);

        $presentUsers = $request->user_ids;

        foreach ($presentUsers as $user) {
            Attendance::create([
                'event_id' => $event->id,
                'user_id' => $user,
                'created_by' => auth()->id()
            ]);
        }

        return $this->successResponse([], 'Attendance saved successfully');

    }

    public function update(AttedanceStoreRequest $request, Attendance $attendance)
    {
        $attendance->update($request->validated());

        return AttendanceResource::make($attendance);
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        return $this->emptyDataResponse();
    }
}
