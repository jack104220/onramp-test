<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TagsService;
use Illuminate\Support\Facades\Log;

class RecieveController extends Controller
{
    public function __construct(protected TagsService $service) {}

    /**
     * 外部查詢用
     *
     * @param string $objectId
     * @return string
     */
    public function index($objectId)
    {
        $data = $this->service->getContent($objectId);
        return response($data)->header('Content-Type', 'application/x-javascrip');
    }

    /**
     * 紀錄相關動作
     *
     * @param Request $request
     * @return void
     */
    public function record(Request $request)
    {
        $objectId = $request->input('object_id');
        $action   = $request->input('action');
        $type     = $request->input('type');
        $value    = $request->input('value', 0);
        $currency = $request->input('currency');
        $session  = $request->session()->getId();

        if (empty($objectId)) {
            return response()->noContent();
        }

        try {
            $this->service->addRecord([
                'object_id'  => $objectId,
                'action'     => $action,
                'type'       => $type,
                'value'      => $value,
                'currency'   => $currency,
                'session_id' => $session,
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

        return response()->noContent();
    }
}
