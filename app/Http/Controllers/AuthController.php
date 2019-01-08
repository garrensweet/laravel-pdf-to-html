<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function auth(Request $request)
    {
        // since we're just using csrf tokens for pattern matching there's no need to do any naive logic.

        return response(200);
    }
}
