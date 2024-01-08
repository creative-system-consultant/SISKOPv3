<?php

namespace App\Http\Middleware;

use App\Models\CustEmployer;
use App\Models\Customer;
use App\Models\FmsAddress;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckProfileCompletion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $flagger = false;
        $user = User::find(auth()->user()->id);
        $FmsCust = Customer::where('client_id', $user->client_id)->where('identity_no', $user->icno)->first();

        if (!$user || is_null($FmsCust)) {
            $flagger = true;
            session()->flash('message', 'Please choose the respective Koop before viewing user profile');
            session()->flash('time', 10000);
            session()->flash('warning');
            session()->flash('title');
        } else {
            $Employer  = CustEmployer::where('client_id', $user->client_id)->where('cif_id', $FmsCust->id)->first();
            $FmsAddressCust = FmsAddress::where('client_id', $user->client_id)->where('cif_id', $FmsCust->id)->where('address_type_id', 2)->first();
            $FmsAddressEmployer = FmsAddress::where('client_id', $user->client_id)->where('cif_id', $FmsCust->id)->where('address_type_id', 3)->first();

            if (is_null($Employer) || is_null($FmsAddressCust) || is_null($FmsAddressEmployer)) {
                $flagger = true;
                session()->flash('message', 'User Profile Must be Completed before using this function');
                session()->flash('time', 10000);
                session()->flash('warning');
                session()->flash('title');
            }
        }



        if ($flagger == true) {
            return redirect()->route('dash.guest');
        }
        return $next($request);
    }
}
