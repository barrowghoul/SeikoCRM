<?php

namespace App\Http\Controllers;

use App\Mail\ProspectApprovedMailable;
use App\Mail\ProspectCreatedMailable;
use App\Mail\ProspectRejectedMailable;
use App\Models\BranchOffice;
use App\Models\Customer;
use App\Models\ProspectComment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class ProspectController extends Controller
{
    public function index(){
        //dd(Carbon::now()->subMinutes(10)->toDateTimeString());

        
        return view('prospects.index');
    }

    public function create(){
        return view('prospects.create');
    }

    public function store(Request $request){
    
        $request->validate([
            'name' => 'required|unique:customers',
            'address' => 'required',
            'contact' => 'required',
            'phone' => 'required|min:10',
            'mobile' => 'required|min:10',
            'email' => 'email:rfc'
        ]);
    
        $prospect = Customer::create([
            'name' => strtoupper($request->name),
            'contact' => strtoupper($request->contact),
            'address' => strtoupper($request->address),
            'phone' => $request->phone,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'status' => Customer::PROSPECT,
            'approval_status'  => Customer::ONTIME,
            'created_by' => Auth::user()->id,
            'started_at' => Carbon::now()->toDateTimeString()
        ]);

        $authorizers = User::select('email')->whereHas("roles", function($q){$q->where("name","Auxiliar Administrativo");})->get();
        $mail = new ProspectCreatedMailable($prospect);
        Mail::to($authorizers)->send($mail);

        return redirect()->route('prospects.index');
    }

    public function edit(Customer $prospect){
        $comments = ProspectComment::where('customer_id','=' , $prospect->id)->orderBy('created_at')->get();
        if($prospect->status < 4){
            return view('prospects.edit', compact('prospect','comments'));
        }else{
            $customer = BranchOffice::where('customer_id','=', $prospect->id)->firstOrFail();
            return view('prospects.edit', compact('prospect','customer'));
        }
        
    }

    public function reject(Request $request){
        $request->validate(['comments' => 'required']);

        
        $prospect = Customer::find($request->id);
        //$prospect->comments = $request->comment;
        //dd($prospect->comments);
        DB::transaction(function () use($request, $prospect) {
            ProspectComment::create([
                'customer_id' => $prospect->id,
                'user_id' => Auth::user()->id,
                'comments' => $request->comments
            ]);
            $prospect->status = Customer::REJECTED;
            $prospect->update();
        });
        
        $comments = $request->comments;
        $authorizers = User::select('email')->where("id", $prospect->created_by)->get();
        $mail = new ProspectRejectedMailable($prospect, $comments);
        Mail::to($authorizers)->send($mail);

        return view('prospects.index');

    }

    public function update(Request $request, Customer $prospect){
        $request->validate([
            'name' => 'required',
            'contact' => 'required',
            'email' => 'email:rfc'
        ]);
        $prospect->status = Customer::PROSPECT;
        $prospect->started_at = Carbon::now()->toDateTimeString();
        $prospect->update($request->all());

        return redirect()->route('prospects.index');
    }

    public function approve($id){
        $prospect = Customer::find($id);
        $prospect->status = 3;
        $prospect->save();

        $authorizers = User::select('email')->where("id", $prospect->created_by)->get();
        $mail = new ProspectApprovedMailable($prospect);
        Mail::to($authorizers)->send($mail);

        return view('prospects.index');
    }
}