<?php
/**
 * Created by ZhaoJia.
 * Email: youngzhaojia@qq.com
 * Date: 2017/7/19  上午00:12
 */

namespace App\Common;

use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class Paginator
 *
 * @package app\common
 */
class MyPaginator extends LengthAwarePaginator
{
    public function __construct($items, $total, $perPage, $currentPage = null, array $options = [])
    {
        parent::__construct($items, $total, $perPage, $currentPage, $options);
    }

    public function toArray()
    {
        return [
            'page'       => (int)$this->currentPage(),
            'page_size'  => (int)$this->perPage(),
            'page_count' => $this->getPageCount(),
            'item_count' => (int)$this->total(),
            'offset'     => $this->getOffset(),
            'limit'      => $this->getLimit(),
        ];
    }

    public function getPageCount()
    {
        $pageSize = $this->perPage();
        $totalCount = $this->total();
        if ($pageSize < 1) {
            return $totalCount > 0 ? 1 : 0;
        } else {
            $totalCount = $totalCount < 0 ? 0 : (int)$totalCount;

            return (int)(($totalCount + $pageSize - 1) / $pageSize);
        }
    }

    public function getOffset()
    {
        return ($this->perPage() < 1) ? 0 : ($this->currentPage() - 1) * $this->perPage();
    }

    public function getLimit()
    {
        return ($this->perPage() < 1) ? -1 : $this->perPage();
    }
}