<?php

namespace App\Http\Controllers;


use Illuminate\View\View;

class ConfirmationController extends Controller
{
    public function index(): View
    {
        if (!session()->has('success')) {
            redirect('home');
        }
        return view('thankyou');
    }

}
