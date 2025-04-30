<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleRequest;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $selected_type = $request->type;
        $selected_order = $request->order ?? 'DESC';
        $search_value = $request->search;
        $success = session('success');

        $query = Vehicle::query();

        if ($search_value || $selected_type || $selected_order)
        {
            $query->when($search_value, fn($q) => $q->where('plate_no', 'LIKE', '%' . $search_value . '%'))
                ->when($selected_type, fn($q) => $q->where('type', $selected_type))
                ->where('user_id', $user->id)
                ->orderBy('created_at', $selected_order);
        } else
        {
            $query->orderBy('created_at', 'DESC');
        }

        $vehicles = $query->paginate(12);

        return inertia('Dashboard', [
            'vehicles' => $vehicles,
            'success' => $success,
            'selected_type' => $selected_type,
            'selected_order' => $selected_order,
            'search_value' => $search_value,
            'user' => $user->toArray(),
        ]);
    }

    public function create(VehicleRequest $request)
    {
        $vehicle = Vehicle::create([
            'plate_no' => $request->plate_no,
            'type' => $request->type,
            'user_id' => Auth::id(),
        ]);

        return $vehicle
            ? redirect()->back()->with('success', 'Vehicle recorded successfully!')
            : back()->withErrors(['error' => 'Vehicle submission failed']);
    }
}
