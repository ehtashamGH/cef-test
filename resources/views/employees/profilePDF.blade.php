<!DOCTYPE html>
<html>
<head>
    <style>
        /* Add any basic styling here */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        h3 {
            font-size: 20px;
            margin-bottom: 15px;
        }
        .mb-2 {
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ccc;
            vertical-align: top; /* Set the vertical alignment to top */
        }
        .image-container {
            margin-top: 30px;
            width: 100px;
            height: 100px;
            border: 1px solid #3490dc;
            text-align: center; /* Center the image horizontally */
            display: block; 
            margin-left: auto; 
            margin-right: auto;
        }
        /* Adjust the image size for better alignment */
        .image-container img {
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>
    <table>
        <tr>
             <td style="width: 20%; text-align: center;">
                <!-- Profile Picture -->
                <div class="image-container">
                    @if ($employee->profile_picture)
                        @php
                            $imageData = base64_encode(file_get_contents(public_path('storage/' . $employee->profile_picture)));
                            $imageSrc = 'data:image/png;base64,' . $imageData;
                        @endphp
                        <img src="{{ $imageSrc }}" alt="Profile Picture">
                    @else
                        <div style="background-color: #ccc;"></div>
                    @endif
                    <h3 style="width: 100%; text-align:center;">{{ $employee->name }}</h3>
                </div>
            </td>
            <td style="width: 80%;">
               <h3 class="mb-2">Personal Information:</h3>
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
                <h3 class="mb-2">Experience:</h3>
                <table class="experiences-table">
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>From</th>
                        <th>To</th>
                    </tr>
                    @forelse ($employee->experience as $experience)
                        <tr>
                            <td>{{ $experience['title'] }}</td>
                            <td>{{ $experience['description'] ? $experience['description'] : "N/A" }}</td>
                            <td>{{ \Carbon\Carbon::parse($experience['from'])->format('d M, Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($experience['to'])->format('d M, Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No experiences found.</td>
                        </tr>
                    @endforelse
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
