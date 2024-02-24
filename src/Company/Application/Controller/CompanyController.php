<?php

namespace FinVista\Company\Application\Controller;

use App\Http\Controllers\Controller;
use FinVista\Company\Application\UseCase\CreateCompany;
use FinVista\Company\Application\UseCase\GetCompanies;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class CompanyController extends Controller
{
    public function index(GetCompanies $getCompanies): View
    {
        $companies = $getCompanies();
        return view('company::companies', compact('companies'));
    }

    public function store(Request $request, CreateCompany $createCompany): Response
    {
        $createCompany(
            $request->get('name'),
            $request->get('description'),
            $request->get('address'),
        );

        return Response('Ok', 201);
    }
}