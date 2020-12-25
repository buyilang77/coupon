<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\MainController;
use App\Models\LogisticsCompany;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LogisticsCompaniesController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $company = LogisticsCompany::get();
        return custom_response($company);
    }
}
