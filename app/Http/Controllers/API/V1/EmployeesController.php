<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\UsersRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    public function index()
    {
        $employees = EmployeeResource::collection(Employee::all());
        return response()->json(['items' => $employees, 'totalCount' => $employees->count()]);
    }

    public function search(EmployeeRequest $request)
    {
        $users = Employee::wehere('type', 1);
        return response()->json(['items' => $users, 'total_count' => $users->count()]);
    }

    public function store(EmployeeRequest $request)
    {

        try{
            $employee = Employee::create($request->all());

            // ATUALIZA ENDEREÇO
            $employee->setAddresses($request->get('address', []));

            // ATUALIZA TELEFONES
            $employee->setPhones($request->get('phones', []));

            // ATUALIZA TELEFONES
            $employee->setBanks($request->get('banks', []));

            $response = [
                'sucess' => true,
                'data' => $employee,
                'message' => 'Cadastro efetuado com sucesso '
            ];

        }catch (\Exception $e){
            $response =  [
                'sucess' => false,
                'message' => $e->getMessage()
            ];
        }
        return response()->json($response);
    }


    public function show($id)
    {
        try{
            $results = new EmployeeResource(Employee::find($id));

        }catch (\Exception $e){
            $results = [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }

        return response()->json($results);

    }


    public function update(EmployeeRequest $request, Employee $employee)
    {

        try{
            $employee->update($request->all());

            // ATUALIZA ENDEREÇO
            $employee->setAddresses($request->get('address', []));

            // ATUALIZA TELEFONES
            $employee->setPhones($request->get('phones', []));

            // ATUALIZA TELEFONES
            $employee->setBanks($request->get('banks', []));

            $response = [
                'sucess' => true,
                'data' => $employee,
                'message' => 'Cadastro editado com sucesso '
            ];

        }catch (\Exception $e){
            $response = [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
        return response()->json($response);
    }


    public function destroy(Employee $employee)
    {
        $employee->delete();
        return response()->json('success');
    }
}
