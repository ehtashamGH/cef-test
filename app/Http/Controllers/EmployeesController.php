<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Dompdf\Dompdf;

class EmployeesController extends Controller
{
    public function dashboard()
    {
        // Get all employees
        $employees = Employee::all();

        // Get active employees
        $activeEmployees = Employee::where('status', 1)->get();

        return view('dashboard', compact('employees', 'activeEmployees'));
    }

    public function index()
    {
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $request->validate(Employee::validationRules());
        
        $employee = new Employee();
        $employee->name = $request->input('name');
        $employee->father_name = $request->input('father_name');
        $employee->cnic = $request->input('cnic');
        $employee->dob = $request->input('dob');
        $employee->contact_no = $request->input('contact_no');
        $employee->street_address = $request->input('street_address');
        $employee->city = $request->input('city');
        $employee->state = $request->input('state');
        $employee->country = $request->input('country');
        $employee->status = $request->input('status');

        // Handle experiences (multiple)
        $experiences = [];
        $titles = $request->input('experience.*.title');
        $descriptions = $request->input('experience.*.description');
        $fromDates = $request->input('experience.*.from');
        $toDates = $request->input('experience.*.to');

        foreach ($titles as $index => $title) {
            $experiences[] = [
                'title' => $titles[$index],
                'description' => $descriptions[$index],
                'from' => $fromDates[$index],
                'to' => $toDates[$index],
            ];
        }
        $employee->experience = $experiences;

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $employee->profile_picture = $profilePicturePath;
        }

        $employee->save();


        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.profile', compact('employee'));
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $request->validate($employee->validationRules($id));

        $employee->name = $request->input('name');
        $employee->father_name = $request->input('father_name');
        $employee->cnic = $request->input('cnic');
        $employee->dob = $request->input('dob');
        $employee->contact_no = $request->input('contact_no');
        $employee->street_address = $request->input('street_address');
        $employee->city = $request->input('city');
        $employee->state = $request->input('state');
        $employee->country = $request->input('country');
        $employee->status = $request->input('status');

        // Handle experiences (multiple)
        $experiences = [];
        $titles = $request->input('experience.*.title');
        $descriptions = $request->input('experience.*.description');
        $fromDates = $request->input('experience.*.from');
        $toDates = $request->input('experience.*.to');
        foreach ($titles as $index => $title) {
            $experiences[] = [
                'title' => $titles[$index],
                'description' => $descriptions[$index],
                'from' => $fromDates[$index],
                'to' => $toDates[$index],
            ];
        }
        $employee->experience = $experiences;

        // Handle profile picture update
        if ($request->hasFile('profile_picture')) {
            // Delete old profile picture if exists
            if ($employee->profile_picture) {
                Storage::disk('public')->delete($employee->profile_picture);
            }
            // Store the new profile picture
            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $employee->profile_picture = $profilePicturePath;
        }

        $employee->save();

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }

    public function generatePDF($employeeId)
    {

        $employee = Employee::find($employeeId);

        if (!$employee) {
            abort(404);
        }

        $html = view('employees.profilePDF', compact('employee'))->render();
    
        $dompdf = new Dompdf();
        $dompdf->set_option('isRemoteEnabled', false); // Allow loading images from external URLs
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $dompdf->stream('employee_profile.pdf', ['Attachment' => 0]);
    }
}
