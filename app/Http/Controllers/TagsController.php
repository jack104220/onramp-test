<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TagsService;

class TagsController extends Controller
{
    public function __construct(protected TagsService $service) {}

    /**
     * 查詢列表
     *
     * @param Request $request
     * @return string
     */
    public function index(Request $request)
    {
        try {
            //查詢內容都先不做
            $data = $this->service->list();
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    /**
     * 新增tag
     *
     * @param Request $request
     * @return string
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => ['required', 'max:64'],
                'content' => ['required']
            ]);

            return $this->service->insert($data['name'], $data['content']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    /**
     * 查詢單一tag
     *
     * @param Request $request
     * @param int $tag
     * @return string
     */
    public function show(Request $request, $tag)
    {
        try {
            return $this->service->detail($tag);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    /**
     * 修改tag
     *
     * @param Request $request
     * @param int $tag
     * @return string
     */
    public function update(Request $request, $tag)
    {
        try {
            $data = $request->validate([
                'name' => ['required', 'max:64'],
                'content' => ['required']
            ]);

            return $this->service->update($tag, $data['name'], $data['content']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    /**
     * 刪除tag
     *
     * @param int $tag
     * @return string
     */
    public function destroy($tag)
    {
        try {
            return $this->service->delete($tag);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }
}
