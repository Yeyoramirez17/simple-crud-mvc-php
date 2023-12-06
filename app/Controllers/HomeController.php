<?php

namespace App\Controllers;

use App\Models\Contact;

class HomeController extends Controller
{
    
    public function index()
    {
        $contactModel = new Contact();
        // $contactModel->delete(5);
        // return "Elimination";
        // return $contactModel->all();
        /* return $contactModel->update(6, [
            'name' => 'Duvan Pena',
            'email' => 'penaduv@example.com UPDATE',
            'phone' => '131-036-54'
        ]);*/
        // $contact = $contactModel->create([
        //     'name' => 'Jose Cebolla',
        //     'email' => 'jcebolla@example.com',
        //     'phone' => '000-000-00',
        // ]);
        // return $contact;
        return $this->view('home');
    }

}