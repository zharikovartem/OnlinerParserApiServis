<?php

namespace App\Http\Controllers;

// use App\Account;
use App\User;
use Illuminate\Http\Request;

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
        // var_dump($user);
        // $columns = Schema::getColumnListing('User');

        // $fields = $request->all();
        // foreach ($fields as $field => $value) {
        //     if ($field !== 'user') {
        //         if (
        //             in_array( $field, $columns ) 
        //             // || $taskList[$field]===null 
        //             ) { 
        //             $taskList[$field] = $value;
        //         } else {
        //             $message[$field] = 'do not exist';
        //             $data[$field] = $value;
        //         }
        //         $requestData[$field] = $value;
        //     }
        // }


        // // $newTask['data'] = json_encode($data);


        // if (isset($taskList)) {
        //     $taskList->save();
            
        // }
        // if (isset($data)) {
        //     $taskList->data = json_encode($data);
        //     $taskList->save();
        // }

            return response()->json([
                'user'=>$user,
                'fields'=>$fields
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
