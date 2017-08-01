<?php

namespace App\Http\Requests;

use App\Common\BaseApiRequest;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AdminSaveRequest
 * @package App\Http\Requests
 */
class AdminSaveRequest extends FormRequest
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
            'name' => 'required|unique:admins,name,' . $this->get('id', 0) . '|min:6|max:10',
            'email' => 'required|unique:admins,email,' . $this->get('id', 0) . '|email',
        ];
    }
}
