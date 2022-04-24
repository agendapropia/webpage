<?php

namespace App\Http\Controllers\Modules\Stores;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Stores\StoreSchedule;

class StoreSchedulesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * List store schedules
     * POST /store-manager/stores/{storeId}/schedules
     */
    public function list(int $storeId, Request $request)
    {
        $row = isset($request->_row) ? $request->_row : 10;
        $orderByColumn = $request->get('_order_by_column') ?? 'id';
        $orderByType = $request->get('_order_by_type') ?? 'DESC';

        $stores = StoreSchedule::select(
            's.id',
            's.store_id',
            'd.name as day',
            's.start_time',
            's.end_time'
        )
            ->from('store_schedules as s')
            ->join('days as d', 's.day_id', 'd.id')
            ->where('s.store_id', $storeId)
            ->orderBy($orderByColumn, $orderByType)
            ->paginate($row);

        return $this->responseJson(true, 'list store schedules', $stores);
    }

    /**
     * Create store schedules
     * POST /store-manager/stores/{storeId}/schedules
     */
    public function create(int $storeId, Request $request)
    {
        /** validate */
        $request->validate([
            'day_id' => 'required|integer|in:0,1,2,3,4,5,6',
            'start_time' => 'required|date_format:H:i:s',
            'end_time' =>
                'required|after_or_equal:start_time|date_format:H:i:s',
        ]);

        /** store schedule creation */
        $storeSchedule = $this->getStoreScheduleByStoreIdAndDay(
            $storeId,
            $request->day_id
        );
        if (!$storeSchedule) {
            $storeSchedule = new StoreSchedule($request->all());
            $storeSchedule->store_id = $storeId;
        } else {
            $storeSchedule->start_time = $request->start_time;
            $storeSchedule->end_time = $request->end_time;
        }
        $storeSchedule->save();

        return $this->responseJson(
            true,
            'store schedule created',
            $storeSchedule
        );
    }

    /**
     * Delete store schedules
     * POST /store-manager/stores/{storeId}/schedules
     */
    public function delete(int $storeId, Request $request)
    {
        /** validate */
        $request->validate([
            '_id' => 'required|integer',
        ]);

        $storeSchedule = $this->getStoreScheduleById($request->_id);
        if (!$storeSchedule) {
            return $this->responseJson(false, 'store schedule no found', []);
        }

        if ($storeSchedule->store_id != $storeId) {
            return $this->responseJson(
                false,
                'store schedule not match data',
                []
            );
        }

        $storeSchedule->delete();

        return $this->responseJson(
            true,
            'store schedule delete',
            $request->_id
        );
    }

    /**
     * Repositories
     */
    public function getStoreScheduleByStoreIdAndDay(int $storeId, int $dayId)
    {
        return StoreSchedule::where('store_id', $storeId)
            ->where('day_id', $dayId)
            ->first();
    }
    public function getStoreScheduleById(int $id)
    {
        return StoreSchedule::where('id', $id)->first();
    }
}
