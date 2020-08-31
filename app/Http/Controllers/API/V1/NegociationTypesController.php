<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\NegociationType;
use Illuminate\Http\Request;

class NegociationTypesController extends Controller
{
    public function index()
    {
        $categories = NegociationType::all();
        return response()->json(['items' => $categories, 'totalCount' => $categories->count()]);
    }
}
