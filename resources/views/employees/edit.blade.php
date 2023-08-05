<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Employee') }}
        </h2>
    </x-slot>

    <div class="py-12">
         <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3 w-50">
                            <label for="name">Name*</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $employee->name) }}" required>
                        </div>

                        <div class="form-group mb-3 w-50">
                            <label for="father_name">Father Name*</label>
                            <input type="text" name="father_name" id="father_name" class="form-control" value="{{ old('father_name', $employee->father_name) }}" required>
                        </div>

                        <div class="form-group mb-3 w-50">
                            <label for="cnic">CNIC*</label>
                            <input type="text" name="cnic" id="cnic" class="form-control" value="{{ old('cnic', $employee->cnic) }}" placeholder="12345-6789012-3" autocomplete="nope" required>
                        </div>

                        <div class="form-group mb-3 w-25">
                            <label for="dob">Date of Birth*</label>
                            <input type="date" name="dob" id="dob" class="form-control" value="{{ old('dob', $employee->dob) }}" required onclick="this.showPicker()" style="width: 218px;">
                        </div>

                        <div class="form-group mb-3 w-50">
                            <label for="contact_no">Contact No*</label>
                            <input type="text" name="contact_no" id="contact_no" class="form-control" value="{{ old('contact_no', $employee->contact_no) }}" placeholder="03xx-xxxxxxx" autocomplete="nope" required>
                        </div>

                        <div class="form-group mb-3 w-50">
                            <label for="street_address">Street Address</label>
                            <input type="text" name="street_address" id="street_address" class="form-control" value="{{ old('street_address', $employee->street_address) }}">
                        </div>

                        <div class="form-group mb-3 w-50">
                            <label for="city">City*</label>
                            <input type="text" name="city" id="city" class="form-control" value="{{ old('city', $employee->city) }}"required>
                        </div>

                        <div class="form-group mb-3 w-50">
                            <label for="state">State</label>
                            <input type="text" name="state" id="state" class="form-control" value="{{ old('state', $employee->state) }}">
                        </div>

                        <div class="form-group mb-3 w-50">
                            <label for="country">Country*</label>
                            <input type="text" name="country" id="country" class="form-control" value="{{ old('country', $employee->country) }}" required>
                        </div>

                        <div class="form-group">
                            <label>Experience:</label>
                            <div class="experience-container">
                                @foreach($employee->experience as $index => $experience)
                                <div class="input-group mb-3">
                                    <input type="text" name="experience[{{ $index }}][title]" class="form-control" placeholder="Title*" value="{{ old('experience.'.$index.'.title', $experience['title']) }}" required>
                                    <textarea rows="1" name="experience[{{ $index }}][description]" class="form-control" style="width: 288px;" placeholder="Short Description">{{ old('experience.'.$index.'.description', $experience['description']) }}</textarea>
                                    <input type="date" name="experience[{{ $index }}][from]" class="form-control" value="{{ old('experience.'.$index.'.from', $experience['from']) }}" onclick="this.showPicker()" required>
                                    <input type="date" name="experience[{{ $index }}][to]" class="form-control" value="{{ old('experience.'.$index.'.to', $experience['to']) }}" onclick="this.showPicker()" required>
                                    @if($index === 0)
                                    <button type="button" class="btn btn-danger remove-experience disabled">-</button>
                                    @else
                                    <button type="button" class="btn btn-danger remove-experience">-</button>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                            <div class="form-group mb-3">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-secondary add-experience">+</button>
                                    <small class="form-text text-muted">You can add or remove experience by clicking the plus and minus buttons.</small>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3 w-50">
                            <label for="profile_picture">Current Profile Picture:</label>
                            @if($employee->profile_picture)
                            <div class="mt-2 mb-2">
                                <img src="{{ asset('storage/'.$employee->profile_picture) }}" alt="Profile Picture" style="max-width: 200px;">
                            </div>
                            @endif
                            <input type="file" name="profile_picture" id="profile_picture" class="form-control-file">

                        </div>

                        <div class="form-group mb-3 w-25">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option {{ $employee->status === 1 ? 'selected' : '' }} value="1">Active</option>
                                <option {{ $employee->status === 0 ? 'selected' : '' }} value="0">Inactive</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Update Employee</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const addExperienceBtn = document.querySelector('.add-experience');
            const experienceContainer = document.querySelector('.experience-container');

            let i = {{ count($employee->experience) }};
            addExperienceBtn.addEventListener('click', function () {
                const experience = document.createElement('div');
                experience.className = 'input-group mb-3';

                const titleInput = document.createElement('input');
                titleInput.type = 'text';
                titleInput.name = 'experience['+i+'][title]';
                titleInput.className = 'form-control';
                titleInput.placeholder = 'Title';
                titleInput.required = true;

                const descriptionTextarea = document.createElement('textarea');
                descriptionTextarea.name = 'experience['+i+'][description]';
                descriptionTextarea.rows = 1;
                descriptionTextarea.className = 'form-control';
                descriptionTextarea.style = 'width: 288px;';
                descriptionTextarea.placeholder = 'Short Description';

                const fromInput = document.createElement('input');
                fromInput.type = 'date';
                fromInput.name = 'experience['+i+'][from]';
                fromInput.className = 'form-control';
                fromInput.required = true;
                fromInput.addEventListener('click', function () {
                    this.showPicker();
                });

                const toInput = document.createElement('input');
                toInput.type = 'date';
                toInput.name = 'experience['+i+'][to]';
                toInput.className = 'form-control';
                toInput.required = true;
                toInput.addEventListener('click', function () {
                   this.showPicker();
                });

                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.className = 'btn btn-danger remove-experience';
                removeBtn.textContent = '-';
                removeBtn.addEventListener('click', function () {
                    experienceContainer.removeChild(experience);
                });

                experience.appendChild(titleInput);
                experience.appendChild(descriptionTextarea);
                experience.appendChild(fromInput);
                experience.appendChild(toInput);
                experience.appendChild(removeBtn);

                experienceContainer.appendChild(experience);

                i++;
            });

            const removeExperienceBtns = document.querySelectorAll('.remove-experience');
            removeExperienceBtns.forEach(function (removeBtn) {
                removeBtn.addEventListener('click', function () {
                    experienceContainer.removeChild(removeBtn.parentElement);
                });
            });
        });
    </script>
</x-app-layout>
