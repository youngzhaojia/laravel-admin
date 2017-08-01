<?php
/**
 * Created by ZhaoJia.
 * Email: youngzhaojia@qq.com
 * Date: 2017/7/30  下午4:55
 */

namespace App\Http\Requests;

use App\Common\BaseApiRequest;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RoleSaveRequest
 * @package App\Http\Requests
 */
class RoleSaveRequest extends FormRequest
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
            'name' => 'required|unique:admin_roles,name,' . $this->get('id', 0) . '|max:255',
        ];
    }
}