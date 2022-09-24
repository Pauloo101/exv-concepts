<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VisaForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function getTier4ToTier2Applicants(Request $request)
    {
        try {
            $users = User::where('visa_type', 'TIER4-TO-TIER2')->with('visaForm')->get();
            return $users;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getDirectWorkVisaApplicants(Request $request)
    {
       try {
        $users = User::where('visa_type', 'DIRECT-WORK-VISA')->with('visaForm')->get();
        return $users;
       } catch (\Throwable $th) {
           throw $th;
       }
    }

    public function getSpecficApplicant(Request $request)
    {
        try {
            $userInfo = User::where('id', $request->applicant_id)->first();
            $visaForm = VisaForm::where('user_id', $request->applicant_id)->first();
            return ['userInfo' => $userInfo, 'visaForm' => $visaForm];
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function downloadApplicantFile(Request $request)
    {
        $visaType = User::where('id', $request->applicant_id)->first()->visa_type;
        Log::info($visaType);
        return Storage::download($visaType.'/'.$request->filename);
        // $pathtofile = '../storage/app/Eclass/' . $request->filename;
        // return Storage::download($pathtofile);
        // return response()->download($pathtofile);
    }
    public function setApplicateInterview(Request $request)
    {
        try {
            VisaForm::where('user_id', $request->applicant_id)->update([
                'interview' =>$request->interview
            ]);
            return True;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function addComments(Request $request){
        try {
            VisaForm::where('user_id', $request->applicant_id)->update([
                'comments' => $request->comment
            ]);
            return True;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function updateAccepted(Request $request)
    {
        try {
            visaForm::where('user_id', $request->applicant_id)->update([
                'accepted' => $request->accepted
            ]);
            return True;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
