<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::orderby('name')->get();
       
        $data = [
            'title' => 'Contacts',
            'contacts' => $contacts
        ];

        return view('contact.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $data = [
        //     'title' => 'Add Contact',
        // ];

        // return view('contact.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function sendMessage(Request $request)
{
    // Validasi data dari form
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'contact' => 'required|string|max:255',
        'subject' => 'nullable|string|max:255',
        'message' => 'required|string',
    ]);

    try {
        // Simpan data ke dalam database admin
        $contact = new Contact();
        $contact->name = $validatedData['name'];
        $contact->contact = $validatedData['contact'];
        $contact->subject = $validatedData['subject'];
        $contact->message = $validatedData['message'];
        $contact->save();

        // Redirect kembali ke halaman home dengan pesan sukses
        return Redirect::route('home')->with('success', 'Message sent successfully!');
    } catch (\Throwable $th) {
        // Jika terjadi kesalahan, tampilkan pesan error dan redirect ke halaman contact
        return redirect('/contact')->with('error', $th->getMessage());
    }
}
    public function edit(string $id)
    {
        // $contact = Contact::find($id);
        // if(!$contact){
            
        //     return redirect('contact')->with("errorMessage", 'Contact tidak dapat ditemukan');
        // }
        // $data = [
        //     'title' => 'Edit Contact',
        //     'contact' => $contact
        // ];

        // return view('contact.form', $data);
    }
    
    public function update(Request $request, string $id)
    {
        // $messages = [
        //     'title.required' => 'Silakan isi nama.',
        //     'description.required' => 'Silakan isi deskripsi.',
        // ]; 
    
        // $data = $request->validate([
        //     'title' => 'required|string|max:255',
        //     'description' => 'required|string',
        //     'image' => 'required|mimes:jpg,png,jpeg|max:1024',            
        // ], $messages);

    
        // try {
        //     $data['user_id'] = auth()->user()->id;
        //     if($request->hasFile('image')) {
        //         $data['image'] = $request->file("image")->store('img');
        //     } else {
        //         $data['image'] = null;
        //     }

        //     $contact = Contact::findOrFail($id);
        //     $contact->update($data);

        //     Alert::success('Sukses', 'Data berhasil diperbarui.');
        //     return redirect('contact');
        // } catch (\Throwable $th) {
        //     Alert::error('Error', $th->getMessage());
        //     return redirect('contact');
        // }
    }

    public function show(string $id)
    {
        $contact = Contact::find($id);
        $data = [
            "title" => "Contact Detail",
            "contact" => $contact
        ];
        return view('contact.detail', $data);
    }

    public function destroy(string $id)
    {
        try {
            $contact = Contact::findOrFail($id);
            $contact->delete(); // menggunakan soft delete

            return redirect('contact')->with("successMessage", "Data berhasil dihapus!");
        } catch (\Throwable $th) {
            return redirect('contact')->with("errorMessage", "Data gagal dihapus!");
        }
    }
}
