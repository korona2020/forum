<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    //
    public function notifications()
    {

        //mark all notifications as read
        auth()->user()->unreadNotifications->markAsRead();

        //display all notifications
        return view('users.notifications')->with('notifications',auth()->user()->notifications()->paginate(3));
    }
}
