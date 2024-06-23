<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Model\Notification;
use Auth;

use App\Model\ActivityBudgetRequest;
use App\Model\PurchaseRequest;
use App\Model\PurchaseOrder;
use App\Model\Lar;
use App\Model\TravelAdvanceRequest;
use App\Model\Ter;
use App\Model\Voucher;
use App\Model\Program;
use App\Model\Additional;

class IndexController extends Controller
{
    public function login(Request $request)
    {
        // $akun = User::select('email')->where('email', $request->username)->first();
        $akun = User::select('username')->where('username', $request->username)->first();
        if($akun == true)
        {
            if($akun->deleted_at != null)
            {
                return redirect()->back()->withNotif("Akun anda sudah dihapus");
            }
            if($akun->status == 'NON AKTIF')
            {
                return redirect()->back()->withNotif("Akun anda sudah tidak aktif");
            }
            if (Auth::attempt(['username' => $request->username, 'password' => $request->password]))
            {
                return redirect()->route('dashboard');
            } else {
                return redirect()->back()->withNotif("Password yang anda masukan salah");
            }
        }else{
            return redirect()->back()->withNotif("Username tidak terdaftar");
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function changePassword () {
        return view('pages.change-password');
    }

    public function saveChangePassword (Request $request) {

        $data = User::find(Auth::user()->id);

        if ($request->new_password != $request->renew_password) {
            return redirect()->back()->withDanger("Password baru tidak cocok!");
        }
        $data->password = Hash::make($request->new_password);
        $data->update();

        return redirect()->back()->withAlert('Password berhasil dirubah!');
    }


    public function readNotification (Request $req) {
        $data = Notification::whereId($req->id)->first();
        $link = $data->link;
        $data->forceDelete();
        return redirect(url('dashboard').'/'.$link);
    }

    public function readAllNotification (Request $req) {
        Notification::whereUserTo(Auth::user()->id)->forceDelete();
        
        return redirect()->back()->withNotif("Semua Notifikasi telah dihapus");
    }

    public function MappingApprovalModule () {
        // return new MappingApprovalModule;
    }

    public function dashboard() 
    {
        // $need_approval = $this->getNeedApproval();
        // $my_data = $this->getMyData();
        // $need_create = $this->getNeedCreate();
        // $my_program = $this->getMyProgram();

        // return view('pages.dashboard', compact('need_approval', 'my_data', 'need_create', 'my_program'));
        return view('pages.dashboard');
    }

    public function getNeedApproval() {
        $MM = $this->MappingApprovalModule();

        $mapping = $MM->mapping(); 

        $res = [];
        $ActivityBudgetRequest = ActivityBudgetRequest::whereIn('program_id', Auth::user()->assigned_program)->whereStatusApproval('REQUESTED')->get();
        foreach ($ActivityBudgetRequest as $key => $val) {
            $val->stage = $MM->initStage('ActivityBudgetRequest', $val->id);
            $val->need_my_approval = $val->stage ? (in_array(Auth::user()->role, $mapping['ActivityBudgetRequest'][$val->stage->stage - 1]['access']) ? true : false) : false;
        }
        $ActivityBudgetRequest = collect($ActivityBudgetRequest)->where('need_my_approval', true);

    
        $Lar = Lar::whereIn('program_id', Auth::user()->assigned_program)->whereStatusApproval('REQUESTED')->get();
        foreach ($Lar as $key => $val) {
            $val->stage = $MM->initStage('Lar', $val->id);
            $val->need_my_approval = $val->stage ? (in_array(Auth::user()->role, $mapping['Lar'][$val->stage->stage - 1]['access']) ? true : false) : false;
        }
        $Lar = collect($Lar)->where('need_my_approval', true);


        $PurchaseRequest = PurchaseRequest::whereIn('program_id', Auth::user()->assigned_program)->whereStatusApproval('REQUESTED')->get();
        foreach ($PurchaseRequest as $key => $val) {
            $val->stage = $MM->initStage('PurchaseRequest', $val->id);
            $val->need_my_approval = $val->stage ? (in_array(Auth::user()->role, $mapping['PurchaseRequest'][$val->stage->stage - 1]['access']) ? true : false) : false;
        }
        $PurchaseRequest = collect($PurchaseRequest)->where('need_my_approval', true);


        $PurchaseOrder = PurchaseOrder::whereIn('program_id', Auth::user()->assigned_program)->whereStatusApproval('REQUESTED')->get();
        foreach ($PurchaseOrder as $key => $val) {
            $val->stage = $MM->initStage('PurchaseOrder', $val->id);
            $val->need_my_approval = $val->stage ? (in_array(Auth::user()->role, $mapping['PurchaseOrder'][$val->stage->stage - 1]['access']) ? true : false) : false;
        }
        $PurchaseOrder = collect($PurchaseOrder)->where('need_my_approval', true);

        $TravelAdvanceRequest = TravelAdvanceRequest::whereIn('program_id', Auth::user()->assigned_program)->whereStatusApproval('REQUESTED')->get();
        foreach ($TravelAdvanceRequest as $key => $val) {
            $val->stage = $MM->initStage('TravelAdvanceRequest', $val->id);
            $val->need_my_approval = $val->stage ? (in_array(Auth::user()->role, $mapping['TravelAdvanceRequest'][$val->stage->stage - 1]['access']) ? true : false) : false;
        }
        $TravelAdvanceRequest = collect($TravelAdvanceRequest)->where('need_my_approval', true);

        $Ter = Ter::whereIn('program_id', Auth::user()->assigned_program)->whereStatusApproval('REQUESTED')->get();
        foreach ($Ter as $key => $val) {
            $val->stage = $MM->initStage('Ter', $val->id);
            $val->need_my_approval = $val->stage ? (in_array(Auth::user()->role, $mapping['Ter'][$val->stage->stage - 1]['access']) ? true : false) : false;
        }
        $Ter = collect($Ter)->where('need_my_approval', true);

        $Voucher = Voucher::whereIn('program_id', Auth::user()->assigned_program)->whereStatusApproval('REQUESTED')->get();
        foreach ($Voucher as $key => $val) {
            $val->stage = $MM->initStage('Voucher', $val->id);
            $val->need_my_approval = $val->stage ? (in_array(Auth::user()->role, $mapping['Voucher'][$val->stage->stage - 1]['access']) ? true : false) : false;
        }
        $Voucher = collect($Voucher)->where('need_my_approval', true);

        $res = [];
        $Additional = Additional::whereIn('program_id', Auth::user()->assigned_program)->whereStatusApproval('REQUESTED')->get();
        foreach ($Additional as $key => $val) {
            $val->stage = $MM->initStage('Additional', $val->id);
            $val->need_my_approval = $val->stage ? (in_array(Auth::user()->role, $mapping['Additional'][$val->stage->stage - 1]['access']) ? true : false) : false;
        }
        $Additional = collect($Additional)->where('need_my_approval', true);

        $res['ActivityBudgetRequest'] = count($ActivityBudgetRequest);
        $res['Lar'] = count($Lar);
        $res['PurchaseRequest'] = count($PurchaseRequest);
        $res['PurchaseOrder'] = count($PurchaseOrder);
        $res['TravelAdvanceRequest'] = count($TravelAdvanceRequest);
        $res['Ter'] = count($Ter);
        $res['Voucher'] = count($Voucher);
        $res['Additional'] = count($Additional);

        return $res;
    }

    public function getMyData() {
        $MM = $this->MappingApprovalModule();

        $mapping = $MM->mapping(); 

        $res = [];
        $ActivityBudgetRequest = ActivityBudgetRequest::where('created_by', Auth::user()->id)->where('status_approval', '!=','CANCELED')->get();     
        $Lar = Lar::where('created_by', Auth::user()->id)->where('status_approval', '!=','CANCELED')->get();
        $PurchaseRequest = PurchaseRequest::where('created_by', Auth::user()->id)->where('status_approval', '!=','CANCELED')->get();
        $PurchaseOrder = PurchaseOrder::where('created_by', Auth::user()->id)->where('status_approval', '!=','CANCELED')->get();
        $TravelAdvanceRequest = TravelAdvanceRequest::where('created_by', Auth::user()->id)->where('status_approval', '!=','CANCELED')->get();
        $Ter = Ter::where('created_by', Auth::user()->id)->where('status_approval', '!=','CANCELED')->get();
        $Voucher = Voucher::where('created_by', Auth::user()->id)->where('status_approval', '!=','CANCELED')->get();
        $Additional = Additional::where('created_by', Auth::user()->id)->where('status_approval', '!=','CANCELED')->get();

        $res['ActivityBudgetRequest'] = count($ActivityBudgetRequest);
        $res['Lar'] = count($Lar);
        $res['PurchaseRequest'] = count($PurchaseRequest);
        $res['PurchaseOrder'] = count($PurchaseOrder);
        $res['TravelAdvanceRequest'] = count($TravelAdvanceRequest);
        $res['Ter'] = count($Ter);
        $res['Voucher'] = count($Voucher);
        $res['Additional'] = count($Additional);

        $res['ActivityBudgetRequestApproved'] = collect($ActivityBudgetRequest)->where('status_approval','APPROVED')->count();
        $res['LarApproved'] = collect($Lar)->where('status_approval','APPROVED')->count();
        $res['PurchaseRequestApproved'] = collect($PurchaseRequest)->where('status_approval','APPROVED')->count();
        $res['PurchaseOrderApproved'] = collect($PurchaseOrder)->where('status_approval','APPROVED')->count();
        $res['TravelAdvanceRequestApproved'] = collect($TravelAdvanceRequest)->where('status_approval','APPROVED')->count();
        $res['TerApproved'] = collect($Ter)->where('status_approval','APPROVED')->count();
        $res['VoucherApproved'] = collect($Voucher)->where('status_approval','APPROVED')->count();
        $res['AdditionalApproved'] = collect($Additional)->where('status_approval','APPROVED')->count();

        return $res;
    }

    public function getNeedCreate() {
        $MM = $this->MappingApprovalModule();

        $res = [];
        $needLar = ActivityBudgetRequest::where('created_by', Auth::user()->id)->whereStatusApproval('APPROVED')->get();
        $needLar = collect($needLar)->where('has_lar', false);

        $needTer = TravelAdvanceRequest::where('created_by', Auth::user()->id)->whereStatusApproval('APPROVED')->get();
        $needTer = collect($needTer)->where('has_ter', false);

        $needPo = PurchaseRequest::whereIn('program_id', Auth::user()->assigned_program)->whereStatusApproval('APPROVED')->get();
        $needPo = collect($needPo)->where('has_po', false);

        // voucher
        $needVoucherActivityBudgetRequest = ActivityBudgetRequest::whereIn('program_id', Auth::user()->assigned_program)->whereStatusApproval('APPROVED')->get();
        $needVoucherActivityBudgetRequest = collect($needVoucherActivityBudgetRequest)->where('total_voucher', '=',0);

        $needVoucherTravelAdvanceRequest = TravelAdvanceRequest::whereIn('program_id', Auth::user()->assigned_program)->whereStatusApproval('APPROVED')->get();
        $needVoucherTravelAdvanceRequest = collect($needVoucherTravelAdvanceRequest)->where('total_voucher', '=',0);

        $needVoucherLar = Lar::whereIn('program_id', Auth::user()->assigned_program)->whereStatusApproval('APPROVED')->get();
        $needVoucherLar = collect($needVoucherLar)->where('done_voucher', false);

        $needVoucherPurchaseOrder = PurchaseOrder::whereIn('program_id', Auth::user()->assigned_program)->whereStatusApproval('APPROVED')->get();
        $needVoucherPurchaseOrder = collect($needVoucherPurchaseOrder)->where('done_voucher', false);

        $needVoucherTer = Ter::whereIn('program_id', Auth::user()->assigned_program)->whereStatusApproval('APPROVED')->get();
        $needVoucherTer = collect($needVoucherTer)->where('done_voucher', false);

        $needVoucherAdditional = Additional::whereIn('program_id', Auth::user()->assigned_program)->orWhereNull('program_id')->whereStatusApproval('APPROVED')->get();
        $needVoucherAdditional = collect($needVoucherAdditional)->where('done_voucher', false);

        $res['needLar'] = count($needLar);
        $res['needTer'] = count($needTer);
        $res['needPo'] = count($needPo);

        $res['needVoucherActivityBudgetRequest'] = count($needVoucherActivityBudgetRequest);
        $res['needVoucherTravelAdvanceRequest'] = count($needVoucherTravelAdvanceRequest);
        $res['needVoucherLar'] = count($needVoucherLar);
        $res['needVoucherPurchaseOrder'] = count($needVoucherPurchaseOrder);
        $res['needVoucherTer'] = count($needVoucherTer);
        $res['needVoucherAdditional'] = count($needVoucherAdditional);

        return $res;
    }

    public function getMyProgram () {
        return Program::whereIn('id', Auth::user()->assigned_program)->get();
    }
}
