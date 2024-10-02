@extends('user.templates.navigation-bar')

@section('icon')
<i class="fa-solid fa-certificate fa-xl"></i>
@endsection

@section('title', 'Residency')

@section('content')

  <div class="py-2 px-4">
    <h2 class="text-2xl font-semibold text-gray-800">Request Certificate of Residency</h2>
    <hr class="border-t-2 mt-3 mb-6 border-gray-300">

    @if(session('success'))
        <div class="bg-green-500 text-white p-3 mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('certificates.residences.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Full Name</label>
            <input type="text" id="name" name="name" class="w-full border-gray-300" required>
        </div>

        <div class="mb-4">
            <label for="age" class="block text-gray-700">Age</label>
            <input type="number" id="age" name="age" class="w-full border-gray-300" required>
        </div>

        <div class="mb-4">
            <label for="gender" class="block text-gray-700">Gender</label>
            <select id="gender" name="gender" class="w-full border-gray-300" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="reason" class="block text-gray-700">Reason for Request</label>
            <input type="text" id="reason" name="reason" class="w-full border-gray-300" required>
        </div>

        <div class="mb-4">
            <label for="date" class="block text-gray-700">Date</label>
            <input type="date" id="date" name="date" class="w-full border-gray-300" required>
        </div>

        <div class="mb-4">
            <label for="punongbarangay" class="block text-gray-700">Punong Barangay</label>
            <input type="text" id="punongbarangay" name="punongbarangay" class="w-full border-gray-300" required>
        </div>

        <div class="mb-4">
            <label for="purok_id" class="block text-gray-700">Purok</label>
            <select id="purok_id" name="purok_id" class="w-full border-gray-300" required>
                @foreach($puroks as $purok)
                    <option value="{{ $purok->id }}">{{ $purok->purok_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="ORnumber" class="block text-gray-700">OR Number (Optional)</label>
            <input type="text" id="ORnumber" name="ORnumber" class="w-full border-gray-300">
        </div>

        <div class="mb-4">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2">Submit Request</button>
        </div>
    </form>
  </div>

@endsection
