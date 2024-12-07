@extends('barangay.templates.navigation-bar')

@section('title', 'Residents')

@section('content')
<div class="px-4">
    <div class="flex justify-end items-center mb-4">
        <form action="{{ route('residents.download-excel')}}" method="POST" target="__blank">
            @csrf
            <div>
                <button class="py-2 px-3 text-white bg-green-500 rounded-lg  hover:bg-green-600 shadow-lg transition">
                    <i class="fa-solid fa-file-export"></i> Export
                </button>
            </div>
        </form>
    </div>

     <!-- Search bar -->
     <div class="bg-white py-2 px-4 rounded-lg shadow-lg mb-4 max-h-[15vh] overflow-y-auto">
        <h1 class="text-xl font-bold text-blue-500 mb-3">LOOK FOR A RESIDENT:</h1>

        @if(session('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show" class="bg-green-500 text-white text-center py-2 px-4 rounded mb-2">
            {{ session('success') }}
        </div>
        @endif

        <form class="flex items-center justify-center" method="GET" action="{{ route('barangay.residents.index') }}">
            <input type="text" name="search" placeholder="Search a resident..." class="py-2 px-4 border border-gray-300 rounded-l-md focus:outline-none focus:ring-1 focus:ring-gray-500">
            <button type="submit" class="py-2 px-4 bg-gray-600 text-white rounded-r-md hover:bg-gray-600 transition"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>

     </div>
    
    <div class="bg-white py-2 px-4 rounded-lg shadow-lg">
        <div class="flex justify-between mb-4">
            <h1 class="text-xl font-bold text-blue-500 mb-3">LIST OF AVAILABLE RESIDENTS:</h1>
    
            <a href="{{ route('barangay.create-user') }}" class="py-2 px-2 font-semibold bg-blue-600 text-white rounded flex items-center space-x-2 hover:bg-blue-500 transition">
                <i class="fa-solid fa-plus"></i>
                <span>Add Resident</span>
            </a>
        </div>
        <div class="max-h-[43vh] overflow-y-auto">
            <table class="min-w-full bg-white border border-[2px] border-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-[12px] text-left">Last Name</th>
                        <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-[12px] text-left">First Name</th>
                        <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-[12px] text-left">Purok</th>
                        <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-[12px] text-left">Gender</th>
                        <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-[12px] text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($residents as $resident)
                        <tr class="hover:bg-gray-200 transition">
                            <td class="py-2 px-4 border-b border-gray-200">{{ $resident->last_name }}</td>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $resident->first_name }}</td>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $resident->purok->purok_number }}</td>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $resident->gender }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-sm font-medium space-x-2 text-center">
                                <a href="{{ route('barangay.residents.view', ['resident_id' => $resident->id]) }}" class="text-gray-700 py-1 px-2 md:px-3 rounded hover:text-gray-900"><i class="fa-solid fa-window-maximize"></i></a>

                                <button onclick="toggleEditModal('{{ $resident->id }}')" class="text-blue-600 py-1 px-2 sm:px-3 rounded hover:text-blue-800 text-sm sm:text-base">
                                    <i class="fa-solid fa-pen"></i>
                                </button>

                                <div id="edit-modal-{{ $resident->id }}" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-start z-20">
                                    <!-- Edit Form -->
                                    <div class="mt-[20px] mb-6 w-[700px] mx-auto bg-white p-6 rounded shadow">
                                
                                        <div class="flex justify-center items-center mb-4">
                                            <div class="flex justify-start items-center">
                                                <i class="fa-solid fa-diamond text-blue-600 text-[8px] mb-1 mr-5"></i>
                                            </div>
                                            <div class="flex justify-center items-center">
                                                <h1 class="text-xl font-bold text-blue-600 text-center mb-2">Edit Resident Information</h1>
                                            </div>
                                            <div class="flex justify-start items-center">
                                                <i class="fa-solid fa-diamond text-blue-600 text-[8px] mb-1 ml-5"></i>
                                            </div>
                                        </div>
                                
                                        <hr class="border-t-2 border-blue-300 mb-4">
                                
                                        <form action="{{ route('barangay.residents.update', $resident->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="max-h-[70vh] overflow-y-auto grid grid-cols-1 md:grid-cols-2 gap-6">
                                                <div class="container">
                                
                                                    <label class="font-bold text-xl">Personal Information:</label>
                                                    <hr class="border-t-2 border-gray-300 mb-4 mt-4">
                                
                                                    <div class="form-group">
                                                        <label for="first_name" class="block text-sm font-medium text-gray-700">First Name:</label>
                                                        <input type="text" name="first_name" id="first_name" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" value="{{ old('first_name', $resident->first_name) }}">
                                                        @error('first_name')
                                                         <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                                         @enderror
                                                    </div>
                                    
                                                    <div class="form-group">
                                                        <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name:</label>
                                                        <input type="text" name="last_name" id="last_name" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" value="{{ old('last_name', $resident->last_name) }}">
                                                        @error('last_name')
                                                         <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                                         @enderror
                                                    </div>
                                    
                                                    <div class="form-group">
                                                        <label for="middle_name" class="block text-sm font-medium text-gray-700">Middle Name:</label>
                                                        <input type="text" name="middle_name" id="middle_name" value="{{ old('middle_name', $resident->middle_name) }}" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                                        @error('middle_name')
                                                         <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                                         @enderror
                                                    </div>
                    
                                                    <div class="form-group">
                                                        <label for="suffix" class="block text-sm font-medium text-gray-700">Suffix:</label>
                                                        <input type="text" name="suffix" id="suffix" value="{{ old('suffix', $resident->suffix) }}" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                                        @error('suffix')
                                                         <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                                         @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="purok" class="block text-sm font-medium text-gray-700">Purok:</label>
                                                        <select name="purok" id="purok" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                                            <option value="">Select Purok</option>
                                                            @foreach ($puroks as $purok)
                                                                <option value="{{ $purok->id }}" {{ old('purok', $resident->purok_id) == $purok->id ? 'selected' : '' }}>
                                                                    Purok {{ $purok->purok_number }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('purok')
                                                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                                        @enderror
                                                    </div>   
                                                    
                                    
                                                    <div class="form-group">
                                                        <label for="birth_date" class="block text-sm font-medium text-gray-700">Birth Date:</label>
                                                        <input type="date" name="birth_date" id="birth_date" value="{{ old('birth_date', $resident->birth_date) }}" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                                        @error('birth_date')
                                                         <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                                         @enderror
                                                    </div>
                                    
                                                    <div class="form-group">
                                                        <label for="place_of_birth" class="block text-sm font-medium text-gray-700">Place of Birth:</label>
                                                        <input type="text" name="place_of_birth" id="place_of_birth" value="{{ old('place_of_birth', $resident->place_of_birth) }}" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                                        @error('place_of_birth')
                                                         <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                                         @enderror
                                                    </div>
                                    
                                                    <div class="form-group">
                                                        <label for="gender" class="block text-sm font-medium text-gray-700">Gender:</label>
                                                        <select name="gender" id="gender" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                                            <option value="">Select Gender</option>
                                                            <option value="male" {{ old('gender', $resident->gender) === 'male' ? 'selected' : '' }}>Male</option>
                                                            <option value="female" {{ old('gender', $resident->gender) === 'female' ? 'selected' : '' }}>Female</option>
                                                            <option value="other" {{ old('gender', $resident->gender) === 'other' ? 'selected' : '' }}>Other</option>
                                                        </select>
                                                        @error('gender')
                                                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                                        @enderror
                                                    </div>                                                    
                                                    
                                                </div>
                                                <div class="container2">
                                
                                                    <label class="font-bold text-xl">Aditional Information:</label>
                                                    <hr class="border-t-2 border-gray-300 mb-4 mt-4">
                                    
                                                    <div class="form-group">
                                                        <label for="civil_status" class="block text-sm font-medium text-gray-700">Civil Status:</label>
                                                        <input type="text" name="civil_status" id="civil_status" value="{{ old('civil_status', $resident->civil_status) }}"class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                                        @error('civil_status')
                                                         <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                                         @enderror
                                                    </div>
                                    
                                                    <div class="form-group">
                                                        <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number:</label>
                                                        <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $resident->phone_number) }}"class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                                        @error('phone_number')
                                                         <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                                         @enderror
                                                    </div>
                                    
                                                    <div class="form-group">
                                                        <label for="citizenship" class="block text-sm font-medium text-gray-700">Citizenship:</label>
                                                        <input type="text" name="citizenship" id="citizenship" value="{{ old('citizenship', $resident->citizenship) }}"class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                                        @error('citizenship')
                                                         <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                                         @enderror
                                                    </div>
                                    
                                                    <div class="form-group">
                                                        <label for="nickname" class="block text-sm font-medium text-gray-700">Nickname:</label>
                                                        <input name="nickname" id="nickname" value="{{ old('nickname', $resident->nickname) }}" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                                        @error('nickname')
                                                         <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                                         @enderror
                                                    </div>
                                    
                                                    <div class="form-group">
                                                        <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                                                        <input type="email" name="email" id="email" value="{{ old('email', $resident->email) }}" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                                        @error('email')
                                                         <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                                         @enderror
                                                    </div>
                                    
                                                    <div class="form-group">
                                                        <label for="current_address" class="block text-sm font-medium text-gray-700">Current Address:</label>
                                                        <input type="text" name="current_address" id="current_address" value="{{ old('current_address', $resident->current_address) }}" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                                        @error('current_address')
                                                         <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                                         @enderror
                                                    </div>
                                    
                                                    <div class="form-group">
                                                        <label for="permanent_address" class="block text-sm font-medium text-gray-700">Permanent Address:</label>
                                                        <input type="text" name="permanent_address" id="permanent_address" value="{{ old('permanent_address', $resident->permanent_address) }}" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                                        @error('permanent_address')
                                                         <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                                         @enderror
                                                    </div>
                                                </div>   
                                            </div>      
                                            <div class="button-group flex justify-end mt-3">
                                                <button type="submit" class="btn btn-primary bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 mr-3">Update Resident</button>
                                
                                                <button type="button" onclick="toggleEditModal('{{ $resident->id }}')" class="inline-block align-baseline font-bold text-[10px] lg:text-[15px] text-gray-600 hover:text-blue-800">
                                                    Cancel
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <button onclick="toggleDeleteModal('{{ $resident->id }}')" class="text-red-700 py-1 px-2 md:px-3 rounded hover:text-red-900">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                                    
                                <!-- Delete Modal ni dere same sa log out nga layout -->
                                <div id="delete-modal-{{ $resident->id }}" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center z-20">
                                    <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-4 sm:p-6 md:w-1/2 lg:w-1/3">
                                        <p class="text-left text-lg font-bold text-gray-600 uppercase mb-3">Name: <span class="text-blue-600">{{ $resident->last_name}}, {{ $resident->first_name}}</span></p>
                                        <p class="text-left text-lg font-bold text-gray-600 uppercase mb-3">From: <span class="text-blue-600">{{ $resident->current_address}}</span></p>
    
                                        <hr class="border-t-2 border-gray-300">
            
                                        <p class="mb-5 mt-3 text-gray-600 text-left text-[17px]">Continue to delete this Resident?</p>
                                            
                                        <div class="flex justify-end space-x-4">
                                    
                                            <form action="{{ route('barangay.residents.delete', ['resident_id' => $resident->id]) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                                                    Delete
                                                </button>
                                            </form>

                                            <button onclick="toggleDeleteModal('{{ $resident->id }}')" class="inline-block align-baseline font-bold text-[10px] lg:text-[15px] text-gray-600 hover:text-blue-800">
                                                Cancel
                                            </button>
                                        </div>
                                    </div>
                                </div> 
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">No residents found for this barangay.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
       //Show ni sa delete modal
       function toggleDeleteModal(residentId) {
            const modal = document.getElementById(`delete-modal-${residentId}`);
            modal.classList.toggle('hidden');
        }

        function toggleEditModal(residentId) {
        const modal = document.getElementById(`edit-modal-${residentId}`);
        modal.classList.toggle('hidden');
    }
</script>

@endsection
