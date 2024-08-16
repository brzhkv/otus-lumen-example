<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function createOrder(Request $request)
    {
        $data = $this->validate($request, [
            'email' => ['required', 'email'],
            'amount' => ['required', 'numeric'],
        ]);

        $response = Http::get('http://host.docker.internal:8000/user?email=' . $data['email']);

        $decoded = json_decode($response->getBody()->getContents(), true);

        $order = \App\Models\Order::query()->create([
            'user_id' => $decoded['id'],
            'amount' => $data['amount'],
        ]);

        return [
            'order_id' => $order->id,
            'user_email' => $data['email'],
            'amount' => $order->amount,
        ];
    }
}
