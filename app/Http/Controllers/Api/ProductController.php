<?php

namespace App\Http\Controllers\Api;

use App\Exports\ProductsExport;
use App\Models\Product;
use App\Requests\Products\CreateProductValidator;
use App\Requests\Products\UpdateProductValidator;
use App\Services\ProductsService;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends BaseController
{
    public $productService;

    public function __construct(ProductsService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        // SOLID
        /**
         * Single responsibility.
         * Open-Close.
         * Liskov substitution.
         * interface segregation.
         * Dependency injection.
         */
        return $this->productService->getProducts();
    }

    public function store(CreateProductValidator $CreateProductValidator)
    {
 

        if (!empty($CreateProductValidator->getErrors())) {
            dd($CreateProductValidator->getErrors());
            return response()->json($CreateProductValidator->getErrors(), 406);
            
        }

        $request = $CreateProductValidator->request()->all();
        $request['user_id'] = Auth::id();
        $response = $this->productService->createProduct($request);

        return $this->sendResponse($response);
    }

    public function update($id, UpdateProductValidator $UpdateProductValidator)
    {

        if (!empty($UpdateProductValidator->getErrors())) {
            return response()->json($UpdateProductValidator->getErrors(), 406);
        }

        $request = $UpdateProductValidator->request()->all();
        $request['user_id'] = Auth::id();
        Product::query()->find($id)->update($request);
        $response = $this->productService->updateProduct($id, $request);

        return $this->sendResponse(1);
    }

    public function destroy($id)
    {
        return $this->productService->deleteProduct($id)?
            $this->sendResponse("Deleted"):
            $this->sendResponse("No Data Found", 404, 404) ;
    }

    public function export()
    {
        return Excel::download(new ProductsExport(), 'export.xlsx');
    }

    public function import()
    {

    }
}
