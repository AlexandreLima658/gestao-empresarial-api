<?php

namespace App\Http\Controllers;

use App\Application\UseCases\Enterprise\create\CreateEnterprise;
use App\Application\UseCases\Enterprise\retrieve\RetrieveEnterprise;
use Illuminate\Http\Request;

class EnterpriseController extends Controller
{
    private CreateEnterprise $createEnterprise;

    public function __construct(CreateEnterprise $createEnterprise)
    {
        $this->createEnterprise = $createEnterprise;
    }

    public function store(Request $request)
    {
        $enterprise = $this->createEnterprise->execute(
            $request->input('name')
        );

        return response()->json([
            'id' => $enterprise->getId(),
            'name' => $enterprise->getName()
        ], 201);
    }

    public function index(RetrieveEnterprise $retrieveEnterprise)
    {
        $enterprises = $retrieveEnterprise->execute();

        return response()->json(
            array_map(function($enterprise){
                return [
                    'id' => $enterprise->getId(),
                    'name' => $enterprise->getName(),
                ];
            }, $enterprises)
        );
    }



}
