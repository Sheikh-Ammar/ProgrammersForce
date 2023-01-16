<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // SHOW ALL CONTACT DATA
    public function index()
    {
        $contact = Contact::paginate(5);
        return response()->json([
            'contact' => $contact,
        ], 200);
    }

    // SHOW SPECIFIC CONTACT DATA ON THE BASE OF ID
    public function show($id)
    {
        $contact = Contact::find($id);
        if ($contact) {
            $contact->get();
            return response()->json([
                'contact' => $contact,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Given Id contact not found',
            ], 404);
        }
    }

    // ADD CONTACT
    public function store(ContactRequest $request)
    {
        $data = $request->validated();
        Contact::create($data);
        return response()->json([
            'message' => 'Category Added',
        ], 200);
    }

    // UPDATE CONTACT DATA
    public function update(ContactRequest $request, $id)
    {
        $data = $request->validated();
        $contact = Contact::find($id);
        if ($contact) {
            $contact->update($data);
            return response()->json([
                'message' => 'Contact Updated',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Given Id contact not found',
            ], 404);
        }
    }

    // DELETE CONTACT DATA
    public function destroy($id)
    {
        $contact = Contact::findorFail($id);
        $contact->delete();
        return response()->json([
            'message' => 'Contact Deleted',
        ], 200);
    }
}
