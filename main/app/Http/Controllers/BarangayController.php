<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Purok;
use App\Events\Userlog;
use App\Models\Barangay;
use App\Models\Resident;
use App\Models\Household;
use Illuminate\Http\Request;
use App\Models\BarangayOfficial;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class BarangayController extends Controller
{
    public function index()
    {
        // Get the currently authenticated user
        $user = Auth::user();
        
        // the user model has a `barangay_id` property
        $barangayId = $user->barangay_id;
    
        // Fetch data for the user's barangay
        $totalResidents = Resident::where('barangay_id', $barangayId)->count();
        $marriedCount = Resident::where('barangay_id', $barangayId)
                                ->where('civil_status', 'Married')
                                ->count();
        $seniorCitizensCount = Resident::where('barangay_id', $barangayId)
                                        ->whereDate('birth_date', '<=', now()->subYears(60))
                                        ->count();
        $youthCount = Resident::where('barangay_id', $barangayId)
                               ->whereDate('birth_date', '>', now()->subYears(18))
                               ->count();

        $barangayOfficials = BarangayOfficial::where('barangay_id', $barangayId)
                               ->with('resident') 
                               ->get();

        $puroks = Purok::where('barangay_id', $barangayId)->get();

        return view('barangay.dashboard', compact('totalResidents', 'marriedCount', 'seniorCitizensCount', 'youthCount', 'barangayOfficials', 'puroks'));
    }
    
    public function createUserForm()
    {
        $userBarangayId = Auth::user()->barangay_id;
    
        // Fetch households that belong to the user's barangay
        $households = Household::whereHas('user', function ($query) use ($userBarangayId) {
            $query->where('barangay_id', $userBarangayId);
        })->get();

        $puroks = Purok::where('barangay_id', $userBarangayId)->get();

    
        // Fetch users in the same barangay
        $users = User::where('barangay_id', $userBarangayId)->get();
    
        return view('barangay.crud.create_user_account', compact('households', 'users', 'puroks'));
    }
    

    public function showLoginPage($barangay_name)
    {
        // Retrieve the barangay by name
        $barangay = Barangay::where('barangay_name', $barangay_name)->firstOrFail();
    
        // Pass the barangay data to the view
        return view('login.barangay-login', compact('barangay'));
    }
    

    public function storeUser(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'purok' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'place_of_birth' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:255',
            'civil_status' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:255',
            'citizenship' => 'nullable|string|max:255',
            'nickname' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255|unique:residents,email',
            'current_address' => 'nullable|string|max:255',
            'permanent_address' => 'nullable|string|max:255',
            'household' => 'required',
            'new_household_name' => 'nullable|string|max:255',
            'user_id' => 'nullable|exists:users,id',
        ]);
    
        // Get the currently logged-in user's barangay
        $userBarangayId = Auth::user()->barangay_id;
    
        // Create a new resident and associate it with the user's barangay
        $resident = new Resident($validatedData);
        $resident->barangay_id = $userBarangayId;
        $resident->purok_id = $request->purok;
        $resident->save();
    
        // Check if a new household is being created
        if ($request->household === 'new') {
            // Create the new household
            $household = Household::create([
                'household_name' => $request->new_household_name,
                'resident_id' => $resident->id,
                'user_id' => $request->user_id,  // Associate with the selected user from the dropdown
            ]);
        } else {
            // Associate resident with an existing household
            $household = Household::find($request->household);
            if ($household) {
                $household->update([
                    'resident_id' => $resident->id,
                ]);
            }
        }
    
        // Log the event
        $log_entry = 'Admin Added a new resident ' . $resident->first_name . ' with the ID of ' . $resident->id;
        event(new UserLog($log_entry));
    
        // Redirect back with success message
        return back()->with('success', 'Resident and household information added successfully!');
    }

    public function viewResident($resident_id)
    {

        $resident = Resident::where('id', $resident_id)
                            ->where('barangay_id', Auth::user()->barangay_id)
                            ->firstOrFail();

        // Calculate the age of the resident
        $birthDate = Carbon::parse($resident->birth_date);
        $currentYear = now()->year;

        if ($birthDate->year === $currentYear) {
            $resident->age = 0;
        } else {
            $resident->age = $birthDate->age;
        }

        $households = Household::where('resident_id', $resident_id)
        ->select('household_name')
        ->get();

        $householdNames = $households->pluck('household_name')->toArray();

        return view('barangay.crud.view_resident', compact('resident', 'householdNames'));
    }

    public function editResident($resident_id)
    {
        // Find the resident by ID and ensure it belongs to the user's barangay
        $resident = Resident::where('id', $resident_id)
                            ->where('barangay_id', Auth::user()->barangay_id)
                            ->firstOrFail();

        $puroks = Purok::where('barangay_id', Auth::user()->barangay_id)->get();

        return view('barangay.crud.edit_resident', compact('resident', 'puroks'));
    }

    public function updateResident(Request $request, $resident_id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'purok' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'place_of_birth' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:255',
            'civil_status' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:255',
            'citizenship' => 'nullable|string|max:255',
            'nickname' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255|unique:residents,email,' . $resident_id,
            'current_address' => 'nullable|string|max:255',
            'permanent_address' => 'nullable|string|max:255',
        ]);

        // Find the resident and ensure it belongs to the user's barangay
        $resident = Resident::where('id', $resident_id)
                            ->where('barangay_id', Auth::user()->barangay_id)
                            ->firstOrFail();

        $resident->purok_id = $request->purok;
        $resident->save();
        
        // Update resident data
        $resident->update($validatedData);

        $log_entry = 'Admin made changes to resident ' . $resident->first_name . ' with an ID of ' . $resident->id;
        event(new UserLog($log_entry));

            return redirect()->route('barangay.residents.index')->with('success', 'Resident updated successfully.');
    }

    public function deleteResident(Request $request)
    {
            // Find the resident by ID and ensure they belong to the user's barangay
            $resident = Resident::where('id', $request->resident_id)
                                ->where('barangay_id', Auth::user()->barangay_id)
                                ->firstOrFail();

            // Delete the resident
            $resident->delete();

            $log_entry = 'Admin Deleted ' . $resident->first_name . ' a resident with an ID of ' . $resident->id;
        event(new UserLog($log_entry));

            return redirect()->route('barangay.residents.index')->with('success', 'Resident deleted successfully.');
    }

    public function residentUser(Request $request)
    {

        $search = $request->input('search');


        $users = User::where('barangay_id', Auth::user()->barangay_id)
        ->when($search, function ($query) use ($search) {
            return $query->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        })
        ->role('user') 
        ->orderBy('name')
        ->get();

        return view('barangay.user.index', compact('users', 'search'));

    }

    public function createResidentUserForm() {
        return view('barangay.user.createUser');
    }

    public function storeResidentUser(Request $request)
    {
            // Validate the input fields
            $request->validate([
                'name' => 'required|string|max:255|unique:users',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);
        
            // Get the logged-in barangay ID
            $barangay_id = auth()->user()->barangay_id;
        
            // Create a new Resident User
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'barangay_id' => $barangay_id,
                'email_verified_at' => now(),
                'password' => Hash::make($request->password),
            ]);
        
            // Assign 'user' role to the newly created user (for residents)
            $user->assignRole('user');

            
            $log_entry = 'Admin Created a new user ' . $user->name . ' with an ID of ' . $user->id;
        event(new UserLog($log_entry));
        
            // Redirect back with success message
            return redirect()->back()->with('success', 'User has been created successfully.');
    }

    public function editUser(User $user)
    {
        return view('barangay.user.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_at' => now(),
        ]);
        
        $log_entry = 'Admin Updated a user named ' . $user->name . ' with an ID of ' . $user->id;
        event(new UserLog($log_entry));

        return redirect()->route('barangay.user.index')->with('success', 'User updated successfully.');
    }
}

