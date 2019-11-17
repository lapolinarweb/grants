<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Applicant;
use App\Models\Country;
use App\Models\Email;
use App\Models\Mobile;
use App\Models\Passport;
use App\Models\PublicKey;
use App\Models\Status;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ApplicantController extends Controller
{
    public function apply(Request $request) {
        // validate

        DB::beginTransaction();
        try {
            // find type
            $granType = Type::findOrFail($request->type);

            // create applicant with grant type
            $applicant = Applicant::create([
                'title' => $request->title,
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'type_id' => $granType->id
            ]);

            // create address
            Address::create([
                'street' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'zip' => $request->zip,
                'applicant_id' => $applicant->id
            ]);

            // create mobile
            Mobile::create([
                'number' => $request->mobile,
                'applicant_id' => $applicant->id
            ]);

            // create email
            Email::create([
                'address' => $request->email,
                'applicant_id' => $applicant->id
            ]);

            // create passport
            Passport::create([
                'code' => $request->passport,
                'applicant_id' => $applicant->id
            ]);

            // create public key
            PublicKey::create([
                'key' => $request->publicKey,
                'applicant_id' => $applicant->id
            ]);

            // create applicant-country
            $country = Country::firstOrCreate([
                'name' => $request->countryName,
                'code' => $request->countryCode,
                'symbol' => $request->countrySymbol,
                'flag' => $request->countryFlag
            ]);
            $applicant->originatesIn($country);

            // create applicant-status
            $status = Status::findOrFail('reviewing');
            $approver = User::findOrFail(1);
            $applicant->attachStatus($status, $approver, 'Created by System');

            DB::commit();
            return response()->json(['status'=> true, 'message'=> 'Successfully sent your application'], 200);

        }catch (\Exception $e) {

            DB::rollback();
            return response()->json(['status'=>false, 'message'=>'Something went wrong', 'system'=> $e->getMessage()],403);
        }




    }

    public function validateField(Request $request, $rule) {
        $table = $request->table;
        $column = $request->column;
        $value = $request->value;

        $data = ["$column" => "$value"];
        $rules = ["$column" => "$rule:$table"];
        $messages = ["$column.$rule" => "$value already exists"];
        $validator = Validator::make($data, $rules, $messages);;

        if($validator->fails())
            return response()->json([
                "valid" => false,
                "message"=>$validator->messages()->first()
            ],200);

        return response()->json(["valid" =>true], 200);
    }
}
