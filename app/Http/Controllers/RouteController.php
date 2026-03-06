<?php

namespace App\Http\Controllers;

use App\Models\Route;
use App\Services\OpenRouteService;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $routes = Route::with('truck')->get(["id", "stops", "departure", "date", "duration", "truck_id"]);

        foreach ($routes as $route) {
            $route->duration = gmdate("H:i:s", $route->duration);  
            $route->truck_name = $route->truck->name;
            unset($route["truck"]);
            unset($route["truck_id"]);
        }

        return view("routes.index", ["routes" => $routes->toArray()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $route = new Route;

        $route->fill([
            'stops' => $request->get('stops'),
            'departure' => $request->get('departure'),
            'date' => $request->get('date'),
            'duration' => $request->get('duration'),
            'truck_id' => $request->get('truck_id')
        ]);

        try {
            $route->save();
        } catch (\Throwable $th) {
            return response("Something went wrong!", 500);
        }

        return response("Route saved");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Route::destroy($id);

        return redirect()->back();
    }

    public function planRoute(Request $request)
    {
        $ors = new OpenRouteService;

        $request->validate([
            'stops' => 'required|array', // Need at least start and end
            'stops.*' => 'string'
        ]);

        try {
            $geoJsonRoute = $ors->getDirections($request->stops);
            return response()->json($geoJsonRoute);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }
    
}
