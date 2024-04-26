<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Deceased;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class DeceasedController extends Controller
{
    public function addDeceased(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'fullname' => 'required',
                'address' => 'required',
                'born' => 'required',
                'died' => 'required',
                'cemetery_location' => 'required',
                'tax_fullname' => 'required',
                'tax_contact' => 'required',
                'lapida' => 'image'
            ]);

            if ($validate->fails()) {
                throw new ValidationException($validate);
            }

            $lapidaImagePath = null;

            if ($request->hasFile('lapida')) {
                $lapidaImage = $request->file('lapida');
                $lapidaImagePath = $lapidaImage->store('LapidaImages', 'public');
            }

            $deceased = Deceased::create([
                'fullname' => $request->input('fullname'),
                'born' => $request->input('born'),
                'died' => $request->input('died'),
                'cemetery_location' => $request->input('cemetery_location'),
                'latitude' => $request->input('latitude'),
                'longitude' => $request->input('longitude'),
                'tax_fullname' => $request->input('tax_fullname'),
                'tax_contact' => $request->input('tax_contact'),
                'address' => $request->input('address'),
                'niche' => $request->input('niche'),
                'constructions' => $request->input('constructions'),
                'excavation' => $request->input('excavation'),
                'date_of_permit' => $request->input('date_of_permit'),
                'lapida_image' => $lapidaImagePath ? "storage/".$lapidaImagePath : "default_lapida.png", // Store the path to the lapida image in the database
            ]);

            return response()->json(['deceased' => $deceased], 201);
        } catch (\Exception $e) {
            \Log::error($e);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



    public function updateDeceased(Request $request, $id)
    {
    try{

        $validate = Validator::make($request->all(), [
            'fullname' => 'required',
            'born' => 'required',
            'died' => 'required',
            'cemetery_location' => 'required',
            'tax_fullname' => 'required',
            'tax_contact' => 'required',
        ]);

        if($validate->fails())
        {
            throw new ValidationException($validate);
        }
        $deceased = Deceased::findOrFail($id);

        $deceased->fullname = $request->input('fullname');
        $deceased->born = $request->input('born');
        $deceased->died = $request->input('died');
        $deceased->cemetery_location = $request->input('cemetery_location');
        $deceased->latitude = $request->input('latitude');
        $deceased->longitude = $request->input('longitude');
        $deceased->tax_fullname = $request->input('tax_fullname');
        $deceased->address = $request->input('address');
        $deceased->niche = $request->input('niche');
        $deceased->constructions = $request->input('constructions');
        $deceased->excavation = $request->input('excavation');
        $deceased->date_of_permit = $request->input('date_of_permit');

        $deceased->save();

        return response()->json(['success'], 200);

        }catch(\Exception $e){
            \Log::error($e);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function deleteDeceased($id){
        try{
            $deceased = Deceased::findOrFail($id);
            $deceased->delete();
            return response()->json(['success'], 200);
        }catch(\Exception $e){
            \Log::error($e);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function deletePayment($id){
        try{
            $payment = Payment::findOrFail($id);
            $payment->delete();
            return response()->json(['success'], 200);
        }catch(\Exception $e){
            \Log::error($e);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getAllDeceased()
    {
        try {
            $deceased = Deceased::all();

            return response()->json($deceased, 200);

        } catch (\Exception $e) {
            \Log::error($e);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function searchDeceased(Request $request)
    {
        try {
            $deceased = Deceased::where('fullname', '=', $request->input('fullname'))->get();;

            return response()->json($deceased, 200);

        } catch (\Exception $e) {
            \Log::error($e);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function addPayment(Request $request)
    {
        $date = Carbon::now()->addYears();
        try {
              $validate = Validator::make($request->all(), [
                'uid' => 'required',
                'datePaid' => 'required',
                'kind' => 'required',
                'permitNo' => 'required',
                'taxAmount' => 'required',
                'total' => 'required',
                'tax_due_date_no' => 'required',
                'or_no' => 'required',

            ]);

            if($validate->fails())
            {
                throw new ValidationException($validate);
            }

            $payments = Payment::create([
                'uid' => $request->input('uid'),
                'date_paid' => $request->input('datePaid'),
                'kind' => $request->input('kind'),
                'permit_no' => $request->input('permitNo'),
                'or_no' => $request->input('or_no'),
                'tax_amount' => $request->input('taxAmount'),
                'total' => $request->input('total'),
                'tax_due_date' => $date->toDateString(),
                'tax_due_date_no' => $request->input('tax_due_date_no'),
            ]);

            return response()->json(['result' => $payments], 201);

        } catch (\Exception $e) {
            \Log::error($e);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getPayments($id){
        try {
            $payment = Payment::where('uid', '=',$id)->get();

            return response()->json($payment, 200);

        } catch (\Exception $e) {
            \Log::error($e);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function updatePayments(Request $request, $id)
    {
    try{

        $validate = Validator::make($request->all(), [
            'datePaid' => 'required',
            'kind' => 'required',
            'permitNo' => 'required',
            'taxAmount' => 'required',
            'total' => 'required',
            'tax_due_date_no' => 'required',
            'or_no' => 'required',

        ]);

        if($validate->fails())
        {
            throw new ValidationException($validate);
        }
        $payments = Payment::findOrFail($id);

        $payments->date_paid = $request->input('datePaid');
        $payments->kind = $request->input('kind');
        $payments->permit_no = $request->input('permitNo');
        $payments->tax_amount = $request->input('taxAmount');
        $payments->total = $request->input('total');
        $payments->tax_due_date_no = $request->input('tax_due_date_no');
        $payments->or_no = $request->input('or_no');

        $payments->save();

        return response()->json(['success'], 200);

        }catch(\Exception $e){
            \Log::error($e);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


}
