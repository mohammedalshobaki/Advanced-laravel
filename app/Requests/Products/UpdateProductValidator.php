<?php

namespace App\Requests\Products;

use App\Requests\BaseRequestApi;
use Illuminate\Validation\Rule;

class UpdateProductValidator extends BaseRequestApi
{

    public function rules(): array
    {
        $id = $this->request()->segment(3);
        return [
//            'title' => [Rule::unique('products')->ignore($id), 'min:5', 'max:40'],
            'description' => 'nullable|min:5|max:200',
            'size' => 'required|min:0|max:40|numeric',
            'color' => 'required|in:red,green',
            'price' => 'nullable|numeric|min:1|max:10000',
        ];
    }

    public function authorized(): bool
    {
        return true;
    }
}
