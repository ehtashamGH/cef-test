<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Employee Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
             <!-- Add the button to extract PDF -->
            <div class="flex justify-end mb-4">
                <a href="{{ route('generate.pdf', ['employee' => $employee->id]) }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600c btn btn-secondary buttons-copy buttons-html5">
                    Download PDF
                </a>
            </div>
            <div class="row">
                <!-- Left Card -->
                <div class="col-md-3 d-flex">
                    <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-4 md:p-8 text-center w-100">
                        <!-- Profile Picture -->
                        <div class="mb-4" style="width: 100px; display: block; margin-left: auto; margin-right: auto;">
                            @if ($employee->profile_picture)
                                <img src="{{ asset('storage/' . $employee->profile_picture) }}" alt="Profile Picture" class="w-200 h-200 border border-blue-500">
                            @else
                                <div class="w-200 h-200 bg-gray-300"></div>
                            @endif
                        </div>
                        <h3 class="text-lg font-semibold mb-2">{{ $employee->name }}</h3>
                    </div>
                </div>
                <!-- Right Card -->
                <div class="col-md-9 d-flex">
                    <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-4 md:p-8 w-100">
                        <h3 class="text-lg font-semibold mb-4">Personal Information</h3>
                        <!-- Other Employee Data -->
                        <p><strong>Father Name:</strong> {{ $employee->father_name }}</p>
                        <p><strong>CNIC:</strong> {{ $employee->cnic }}</p>
                        <p><strong>Date of Birth:</strong> {{ \Carbon\Carbon::parse($employee->dob)->format('d M, Y') }}</p>
                        <p><strong>Contact No:</strong> {{ $employee->contact_no }}</p>
                        <p><strong>Street Address:</strong> {{ $employee->street_address }}</p>
                        <p><strong>City:</strong> {{ $employee->city }}</p>
                        <p><strong>State:</strong> {{ $employee->state }}</p>
                        <p><strong>Country:</strong> {{ $employee->country }}</p>
                        <p><strong>Status:</strong> {{ $employee->status ? 'Active' : 'Inactive' }}</p>

                        <!-- Experiences -->
                        <hr class="my-4"> <!-- Horizontal line to separate experiences -->

                        <h3 class="text-lg font-semibold mb-2">Experience:</h3>
                        <div class="mb-4">
                            @forelse ($employee->experience as $experience)
                                <div class="row">
                                    <div class="col-md-3">
                                        <p><strong>Title:</strong> {{ $experience['title'] }}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <p><strong>Description:</strong> {{ $experience['description'] ? $experience['description'] : "N/A" }}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <p><strong>From:</strong> {{ \Carbon\Carbon::parse($experience['from'])->format('d M, Y') }}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <p><strong>To:</strong> {{ \Carbon\Carbon::parse($experience['to'])->format('d M, Y') }}</p>
                                    </div>
                                </div>
                            @empty
                                <p>No experiences found.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
