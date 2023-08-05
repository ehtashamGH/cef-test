<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'father_name', 'cnic', 'dob', 'contact_no',
        'street_address', 'city', 'state', 'country', 'experience',
        'profile_picture', 'status'
    ];

    protected $casts = [
        'experience' => 'json', // Convert the 'experience' field to JSON
    ];



    public static function validationRules($id=null)
    {
        $uniqueCnicRule = Rule::unique('employees')->where(function ($query) {
            $query->whereNull('deleted_at');
        })->ignore($id);

        $cnicRules = [
            'required',
            'string',
            'max:15',
            $uniqueCnicRule,
        ];

        if ($id === null) {
            $cnicRules[] = 'unique:employees,cnic';
        }

        return [
            'name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'cnic' => $cnicRules,
            'dob' => 'required|date',
            'contact_no' => 'required|string|max:12',
            'street_address' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'required|string|max:100',
            'experience.*' => 'nullable|array',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:1,0',
        ];
    }
}
