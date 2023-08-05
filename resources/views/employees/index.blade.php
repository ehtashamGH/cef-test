<x-app-layout>
        <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight d-flex justify-content-between align-items-center">
            {{ __('Employees List') }}
            <a href="{{ route('employees.create') }}" class="btn btn-primary btn-md">Create Employee</a>
        </h2>
    </x-slot>

    <div class="py-12">
         <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            @if(session('success'))
                <div id="flash-message" class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if($errors->any())
                <div id="flash-message" class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <table class="table table-bordered display" id="employeesTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Father Name</th>
                        <th>CNIC</th>
                        <th>DOB</th>
                        <th>Contact No</th>
                        <th>Address</th>
                        <th class="d-none">Experiences</th>
                        <th>Profile Picture</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employees as $employee)
                    <tr>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->father_name }}</td>
                        <td>{{ $employee->cnic }}</td>
                        <td>{{ \Carbon\Carbon::parse($employee->dob)->format('d M, Y') }}</td>
                        <td>{{ $employee->contact_no }}</td>
                        <td>{{ $employee->street_address }}, {{ $employee->city }}, {{ $employee->state }}, {{ $employee->country }}</td>
                        <td class="d-none">
                            @foreach($employee->experience as $e)
                                <p>
                                    <strong>Title:</strong> {{ $e['title'] }}
                                    <br>
                                    <strong>Description:</strong> {{ $e['description'] }}
                                    <br>
                                    <strong>From:</strong> {{ \Carbon\Carbon::parse($e['from'])->format('d M, Y') }}
                                    <br>
                                    <strong>To:</strong> {{ \Carbon\Carbon::parse($e['to'])->format('d M, Y') }}
                                </p>
                            @endforeach
                        </td>
                        <td>
                            @if($employee->profile_picture)
                                <img src="{{ asset('storage/' . $employee->profile_picture) }}" alt="Profile Picture" class="img-fluid" width="100">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>{{ $employee->status == 1 ? "Active" : "Inactive" }}</td>
                        <td>
                            <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-primary btn-sm">Profile</a>
                            <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this employee?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>
</x-app-layout>
