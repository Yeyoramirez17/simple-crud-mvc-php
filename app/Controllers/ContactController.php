<?php 
namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contact = new Contact();

        if (isset($_GET['search'])) {
            $contacts = $contact
                        ->where('name', 'LIKE' , '%' . $_GET['search'] . '%')
                        ->paginate(3);
        } else {
            $contacts = $contact->paginate( 5 );
        }
        
        return $this->view('contacts.index', compact('contacts') );
    }
    public function create() 
    {
        return $this->view('contacts.create');
    }
    public function store() 
    {
        $data = $_POST;

        $contact = new Contact;
        $contact->create( $data );

        return $this->redirect('/contacts');
    }
    public function show( $id ) 
    {
        $contact = new Contact;
        $contact = $contact->find($id);
        return $this->view('contacts.show', compact('contact'));
    }
    public function edit( $id ) 
    {
        $contact = new Contact;
        $contact = $contact->find($id);
        return $this->view('contacts.edit', compact('contact'));
    }
    public function update( $id ) 
    {
        $data = $_POST;
        $contact = new Contact;
        $contact->update($id, $data);

        $this->redirect("/contacts/{$id}");
    }
    public function destroy( $id ) 
    {
        $contact = new Contact;
        $contact->delete($id);

        $this->redirect("/contacts");
    }
}