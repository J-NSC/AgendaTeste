<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class ContactController extends Controller
{
    public function index(): Response
    {
        $contacts = auth()->user()
            ->contacts()
            ->orderBy('name')
            ->get();

        return Inertia::render('Contacts/Index', [
            'contacts' => $contacts
        ]);
    }

    public function store(StoreContactRequest $request)
    {
        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('contacts', 'public');
        }

        $phone = preg_replace('/\D/', '', (string) $request->input('phone'));

        DB::beginTransaction();
        try {
            $contact = Contact::create([
                'name'       => $request->name,
                'email'      => $request->email,
                'phone'      => $phone,
                'image_path' => $path,
            ]);

            auth()->user()->contacts()->attach($contact->id);

            DB::commit();
            session()->flash('success', 'Sucesso ao cadastrar contato');
            return redirect(request()->header('Referer'));

        } catch (\Throwable $exception) {
            report($exception);
            DB::rollBack();

            if ($path && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }

            session()->flash('danger', 'Erro ao cadastrar contatos');
            return redirect(request()->header('Referer'));
        }
    }


    public function update(StoreContactRequest $request, Contact $contact)
    {
        $owns = auth()->user()->contacts()->whereKey($contact->id)->exists();
        if (!$owns) {
            abort(403);
        }

        $phone = preg_replace('/\D/', '', (string) $request->input('phone'));
        $newPath = null;

        DB::beginTransaction();
        try {
            if ($request->hasFile('image')) {
                $newPath = $request->file('image')->store('contacts', 'public');
            }

            $data = [
                'name'  => $request->name,
                'phone' => $phone,
                'email' => $request->email,
            ];

            if ($newPath) {
                $data['image_path'] = $newPath;
            }

            $contact->update($data);

            DB::commit();
            session()->flash('success', 'Sucesso ao atualizar contato');
            return redirect(request()->header('Referer'));
        } catch (\Throwable $exception) {
            report($exception);
            DB::rollBack();

            if ($newPath && Storage::disk('public')->exists($newPath)) {
                Storage::disk('public')->delete($newPath);
            }

            session()->flash('danger', 'Erro ao atualizar contato');
            return redirect(request()->header('Referer'));
        }
    }

    public function destroy(Contact $contact)
    {
        $owns = auth()->user()->contacts()->whereKey($contact->id)->exists();

        if (!$owns) {
            abort(403);
        }

        DB::beginTransaction();
        try {
            auth()->user()->contacts()->detach($contact->id);

            if (!$contact->users()->exists()) {
                if ($contact->image_path && Storage::disk('public')->exists($contact->image_path)) {
                    Storage::disk('public')->delete($contact->image_path);
                }
                $contact->delete();
            }

            DB::commit();
            session()->flash('success', 'Sucesso ao excluir contato');
            return redirect(request()->header('Referer'));
        } catch (\Throwable $exception) {
            report($exception);
            DB::rollBack();
            session()->flash('danger', 'Erro ao excluir contato');
            return redirect(request()->header('Referer'));
        }
    }
}
