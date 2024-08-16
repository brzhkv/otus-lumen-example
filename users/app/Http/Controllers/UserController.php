<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUser(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'email']
        ]);

        return User::query()
            ->where('email', $request->get('email'))
            ->first() ?? abort(404, 'not found', ['Content-Type' => 'application/json']);
    }
}
