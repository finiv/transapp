<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Enum\TransactionTypeEnum;

class StoreTransactionRequest extends FormRequest
{
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
        // $type = $this->get('type');
        $types = implode(',', TransactionTypeEnum::values()->toArray());
        
        return [
            'amount' => 'required|integer',
            'type' => 'required|in:' . $types,
        ];
    }
}