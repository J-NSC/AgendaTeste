<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contacts;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ContactsController extends Controller
{
    public function index(): Response{
//        $user = Auth::user();
        $contacts = Contacts::all();
        return Inertia::render('Dashboard',[
            'contacts' => $contacts,
        ]);
    }

    public function create():Response{
        $user = Auth::user();
        return Inertia::render('Contact/Create');
    }

    public function store(ContactRequest $request):RedirectResponse{
//        $contact = $request->validated();
////        $contact['user_id'] = auth()->id();
//        DB::beginTransaction();
//        try {
//            Contacts::create($contact);
//            DB::commit();
//        }catch (Exception $e){
//            DB::rollBack();
//            dd($e);
//        }
        return Redirect::route('dashboard');
    }
}
