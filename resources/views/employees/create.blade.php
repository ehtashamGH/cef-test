<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Employee') }}
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
                    <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-3 w-50">
                            <label for="name">Name*</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                        </div>

                        <div class="form-group mb-3 w-50">
                            <label for="father_name">Father Name*</label>
                            <input type="text" name="father_name" id="father_name" class="form-control" value="{{ old('father_name') }}" required>
                        </div>

                        <div class="form-group mb-3 w-50">
                            <label for="cnic">CNIC*</label>
                            <input type="text" name="cnic" id="cnic" class="form-control" value="{{ old('cnic') }}" placeholder="12345-6789012-3" autocomplete="nope" required>
                        </div>

                        <div class="form-group mb-3 w-25">
                            <label for="dob">Date of Birth*</label>
                            <input type="date" name="dob" id="dob" class="form-control" value="{{ old('dob') }}" required onclick="this.showPicker()" style="width: 218px;">
                        </div>

                        <div class="form-group mb-3 w-50">
                            <label for="contact_no">Contact No*</label>
                            <input type="text" name="contact_no" id="contact_no" class="form-control" value="{{ old('contact_no') }}" placeholder="03xx-xxxxxxx" autocomplete="nope" required>
                        </div>

                        <div class="form-group mb-3 w-50">
                            <label for="street_address">Street Address</label>
                            <input type="text" name="street_address" id="street_address" class="form-control" value="{{ old('street_address') }}">
                        </div>

                        <div class="form-group mb-3 w-50">
                            <label for="city">City*</label>
                            <input type="text" name="city" id="city" class="form-control" value="{{ old('city') }}"required>
                        </div>

                        <div class="form-group mb-3 w-50">
                            <label for="state">State</label>
                            <input type="text" name="state" id="state" class="form-control" value="{{ old('state') }}">
                        </div>

                        <div class="form-group mb-3 w-50">
                            <label for="country">Country*</label>
                            <input type="text" name="country" id="country" class="form-control" value="{{ old('country') }}" required>
                        </div>

                        <div class="form-group">
                            <label>Experience:</label>
                            <div class="experience-container">
                                <div class="input-group mb-3">
                                    <input type="text" name="experience[0][title]" class="form-control" placeholder="Title*" value="{{ old('experience.0.title') }}" required>
                                    <textarea rows="1" name="experience[0][description]" class="form-control" style="width: 288px;" placeholder="Short Description">{{ old('experience.0.description') }}</textarea>
                                    <input type="date" name="experience[0][from]" class="form-control" value="{{ old('experience.0.from') }}" onclick="this.showPicker()" required>
                                    <input type="date" name="experience[0][to]" class="form-control" value="{{ old('experience.0.to') }}" onclick="this.showPicker()" required>
                                    <button type="button" class="btn btn-danger disabled">-</button>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-secondary add-experience">+</button>
                                <small class="form-text text-muted">You can add or remove experience by clicking the plus and minus buttons.</small>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3 w-50">
                            <label for="profile_picture">Profile Picture:</label>
                            <input type="file" name="profile_picture" id="profile_picture" class="form-control-file" value="{{ old('profile_picture') }}" required>
                        </div>

                        <div class="form-group mb-3 w-25">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option {{ (collect(old('status'))->contains(1)) ? 'selected':'' }} value="1">Active</option>
                                <option {{ (collect(old('status'))->contains(0)) ? 'selected':'' }} value="0">Inactive</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Create Employee</button>
                        </div>
                    </form>
            </div>
        </div>           
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const addExperienceBtn = document.querySelector('.add-experience');
            const experienceContainer = document.querySelector('.experience-container');

            i = 1;
            addExperienceBtn.addEventListener('click', function () {
                const experience = document.createElement('div');
                experience.className = 'input-group mb-3';

                const titleInput = document.createElement('input');
                titleInput.type = 'text';
                titleInput.name = 'experience['+i+'][title]';
                titleInput.className = 'form-control';
                titleInput.placeholder = 'Title*';

                const descriptionTextarea = document.createElement('textarea');
                descriptionTextarea.name = 'experience['+i+'][description]';
                descriptionTextarea.rows = 1;
                descriptionTextarea.className = 'form-control';
                descriptionTextarea.placeholder = 'Short Description';
                descriptionTextarea.style = 'width: 288px;';


                const fromInput = document.createElement('input');
                fromInput.type = 'date';
                fromInput.name = 'experience['+i+'][from]';
                fromInput.className = 'form-control';
                fromInput.addEventListener('click', function () {
                    this.showPicker();
                });

                const toInput = document.createElement('input');
                toInput.type = 'date';
                toInput.name = 'experience['+i+'][to]';
                toInput.className = 'form-control';
                toInput.addEventListener('click', function () {
                   this.showPicker();
                });
                
                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.className = 'btn btn-danger';
                removeBtn.textContent = '-';
                removeBtn.addEventListener('click', function () {
                    experienceContainer.removeChild(experience);
                    // i--;
                });

                experience.appendChild(titleInput);
                experience.appendChild(descriptionTextarea);
                experience.appendChild(fromInput);
                experience.appendChild(toInput);
                experience.appendChild(removeBtn);

                experienceContainer.appendChild(experience);

                i++;
            });
        });
    </script>
</x-app-layout>
