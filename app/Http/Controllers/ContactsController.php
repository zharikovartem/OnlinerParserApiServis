<?php

namespace App\Http\Controllers;

use App\Contacts;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    //...
    /**
     * Descriptions
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $contacts = Contacts::get();
        return response()->json([
            "contacts" => $contacts,
        ], 200);
    }
    /**
     * Descriptions
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Contacts $contacts
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Contacts $contacts)
    {

        $newItem = new Contacts($request->all());
        $newItem->save();
        return $this->index($request);
    }
    /**
     * Descriptions
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Contacts $contacts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contacts $contacts)
    {

        foreach ($request->all() as $field => $value) {
            $contacts[$field] = $value;
        }
        $contacts->save();
        return $this->index($request);
    }
    /**
     * Descriptions
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Contacts $contacts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Contacts $contacts)
    {

        $contacts->delete();
        return $this->index($request);
    }
}
