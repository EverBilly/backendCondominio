<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;

use App\Http\Requests;
use App\Usuarios;
use App\Accesos;
use Response;
use Validator;
use Hash;
use Storage;
use Faker\Factory as Faker;

class UsuariosController extends Controller
{
    public function index()
    {
        
    }
}
