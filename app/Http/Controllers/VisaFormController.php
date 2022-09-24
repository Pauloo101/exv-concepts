<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VisaForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class VisaFormController extends Controller
{
    const VISA_TYPE = ['TIER4-TO-TIER2'=>'TIER4-TO-TIER2', 'DIRECT-WORK-VISA'=>'DIRECT-WORK-VISA'];
    const FILEREQUIREMENTS = [
        'TIER4-TO-TIER2' => [
           'cv',
           'BRP',
            'Passport',
            'Dbs',
            'Qualifications-including-back-home',
            'Proof-of-address',
            'employment-reference',
            'character-reference',
            'IELTS/UK-Naric'
        ],
        'DIRECT-WORK-VISA' => [
            'TB-test',
            'Proof-of-English-Proficiency ',
            'Driving-permit',
            'International-passport',
            'University-transcript',
            'CV',
            'Birth-certificate',
            'BSc',
            'Care-Certificate-course-transcript',
            'Cover-Letter',
            'Letter-to-confirm-Mandatory-Care-Placement'
        ]
    ];

    public function saveForm(Request $request)
    {
        Log::info($request->mobile_number);
        Log::info($request->country_origin);
        Log::info($request->address);
        try {
            $applicationForm = VisaForm::updateOrCreate(
                ['user_id' => Auth::user()->id],
                [
                    'mobile_number'=>$request->mobile_number,
                    'country_origin' => $request->country_origin,
                    // 'accepted' => $request->accepted,
                    'address' => $request->address,
                ]
            );
            return True;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function updateVisaType(Request $request): bool
    {
        try {
            User::where('id',Auth::user()->id)->update(['visa_type' => $request->visa_type]);
            return True;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getVisaType(Request $request): ?string
    {
        try {
           $visaType = User::find(Auth::user()->id);
           return $visaType->visa_type;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getApplicationForm(Request $request):?VisaForm
    {
        try {
            return VisaForm::where('user_id', Auth::user()->id)->first();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function uploadFile(Request $request): bool
    {
        // Log::info($request->cv->path());
        //         // Log::info($request->cv)
        //         // return null;
        //         $fileName = Auth::user()->id.'-'.$request->file('cv')->getClientOriginalName();
        //         Storage::putFileAs('TIER4-TO-TIER2', $request->file('cv'), $fileName);
        //         return true;
        $userVisaType = User::find(Auth::user()->id)->visa_type;
        if($userVisaType === SELF::VISA_TYPE['TIER4-TO-TIER2']){
            return $this->filesForTier4toTier2($request);
        }else{
            return $this->filesForWorkVisa($request);
        }
    }

    public function filesForTier4toTier2(Request $request): bool
    {
        try {
            $userApplication = VisaForm::where('user_id', Auth::user()->id)->first();
            $current_files = $userApplication->files;
            if(!$current_files){
                $current_files = [];
            }
            for ($i=0; $i < count(SELF::FILEREQUIREMENTS['TIER4-TO-TIER2']); $i++) {
                if ($request->hasFile((SELF::FILEREQUIREMENTS['TIER4-TO-TIER2'][$i]))) {
                    $fileName = Auth::user()->id.'-'.$request->file(SELF::FILEREQUIREMENTS['TIER4-TO-TIER2'][$i])->getClientOriginalName();
                    Storage::putFileAs('TIER4-TO-TIER2', $request->file(SELF::FILEREQUIREMENTS['TIER4-TO-TIER2'][$i]), $fileName);
                    $current_files[SELF::FILEREQUIREMENTS['TIER4-TO-TIER2'][$i]] = ['title'=>SELF::FILEREQUIREMENTS['TIER4-TO-TIER2'][$i], 'path'=> $fileName];
                }
            }
            $userApplication->files = $current_files;
            $userApplication->save();
            return True;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function filesForWorkVisa(Request $request): bool
    {
        try {
                $userApplication = VisaForm::where('user_id', Auth::user()->id)->first();
                $current_files = $userApplication->files;
                if(!$current_files){
                    $current_files = [];
                }
                for ($i=0; $i < count(SELF::FILEREQUIREMENTS['DIRECT-WORK-VISA']); $i++) {
                    if ($request->hasFile(SELF::FILEREQUIREMENTS['DIRECT-WORK-VISA'][$i])) {
                        $fileName = Auth::user()->id.'-'.$request->file(SELF::FILEREQUIREMENTS['DIRECT-WORK-VISA'][$i])->getClientOriginalName();
                        Storage::putFileAs('DIRECT-WORK-VISA', $request->file(SELF::FILEREQUIREMENTS['DIRECT-WORK-VISA'][$i]), $fileName);
                        $current_files[SELF::FILEREQUIREMENTS['DIRECT-WORK-VISA'][$i]] = ['title'=>SELF::FILEREQUIREMENTS['DIRECT-WORK-VISA'][$i], 'path'=> $fileName];
                    }
                }
                $userApplication->files = $current_files;
                $userApplication->save();
                return True;
        } catch (\Throwable $th) {
            throw $th;
        }

    }
}
