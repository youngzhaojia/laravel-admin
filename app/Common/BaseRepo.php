<?php
/**
 * Created by ZhaoJia.
 * Email: youngzhaojia@qq.com
 * Date: 2017/7/19  上午00:01
 */

namespace App\Common;

/**
 * Class BaseRepo
 * @package App\Repo
 */
class BaseRepo
{
    protected $model;

    public $key_field = 'id'; // 主键

    public $page_size = 20;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function create(array $data)
    {
        $rs = $this->model->create($data);
        if ($rs instanceof $this->model) {
            return $rs->id;
        }
        return 0;
    }

    public function update($id, $data)
    {
        if (array_key_exists($this->key_field, $data)) { // 去掉包含的主键
            unset($data[$this->key_field]);
        }
        return $this->model->where($this->key_field, $id)->update($data);
    }

    public function get_by_id($id)
    {
        return $this->model->where($this->key_field, $id)->first();
    }
}