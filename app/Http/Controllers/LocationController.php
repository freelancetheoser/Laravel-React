<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Location;
use App\Models\Landmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use function Laravel\Prompts\search;

class LocationController extends Controller
{
    public function index(Request $request) {
        Log::info($request);
        if ($request->search) {
            $search = $this->createSearchJson($request->search);
            Log::info($search);
            return Inertia::render('Location', [
                'searchjson' => $search
            ]);
        }


        $location = $request->location != null
                    ? Location::where('name',$request->location)->first()
                    : Location::where('name','Bangkhen')->first();
        $landmarks = $location->landmarks;
        $features = [];
        foreach ($landmarks as $landmark) {
            $feature = [
                'location' => [
                    'name' => $location,
                    'coordinates' => [$location->latitude,$location->longtitude],
                    'latitude' => $location->latitude,
                    'longtitude' => $location->longtitude,
                ],
                'properties' => [
                    'name' => $landmark->name,
                    'imageurl' => $landmark->image_url,
                ],
                'geometry' => [
                    'type' => 'Landmark',
                    'coordinates' => [$landmark->longtitude, $landmark->latitude],
                    'url' => $landmark->location
                ]
            ];
            $features[] = $feature;
        }

        $geojson = [
            'location' => $location,
            'features' => $features
        ];
        return Inertia::render('Location', [
            'geojson' => $geojson
        ]);
    }



    public function store(Request $request){
        $request->validate([
            'name' => 'required|string',
            'thai_name' => 'required|string',
        ]);

        $location = new Location();
        $location->name = $request->name;
        $location->thai_name = $request->thai_name;
        $location->latitude = $request->latitude;
        $location->longtitude = $request->longtitude;
        $location->save();
    }

    private function createSearchJson($search){
        $landmarks = Landmark::where('name', 'like', '%'.$search.'%')
                        ->orWhere('thai_name', 'like', '%'.$search.'%')
                        ->get();

        $features = [];
        foreach ($landmarks as $landmark) {
            $feature = [
                'location' => [
                    'name' => $landmark->location->name,
                ],
                'properties' => [
                    'name' => $landmark->name,
                    'thai_name' => $landmark->thai_name,
                    'imageurl' => $landmark->image_url,
                ],
                'geometry' => [
                    'type' => 'Landmark',
                    'url' => $landmark->location
                ]
            ];
            $features[] = $feature;
        }

        $searchjson = [
            'features' => $features
        ];

        return $searchjson;
    }
}
