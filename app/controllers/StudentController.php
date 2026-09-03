<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentController extends Controller
{
    public function index()
    {
        $data['title'] = 'Princess Winlyn Student Information System';

        $this->call->view('student_home', $data);
    }

    public function profile()
    {
        $student = [
            'student_id' => 'MCC2024-00261',
            'name' => 'Princess Winlyn M. Yu',
            'course' => 'BS Information Technology',
            'year' => '3rd Year',
            'section' => '3F6',
            'address' => 'Mulawin, Naujan, Oriental Mindoro',
            'skills' => 'Cooking'
        ];

        $this->call->view('student_profile', $student);
    }
}