<?php
namespace App\Requests\Products;

use App\Requests\BaseRequestApi;

class CreateProductValidator extends BaseRequestApi {

    public function rules(): array
    {

        return [
            'title'=> 'required|min:5|max:40',
            'description'=> 'nullable|min:5|max:200',
            'size'=> 'required|min:0|numeric',
            'color' => 'required|in:red,green',
            'price' => 'nullable|numeric|min:1|max:10000',
        ];
    }

    public function authorized(): bool{
        return true;
    }
}
