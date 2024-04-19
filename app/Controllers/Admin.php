<?php

namespace App\Controllers;

use App\Models\Users;
use App\Models\ReservationModel;


class Admin extends BaseController
{
    public function index()
    {
        $reservationModel = new \App\Models\ReservationModel();
        $data['reservations'] = $reservationModel->getReservationsWithDetails();
        
        return view('admin/dashboard', $data);
    }

    public function dashboard()
    {
        $allowedEmail = 'admin77420@gmail.com';
        $loggedInUserEmail = session()->get('admin')['email'] ?? null;

        if ($loggedInUserEmail !== $allowedEmail) {
            return redirect()->to('/')->with('error', 'Accès non autorisé.');
        }
        return view('admin/dashboard');
    }

    public function confirmReservation($id)
    {
        $model = new ReservationModel();
        $model->update($id, ['status' => 'confirmed']);
        return redirect()->to('/admin/dashboard');
    }

    public function cancelReservation($id)
    {
        $model = new ReservationModel();
        $model->update($id, ['status' => 'cancelled']);
        return redirect()->to('/admin/dashboard');
    }

    public function showUsers()
    {
        $model = new Users();
        $data['users'] = $model->findAll();
        return view('admin/users', $data);
    }
}