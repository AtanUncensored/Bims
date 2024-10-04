@extends('barangay.templates.navigation-bar')

@section('icon')
<i class="fas fa-users fa-lg"></i>
@endsection

@section('title', 'Residents')

@section('content')
<div class="py-2 px-4">
    <h2 class="text-2xl text-green-600 font-semibold">LIST OF AVAILABLE RESIDENTS:</h2>
    
    <div class="text-center">
        <hr class="border-t-2 mt-3 mb-4 border-gray-300">
    </div>
    
    <div class="flex justify-between mb-4">
        <a href="#" class="py-2 px-4 bg-green-500 text-white rounded hover:bg-green-600 transition"><i class="fa-solid fa-download"></i> Export Data</a>

          <!-- Search bar -->
          <form class="inline-flex items-center justify-center" method="GET" action="{{ route('barangay.residents.index') }}">
            <input type="text" name="search" placeholder="Search a resident..." class="py-2 px-4 border border-gray-300 rounded-l-md focus:outline-none focus:ring-1 focus:ring-green-500">
            <button type="submit" class="py-2 px-4 bg-gray-600 text-white rounded-r-md hover:bg-gray-600 transition"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>

        <a href="{{ route('barangay.create-user') }}" class="py-2 px-4 bg-blue-600 text-white rounded flex items-center space-x-2 hover:bg-blue-500 transition">
            <i class="fa-solid fa-plus"></i>
            <span>Add Resident</span>
        </a>
    </div>
    
        @if(session('success'))
            <div class="alert alert-success mb-4 bg-green-100 text-green-800 border border-green-300 rounded-lg py-2 px-4">{{ session('success') }}</div>
        @endif
    
        <div class="max-h-[43vh] overflow-y-auto">
            <table class="min-w-full bg-white">
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
                            <td class="py-2 px-4 border-b border-gray-200">{{ $resident->purok }}</td>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $resident->gender }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-sm font-medium space-x-2 text-center">
                                <a href="{{ route('barangay.residents.view', ['resident_id' => $resident->id]) }}" class="text-gray-700 py-1 px-2 md:px-3 rounded hover:text-gray-900"><i class="fa-solid fa-window-maximize"></i></a>
                                <a href="{{ route('barangay.residents.edit', ['resident_id' => $resident->id]) }}" class="text-blue-600 py-1 px-3 rounded hover:text-blue-800"><i class="fa-solid fa-pen"></i></a>
                                <button type="button" class="text-red-600 py-1 px-3 rounded hover:text-red-800" data-modal-target="#deleteModal" data-modal-toggle="deleteModal">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                                
                                <!-- Delete Confirmation Modal -->
                                <div id="deleteModal" class="hidden fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto inset-0 h-modal h-full bg-gray-900 bg-opacity-50">
                                    <div class="relative w-full max-w-md h-full md:h-auto mx-auto mt-20">
                                        <div class="relative bg-white rounded-lg shadow">
                                            <div class="p-4 border-b">
                                                <h3 class="text-lg font-semibold text-gray-900">Delete Confirmation - <span class="text-blue-600">Resident</span></h3>
                                            </div>
                                            <div class="p-6">
                                                <p class="text-[15px] text-gray-600">Are you sure you want to delete this resident?</p>
                                            </div>
                                            <div class="p-4 border-t flex justify-end space-x-2">
                                                <button type="button" class="text-gray-600 hover:text-gray-800 px-3 py-2 rounded" data-modal-hide="deleteModal">
                                                    Cancel
                                                </button>
                                                <form action="{{ route('barangay.residents.delete', ['resident_id' => $resident->id]) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800 px-3 py-2 rounded" onclick="return confirm('Are you sure you want to delete this resident?');">Delete</button>
                                                </form>
                                            </div>
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
<script>
        //Show ni sa delete modal
        document.querySelectorAll('[data-modal-toggle]').forEach(button => {
            button.addEventListener('click', function () {
                const modalId = this.getAttribute('data-modal-target');
                document.querySelector(modalId).classList.toggle('hidden');
            });
        });
        //Hide ni sa delete modal
        document.querySelectorAll('[data-modal-hide]').forEach(button => {
            button.addEventListener('click', function () {
                this.closest('.fixed').classList.add('hidden');
            });
        });
</script>

@endsection
