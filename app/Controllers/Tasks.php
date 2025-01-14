<?php

namespace App\Controllers;

use App\Models\TaskModel;

class Tasks extends BaseController
{
    public function index()
    {
        $session = session();
        $taskModel = new TaskModel();

        // Mengambil tugas berdasarkan user ID
        $data['tasks'] = $taskModel->where('user_id', $session->get('user_id'))->findAll();
        return view('tasks/list', $data);
    }

    public function add()
    {
        if ($this->request->getMethod() === 'POST') {
            $taskModel = new TaskModel();

            // Menyimpan tugas baru
            $taskModel->save([
                'user_id' => session()->get('user_id'),
                'title' => $this->request->getPost('title'),
                'description' => $this->request->getPost('description'),
                'pomodoro_time' => $this->request->getPost('pomodoro_time') ?? 25,
            ]);

            return redirect()->to('/tasks')->with('success', 'Task berhasil ditambahkan.');
        }

        return view('tasks/add');
    }

    // Form Edit Tugas
    public function edit($id)
    {
        $taskModel = new TaskModel();

        // Ambil data tugas berdasarkan ID
        $task = $taskModel->find($id);

        if (!$task) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Tugas tidak ditemukan.');
        }

        // Pastikan tugas milik user yang sedang login
        if ($task['user_id'] !== session()->get('user_id')) {
            return redirect()->to('/tasks')->with('error', 'Anda tidak memiliki izin untuk mengedit tugas ini.');
        }

        // Kirim data tugas ke view
        $data['task'] = $task;
        return view('tasks/edit', $data);
    }

    // Proses Update Tugas
    public function update($id)
    {
        $taskModel = new TaskModel();

        // Validasi input
        if ($this->validate([
            'title' => 'required|min_length[3]|max_length[100]',
            'description' => 'required|min_length[5]|max_length[500]',
            'pomodoro_time' => 'required|integer|greater_than[0]'
        ])) {
            // Ambil tugas berdasarkan ID
            $task = $taskModel->find($id);

            if (!$task) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException('Tugas tidak ditemukan.');
            }

            // Pastikan tugas milik user yang sedang login
            if ($task['user_id'] !== session()->get('user_id')) {
                return redirect()->to('/tasks')->with('error', 'Anda tidak memiliki izin untuk mengupdate tugas ini.');
            }

            // Data yang diperbarui
            $data = [
                'title' => $this->request->getPost('title'),
                'description' => $this->request->getPost('description'),
                'pomodoro_time' => $this->request->getPost('pomodoro_time'),
            ];

            // Update data tugas
            $taskModel->update($id, $data);

            return redirect()->to('/tasks')->with('success', 'Tugas berhasil diperbarui.');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    }

    public function delete($id)
    {
        $taskModel = new TaskModel();
        $task = $taskModel->find($id);

        // Hanya user yang memiliki tugas yang bisa menghapus
        if ($task && $task['user_id'] === session()->get('user_id')) {
            $taskModel->delete($id);
            return redirect()->to('/tasks')->with('success', 'Task berhasil dihapus.');
        }

        return redirect()->to('/tasks')->with('error', 'Task tidak ditemukan.');
    }
}
