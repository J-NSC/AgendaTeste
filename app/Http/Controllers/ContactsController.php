<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contacts;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
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
        $user = Auth::user();
        $contacts = $user->contacts;
        return Inertia::render('Dashboard',[
            'contacts' => $contacts,
        ]);
    }

    public function create():Response{
        $user = Auth::user();
        return Inertia::render('Contact/Create');
    }

    public function store(ContactRequest $request): RedirectResponse
    {
        $contact = $request->validated();
        $contact['user_id'] = auth()->id();

        if ($request->hasFile('image')) {
            $uploadedFileUrl = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
            $contact['image_path'] = $uploadedFileUrl;
        }

        DB::beginTransaction();
        try {
            Contacts::create($contact);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }

        return Redirect::route('dashboard');
    }

    public function edit($id):Response
    {
        $contact = Contacts::findOrFail($id);
        return Inertia::render('Contact/Edit',[
            'contact' => $contact,
        ]);
    }

    public function update(ContactRequest $request, $id): RedirectResponse {
        $contactData = $request->validated();

        if ($request->hasFile('image')) {
            $uploadedFileUrl = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
            $contactData['image_path'] = $uploadedFileUrl;

        }

        DB::beginTransaction();
        try {
            $contact = Contacts::findOrFail($id);
            $contact->update($contactData);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }

        return Redirect::route('dashboard');
    }
    public function destroy($id): RedirectResponse
    {
        $contact = Contacts::findOrFail($id);

        DB::beginTransaction();
        try {
            $contact->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }

        return redirect()->route('dashboard');
    }

}
