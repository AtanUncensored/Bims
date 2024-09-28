@extends('lgu.lgu-template.navigation-bar')

@section('icon')
    <i class="fas fa-user fa-lg text-black mr-1"></i>
@endsection

@section('title', 'Barangay Details')

@section('content')
<div class="p-6">
    <h2 class="text-2xl text-blue-500 font-bold mb-6">{{ $barangay->barangay_name }}</h2>

    <!-- Dynamic Residents Table -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="grid grid-cols-3 divide-x divide-gray-300">

            <div>
                <table class="min-w-full divide-y divide-gray-200">
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Residents</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-bold">{{ $totalUsers }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Males</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-bold">{{ $totalMales }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Females</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-bold">{{ $totalFemales }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Adults</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-bold">{{ $totalAdults }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Separator -->
            <div class="flex justify-center items-center">
                <div class="w-0.5 bg-black h-full"></div>
            </div>

            <div>
                <table class="min-w-full divide-y divide-gray-200">
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Seniors</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-bold">{{ $totalSeniors }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Youth</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-bold">{{ $totalYouth }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Children</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-bold">{{ $totalChildren }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Households</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-bold">{{ $totalUsers }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Back to List Route -->
    <div class="mt-6">
        <a href="{{ route('lgu.barangays-list') }}" class="inline-block text-white bg-gray-600 hover:bg-gray-500 py-2 px-4 rounded font-semibold transition">
            Back to List
        </a>
    </div>
</div>
@endsection
