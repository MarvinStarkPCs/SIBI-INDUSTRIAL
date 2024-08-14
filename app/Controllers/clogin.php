<?php

namespace App\Controllers;

class Clogin extends BaseController
{
    public function index(): string
    {
        return view('login'); 
    }
    public function signin()
    {
        $userModel = new \App\Models\UserModel(); // Carga el UserModel
    
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
    
        if (!$email || !$password) {
            return redirect()->back()->with('error', 'Por favor, complete todos los campos.');
        }
    
        $user = $userModel->getUserByEmail($email);
    
        if ($user && password_verify($password, $user['password'])) {
            $session = session();
            $session->set('user_id', $user['id']);
            $session->set('logged_in', true);
    
            return redirect()->to('/dashboard');
        } else {
            return redirect()->back()->with('error', 'Correo o contraseña incorrectos.');
        }
    }
    
}
