<?php

namespace App\Http\Controllers;

// use App\Account;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->get("user");
        $usersList = User::get();
        foreach ($usersList as $key => $user) {
            $usersList[$key]->getToDoList();
        }
        return response()->json([
            "UsersList"=> $usersList,
            "User"=>$user
            ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(User $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(User $account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $fields = $request->all();

        $userTarget = User::where('id', $fields['id'])
            ->get();
        // var_dump($user);
        // $columns = Schema::getColumnListing('User');

        // $fields = $request->all();
        foreach ($fields as $field => $value) {
            if ($userTarget[0][$field] !== $value && $field !== 'user') {
                $userTarget[0][$field] = $value;
            }
        }
        $userTarget[0]->save();


        // // // $newTask['data'] = json_encode($data);


        // if (isset($user)) {
        //     $user->save();
            
        // }
        // if (isset($data)) {
        //     $user->data = json_encode($data);
        //     $user->save();
        // }

            return response()->json([
                'changedUserData'=>$userTarget[0],
                // 'fields'=>$fields,
                // 'userRequest'=>$user
            ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        //
    }
}
