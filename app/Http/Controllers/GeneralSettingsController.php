<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyInfo;

class GeneralSettingsController extends Controller
{
    //
    public function showSettings()
    {
        $id = 1;
        $company = CompanyInfo::find($id);
        return view('Settings.generalsetting', compact('company'));
    }

    public function SaveCompanyInfo(Request $request) {
        $id = 1;
        $company = CompanyInfo::find($id);

        $company->company_name = $request->input('name');
        $company->mobile = $request->input('mobile');
        $company->phone = $request->input('telephone');
        $company->email = $request->input('email');
        $company->website = $request->input('website');
        $company->address = $request->input('address');
        $company->city = $request->input('city');
        $company->country = $request->input('country');
        
        $company->update();

        $file = $request->file('companyLogo');
        if ($file) {
            // echo $file->getClientOriginalName();
            $destionationPath = 'assets/images/';
            $file->move($destionationPath, 'logo-icon4.png');
        }
        
        return redirect()->back();
    }
}
