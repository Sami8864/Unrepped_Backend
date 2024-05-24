<?php

namespace App\Http\Controllers\api;

use Exception;
use GuzzleHttp\Client;
use App\Models\FlagType;
use App\Models\Headshots;

use App\Models\UserFlag;
use App\Models\ActorReel;
use App\Models\User;
use App\Models\ProfileProgress;
use Illuminate\Http\Request;
use App\Models\UserAttribute;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
class HeadshotsController extends Controller
{
    private $apiKey = "MBuWi0NaDY6tB3iL2pV_vrAZONEYwYB3", $apiSecret = "PIp1W3rw0VOeuIxNCVieeEh630nsqMne";
    public function upload($data)
    {

        $path = 'public/headshots/'; // Adjust the storage path
        $file = $data['image'];
        $fileUrl = $this->file($file, $path);

        $image = Headshots::create([
            'device_id' => $data['device_id'],
            'type_id' => $data['type_id'],
            'url' => $fileUrl, // Store the file path, not the URL
        ]);
    }
    public function showFeed(Request $request)
    {
        // Define the number of items per page
        $disabledUsers = User::where('status', 'disabled')->where('user_type', 'user')->pluck('profileprogess_id')->toArray();

        $perPage = $request->input('per_page', 30); // Default per page is 10

        // Fetch random headshots with pagination
        // $randomHeadshots = UserAttribute::inRandomOrder()->paginate($perPage);
        $randomHeadshots = UserAttribute::whereNotIn('user_attributes.id', function ($query) {
            $query->select('id')
                ->from('user_attributes')
                ->whereIn('attribute_type', [1]);
        })
            ->join('users', function ($join) {
                $join->on('users.profileprogess_id', '=', 'user_attributes.profile')
                    ->whereNotNull('users.profileprogess_id');
            }) // Join with the users table
            ->inRandomOrder()
            ->distinct('user_attributes.attribute_type')
            ->paginate($perPage);
        $shots = [];

        foreach ($randomHeadshots as $shot) {
            if (in_array($shot->profile, $disabledUsers)) {
                continue; // Skip this shot
            }
            $link = Headshots::where('id', $shot->headshot)->pluck('url')->first();
            $device_id = Headshots::where('id', $shot->headshot)->pluck('device_id')->first();
            $shots[] = [
                'headshot_id' => $shot->id,
                'headshot' => $link,
                'answer' => $shot->answer,
                'shares' => $shot->shares,
                'device_id' =>   $device_id,
                'actual_id' => $shot->headshot
            ];
        }
        $questionnaireReels= ActorReel::All();
        return response()->json([
            'code' => 200,
            'messages' => 'User Feed Fetched',
            'questionnaire' => $shots,
            'pagination' => [
                'total' => $randomHeadshots->total(),
                'per_page' => $randomHeadshots->perPage(),
                'current_page' => $randomHeadshots->currentPage(),
                'last_page' => $randomHeadshots->lastPage(),
                'from' => $randomHeadshots->firstItem(),
                'to' => $randomHeadshots->lastItem(),
            ],
        ], 200);
    }
    public function shareFeed(Request $request)
    {
        try {

            $data = $request->all();
            // return response()->json($data);
            $validator = Validator::make($data, [
                'feed_id' => 'required|exists:user_attributes,id',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->first(), 'code' => 422], 422);
            }
            $post = UserAttribute::findOrFail($request->feed_id);

            // Increment share count
            $post->shares += 1;
            $post->save();
            // Optionally log share event
            // Your logging logic here

            return response()->json(['message' => 'Post shared successfully', 'code' => 200], 200);
        } catch (\Exception $th) {
            return response()->json(['error' => $th->getMessage(), 'code' => 400], 400);
        }
    }
    public function getFlags()
    {
        $flag = FlagType::get();
        return response()->json([
            'code' => 200,
            'messages' => 'Flag type Fetched',
            'feed' => $flag
        ], 200);
    }


    public function uploadHeadshot(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 400,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 400);
        } else {
        }
    }

    public function location()
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://countriesnow.space/api/v0.1/countries',
            CURLOPT_RETURNTRANSFER => true,
        ));

        $response = curl_exec($curl);
        $data = json_decode($response, true);
        curl_close($curl);
        $organized_data = [];

        // Iterate over each country in the response
        foreach ($data['data'] as $country) {
            // Extract country name and cities
            $country_name = $country['iso2'];
            $cities = $country['cities'];

            // Iterate over each city in the country
            foreach ($cities as $city) {
                // Format city and country as 'city, country'
                $city_with_country = $city . ', ' . $country_name;
                // Add the formatted city to the organized data array
                $organized_data[] = $city_with_country;
            }
        }


        return response()->json([
            'code' => 200,
            'messages' => 'Locations Fetched',
            'data' => $organized_data
        ], 200);
    }


    public function likeHeadshot(Request $request){
        $data = $request->all();
        $validator = Validator::make($data, [
            'headshot_id' => 'exists:user_attributes,id',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => 'Validation failed',
                'error' => $validator->errors()->first(),
            ], 200);
        } else {
            $hs=UserAttribute::where('headshot',$request->headshot_id)->first();
            $hs->likes+=1;
            $hs->save();
        }
        return response()->json([
            'code' => 200,
            'messages' => 'Headshot Liked',
            'data' => $hs
        ], 200);
    }

    public function likeReel(Request $request){
        $data = $request->all();
        $validator = Validator::make($data, [
            'reel_id' => 'exists:actor_reels,id',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => 'Validation failed',
                'error' => $validator->errors()->first(),
            ], 200);
        } else {
            $hs=ActorReel::where('id',$request->reel_id)->first();
            $hs->likes+=1;
            $hs->save();
        }
        return response()->json([
            'code' => 200,
            'messages' => 'Reel Liked',
            'data' => $hs
        ], 200);
    }


}
