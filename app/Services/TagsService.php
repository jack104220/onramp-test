<?php

namespace App\Services;

use App\Consts\ActionConst;
use App\Consts\TypeConst;
use App\Repositories\TagsRepository;
use App\Repositories\TagRecordsRepository;

class TagsService
{
    public function __construct(
        protected TagsRepository $tagsRepo,
        protected TagRecordsRepository $recordRepo
    ) {}

    /**
     * 查詢所有tag
     *
     * @return array|null
     */
    public function list()
    {
        return $this->tagsRepo->getAll()->toArray();
    }

    /**
     * 取得單一tag
     *
     * @param int $id
     * @return array|null
     */
    public function detail($id)
    {
        return $this->tagsRepo->getOne($id)->toArray();
    }

    /**
     * 取得tag的內容
     *
     * @param string $objectId
     * @return string
     */
    public function getContent($objectId)
    {
        $object = $this->tagsRepo->getOneByObjectId($objectId);
        if (empty($object)) {
            return '';
        }
        return $object->content;
    }

    /**
     * 新增tag
     *
     * @param string $name
     * @param string $content
     * @return bool
     */
    public function insert($name, $content)
    {
        $objectId = $this->getNewObjectId();
        $tag = $this->tagsRepo->insert([
            'name' => $name,
            'object_id' => $objectId,
            'content' => $content
        ]);

        if (empty($tag)) {
            return false;
        }

        return true;
    }

    /**
     * 更新tag
     *
     * @param int $id
     * @param string $name
     * @param string $content
     * @return bool
     */
    public function update($id, $name, $content)
    {
        $tag = $this->tagsRepo->update($id, [
            'name' => $name,
            'content' => $content
        ]);

        return true;
    }

    /**
     * 刪除tag
     *
     * @param int $id
     * @return int
     */
    public function delete($id)
    {
        return $this->tagsRepo->delete($id);
    }

    /**
     * 產生objectId
     *
     * @return string
     */
    private function getNewObjectId()
    {
        //一般會用加密hashtag去做 or redis incr處理
        do {
            $objectId = 'AW-' . str_pad(rand(0, 99999999999), 11, '0', STR_PAD_LEFT);
            $tag = $this->tagsRepo->getOneByObjectId($objectId);
            if (empty($tag)) {
                break;
            }
        } while (true);

        return $objectId;
    }

    /**
     * 增加紀錄，通常會扔queue解耦
     *
     * @param array $params
     * @return bool
     */
    public function addRecord($params)
    {
        $objectId = $params['object_id'];
        $params['action']   = ActionConst::LIST[strtolower($params['action'])] ?? ActionConst::UNKNOWN;
        $params['type']     = TypeConst::LIST[strtolower($params['type'])] ?? TypeConst::UNKNOWN;
        $params['currency'] = strtoupper($params['currency'] ?? 'USD');

        $object = $this->tagsRepo->getOneByObjectId($objectId);
        if (empty($object)) {
            return false;
        }

        $this->recordRepo->insert($params);

        return true;
    }
}