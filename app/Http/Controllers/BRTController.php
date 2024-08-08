<?php

namespace App\Http\Controllers;

use App\Models\BRT;
use App\Events\BRTCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BRTController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function store(Request $request)
    {
        $request->validate([
            'brt_code' => 'required|string|unique:brts',
            'reserved_amount' => 'required|numeric',
            'status' => 'required|string',
        ]);

        $brt = BRT::create([
            'user_id' => Auth::id(),
            'brt_code' => $request->brt_code,
            'reserved_amount' => $request->reserved_amount,
            'status' => $request->status,
        ]);
        // Dispatch the event
        event(new BRTCreated($brt));
        return response()->json($brt, 201);
    }

    public function index()
    {
        return response()->json(Auth::user()->brts);
    }

    public function show($id)
    {
        $brt = BRT::findOrFail($id);
        return response()->json($brt);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'brt_code' => 'string|unique:brts,brt_code,' . $id,
            'reserved_amount' => 'numeric',
            'status' => 'string',
        ]);

        $brt = BRT::findOrFail($id);
        $brt->update($request->all());

        return response()->json($brt);
    }

    public function destroy($id)
    {
        $brt = BRT::findOrFail($id);
        $brt->delete();

        return response()->json(null, 204);
    }
}