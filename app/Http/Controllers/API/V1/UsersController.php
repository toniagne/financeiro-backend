<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UsersRequest;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Resources\UsersResource;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    public function index()
    {

        $users = UsersResource::collection(User::all());
        return response()->json(['items' => $users, 'totalCount' => $users->count()]);
    }

    public function search(Request $request)
    {
        $users = User::all();
        return response()->json(['items' => $users, 'total_count' => $users->count()]);
    }

    public function store(UsersRequest $request)
    {

        $request['password'] = bcrypt($request->get('password'));

        try{
            $user = User::create($request->all());

            $user->setPhones($request->get('phones', []));

            $permissions = Permission::setPermissions($user->id, $request->get('permissions'));

            $response = [
                'success' => true,
                'data' => $user,
                'message' => 'Cadastro efetuado com sucesso '
            ];

        }catch (\Exception $e){
            $response =  [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
        return response()->json($response);
    }


    public function show(User $user)
    {
        $data = new UsersResource($user);
        $permissions = $user->permission->parse();
        return response()->json(['user' => $data, 'permissions' => $permissions]);
    }



    public function update(UsersRequest $request, User $user)
    {

        $request['password'] = bcrypt($request->get('password'));

        try {
            $user->update($request->all());

            $user->setPhones($request->get('phones', []));

            $permissions = Permission::setPermissions($user->id, $request->get('permissions'));

            $response = [
                'success' => true,
                'item' => $user->toArray(),
                'message' => 'cadastro editado com sucesso'
            ];
        } catch (\Exception $e){
            $response = [
                'success' => false,
                'message' =>  $e->getMessage()
            ];
        }
        return response()->json($response);

    }


    public function destroy(User $user)
    {
        $user->delete();
        return response()->json('success');
    }

    public function permissions(User $user)
    {
        return $user->permission->parse();
    }
}
