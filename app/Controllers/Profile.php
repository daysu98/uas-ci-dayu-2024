<?php

namespace App\Controllers;

use App\Models\UserModel;

class Profile extends BaseController
{
    public function edit()
    {
        $userId = session()->get('user_id');
        $userModel = new UserModel(); 
        $user = $userModel->find($userId); 

        if ($this->request->getMethod() == 'POST') {
           
            $validationRules = [
                'username' => 'required|min_length[3]|max_length[50]',
                'email' => 'required|valid_email',
                'profile_image' => 'mime_in[profile_image,image/jpg,image/jpeg,image/png]|max_size[profile_image,1024]',
                'password' => 'permit_empty|min_length[6]'
            ];

            if (!$this->validate($validationRules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $data = [
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email')
            ];

           
            $password = $this->request->getPost('password');
            if (!empty($password)) {
                $data['password'] = password_hash($password, PASSWORD_DEFAULT);
            }

           
            $file = $this->request->getFile('profile_image');
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move(ROOTPATH . 'public/uploads/profile_images', $newName);
                $data['profile_image'] = $newName;

                
                if ($user['profile_image']) {
                    $oldImagePath = ROOTPATH . 'public/uploads/profile_images/' . $user['profile_image'];
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath); 
                    }
                }
            }

            // Update data ke database
            $userModel->update($userId, $data);

            // Menampilkan pesan sukses
            session()->setFlashdata('success', 'Profil berhasil diperbarui!');
            return redirect()->to('profile/edit');
        }

        // Menampilkan halaman edit profil dengan data pengguna
        return view('profile/edit', ['user' => $user]);
    }
}
