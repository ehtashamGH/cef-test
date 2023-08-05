<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden sm:rounded-lg">
                <!-- <div class="p-6 text-gray-900 dark:text-gray-100"> -->
                    <!-- {{ __("You're logged in!") }} -->
                     <div class="row" style="background: #f3f4f6;">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <div class="card">
                              <div class="card-header"><h5 class="card-title">Total Employees</h5></div>
                              <div class="card-body">
                                    <h5 class="card-title text-center">{{ $employees->count() }}</h5>
                              </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header"><h5 class="card-title">Active Employees</h5></div>
                                <div class="card-body">
                                    <h5 class="card-title text-center">{{ $activeEmployees->count() }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- </div> -->
            </div>
        </div>
    </div>
</x-app-layout>
