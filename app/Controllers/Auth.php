<?php
namespace App\Controllers;
use App\Models\UserModel;

class Auth extends BaseController
{

    public function login()
    {
      
        if ($this->request->getMethod() === 'POST') {
            
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

           
            $userModel = new UserModel();

           
            $user = $userModel->where('username', $username)->first();

         
            if (password_verify($password, $user['password'])) {
          
                $session = session();
                $session->set([
                    'user_id' => $user['id'],
                    'username' => $user['username'],
                    'profile_image' => $user['profile_image'],
                    'is_logged_in' => true
                ]);

            
                return redirect()->to('tasks');
            }

          
            return view('auth/login', ['error' => 'Username atau password salah']);
        }

        return view('auth/login');
    }

    public function register()
    {

        if ($this->request->getMethod() == 'POST') {
            $userModel = new UserModel();

           
            $validationRules = [
                'username' => 'required|min_length[3]|max_length[50]',
                'email' => 'required|valid_email',
                'password' => 'required|min_length[6]',
                'profile_image' => 'uploaded[profile_image]|is_image[profile_image]|max_size[profile_image,1024]'
            ];

            
            if ($this->validate($validationRules)) {
                try {
                    
                    $hashedPassword = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);

                  
                    $image = $this->request->getFile('profile_image');
                    $imageName = null;

                    if ($image && $image->isValid() && !$image->hasMoved()) {
                        $imageName = $image->getRandomName();
                        $image->move(ROOTPATH . 'public/uploads', $imageName);
                    }

                    
                    $userModel->insert([
                        'username' => $this->request->getPost('username'),
                        'email' => $this->request->getPost('email'),
                        'password' => $hashedPassword,
                        'profile_image' => $imageName,
                    ]);

                   

                    if ($userModel) {
                        return redirect()->to('/login')->with('success', 'Registrasi berhasil! Silakan login.');
                    } else {
                     
                        return redirect()->back()->withInput()->with('errors', $userModel->errors());
                    }
                } catch (\Exception $e) {
                    
                    return redirect()->back()->withInput()->with('errors', [$e->getMessage()]);
                }
            } else {
              
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
        }
        return view('auth/register');
    }



    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}