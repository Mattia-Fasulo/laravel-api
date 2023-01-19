<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\NewContact;
use Illuminate\Http\Request;
use App\Models\Lead;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    public function store(Request $request){

        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }
        else {
            $new_lead = new Lead();
            $new_lead->fill($data);
            $new_lead->save();
            echo $new_lead;

            $contact = new NewContact($new_lead);
            dd($contact);
            Mail::to('info@beanfolio')->send($contact);

            return response()->json([
                'success' => true

            ]);
        }

    }
}
