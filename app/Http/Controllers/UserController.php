<?php

namespace App\Http\Controllers;

use App\Models\User,
    Validator,
    Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new user.
     *
     * @return void
     */
    public function create(Request $request)
    {
        $data = $request->only(['carnet', 'first_name', 'last_name', 'nick_name']);

        $firewall = Validator::make($data, [
            'carnet' => 'required|unique:users',
            'nick_name' => 'required|unique:users',
            'first_name' => 'required',
            'last_name' => 'required',
        ], 
        [   'required' => 'El campo :attribute es obligatorio',
            'carnet.unique' => 'El carnet ya se encuentra registrado',
            'nick_name.unique' => 'El apodo ya se encuentra registrado',
        ]);

        if(!$firewall->passes())
        {
            return response()->json([
                'status' => FALSE, 
                'report' => $firewall->messages()->first()
            ]);
        }

        $user = new User();
        $user->carnet = $data['carnet'];

        if($this->invalidString($data['first_name']))
        {
            return response()->json([
                'status' => FALSE, 
                'report' => 'Tu nombre no puede contener caracteres especiales'
            ]);
        }

        if($this->invalidString($data['last_name']))
        {
            return response()->json([
                'status' => FALSE, 
                'report' => 'Tu apellido no puede contener caracteres especiales'
            ]);
        }

        if($this->invalidString($data['nick_name']))
        {
            return response()->json([
                'status' => FALSE, 
                'report' => 'Tu nombre de usuario no puede contener caracteres especiales'
            ]);
        }
        
        $user->first_name = $this->cleanText($data['first_name']);
        $user->last_name  = $this->cleanText($data['last_name']);
        $user->nick_name  = $this->cleanText($data['nick_name']);

        $user->save();

        return response()->json(['status' => true]);
    }

    /**
     * Form to create a new user.
     *
     * @return void
     */
    public function form()
    {
        return view('create');
    }

    /**
     * Search for special chars
     *
     * @return boolean
     */
    private function invalidString($text)
    {
        return preg_match('/[^A-Za-z0-9üÀ-ÖØ-öø-ÿ]/', $text);
    }

    /**
     * Remove spaces
     *
     * @return void
     */
    private function cleanText($text)
    {
        return trim($text);
    }
}
