<?php

namespace App\Repositories;

use App\Models\Tags;

class TagsRepository
{
    public function __construct(protected Tags $model) {}

    /**
     * 取得全部資料
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return $this->model->with('records')->get();
    }

    /**
     * 取得單一筆
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getOne($id)
    {
        return $this->model->with('records')->find($id);
    }

    /**
     * 用objectId取得單一筆
     *
     * @param string $objectId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getOneByObjectId($objectId)
    {
        return $this->model->where('object_id', $objectId)->first();
    }

    /**
     * 新增紀錄
     *
     * @param array $params
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function insert($params)
    {
        $model = new Tags();
        foreach ($params as $column => $value) {
            $model->$column = $value;
        }
        $model->save();
        return $model;
    }

    /**
     * 修改紀錄
     *
     * @param int $id
     * @param array $params
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function update($id, $params)
    {
        $model = $this->model->find($id);
        if (empty($model)) {
            throw new \Exception('Object not exist');
        }

        foreach ($params as $column => $value) {
            $model->$column = $value;
        }
        $model->save();
        return $model;
    }

    /**
     * 刪除資料 (一般做軟刪除)
     *
     * @param int $id
     * @return int
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }
}