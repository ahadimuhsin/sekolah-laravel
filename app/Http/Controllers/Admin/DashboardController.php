<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $post_count = Post::count();
        $event_count = Event::count();
        $tag_count = Tag::count();
        $user_count = User::count();
        return view('admin.dashboard.index', compact('post_count',
        'event_count', 'tag_count', 'user_count'));
    }
}
