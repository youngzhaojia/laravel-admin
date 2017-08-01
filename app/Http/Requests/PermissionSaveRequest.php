<?php
/**
 * Created by ZhaoJia.
 * Email: youngzhaojia@qq.com
 * Date: 2017/7/26  下午8:31
 */

namespace App\Http\Requests;

use App\Common\BaseApiRequest;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PermissionSaveRequest
 * @package App\Http\Requests
 */
class PermissionSaveRequest extends FormRequest
{
    use BaseApiRequest;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'  => 'required|unique:admin_permissions,name,' . $this->get('id', 0) . '|max:255',
            'label' => 'required|unique:admin_permissions,label,' . $this->get('id', 0) . '|max:255',
            'cid'   => $this->get('id', 0) > 0 ? 'int' : 'required|int', //新建必须，更新没有
        ];
    }
}