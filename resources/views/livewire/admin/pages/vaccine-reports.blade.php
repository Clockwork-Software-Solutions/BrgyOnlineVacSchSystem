<div x-data="{sortSex : @entangle('sortSex'),sortPurok:@entangle('sortPurok'),sortAppointmentTime : @entangle('sortAppointmentTime'),sortAppointmentType : @entangle('sortAppointmentType'), sortAppointmentDate : @entangle('sortAppointmentDate'),sortVaccine:@entangle('sortVaccine'),sortName:@entangle('sortName')}">
    <x-slot name="header">
        {{ __('Reports') }}
    </x-slot>

    <div class="container px-3 pt-3 pb-5 bg-white px-100 drop-shadow-xl rounded-xl">
        <div class="w-auto max-h-full text-indigo-700 md:h-full">
            <div class="rows-2">
                {{-- filter list --}}
                <div class="items-start block px-2 mt-5 text-xs bg-white text-slate-900">
                    <div class="grid w-full grid-cols-5 gap-2">
                        <div class="col-span-1 p-2 border border-gray-700 border-dashed rounded-md bg-gray-200/80">
                            <h1 class="text-sm">Vaccines</h1>
                            <div class="grid grid-cols-3 gap-2">
                            
                                @foreach ($vaccines as $vaccine)
                                    <p class="truncate">
                                        <input class="rounded-md focus:ring-0" type="checkbox" name="{{ $vaccine->id }}" id="1" value="{{ $vaccine->id }}" wire:model="vaccine_ids.{{ $vaccine->id }}" wire:key='{{ $vaccine->id }}'>
                                        {{ $vaccine->vaccine_name }}
                                    </p>
                                @endforeach
                                
                            </div>
                        </div>
                        <div class="col-span-3 p-2 border border-gray-700 border-dashed rounded-md bg-gray-200/80">
                            <h1 class="text-sm">Puroks</h1>
                            <div class="grid grid-cols-4 gap-2">
                            
                                @foreach ($puroks as $purok)
                                    <p class="truncate">
                                        <input class="rounded-md focus:ring-0" type="checkbox" name="{{ $purok->id }}" id="1" value="{{ $purok->id }}" wire:model="purok_ids.{{ $purok->id }}" wire:key='{{ $purok->id }}'>
                                        {{ $purok->name }}
                                    </p>
                                @endforeach
                                
                            </div>
                        </div>
                        <div class="col-span-1 p-2 border border-gray-700 border-dashed rounded-md bg-gray-200/80">
                            <h1 class="text-sm">Date</h1>
                            <div class="grid grid-rows-2" x-data='{showSelect : true}'>
                                <div class="flex justify-between row-span-1">
                                    <div class="flex items-center ">
                                        <input x-on:click="showSelect = !showSelect" :enabled="showSelect == false ? 'true' : 'false'" class="rounded-md focus:ring-0" type="checkbox" name="date_all" id="1"  wire:model="date_all" wire:key='date_all'>
                                        <span class="pl-1">All</span>
                                    </div>
                                    <div class="items-center my-auto">
                                        <span wire:click="clearDates" class="text-xs italic hover:cursor-pointer hover:not-italic hover:underline hover:text-blue-500 hover:text-md hover:font-bold">Reset Dates</span>
                                    </div>
                                </div>
                                <div class="row-span-1" x-show="showSelect">
                                    Date
                                    <input class="text-xs rounded-md focus:ring-0" type="date" name="date_all" id="1"  wire:model="selected_date" wire:key='date_all'>                                  
                                </div>                        
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end filter list --}}

                {{-- table--}}
                <div class="block h-full rounded bg-bg-gray-50 drop-shadow-lg">

                    <div class="px-4 sm:px-6 lg:px-8">

                        <div class="flex flex-col mt-2">
                            <div class="-mx-4 -my-2 sm:-mx-6 lg:-mx-8">
                                <div class="flex justify-end min-w-full pt-2 pb-1 ">
                                    <div class="flex pr-2 ">
                                        <p
                                            class="my-auto ml-3 mr-2 text-lg font-extrabold text-right uppercase text-slate-800">
                                            Search name:</p>
                                        <input wire:model="search_name" type="text" name="" id=""
                                            class="my-auto text-sm rounded-2xl w-80 focus:ring-2 focus:ring-offset-1 focus:ring-blue-200">
                                    </div>
                                </div>
                                <div class="inline-block min-w-full py-2 align-middle ">
                                    <div
                                        class="overflow-y-auto shadow-sm ring-1 ring-black ring-opacity-5 h-80 rounded-xl ">
                                        <table class="min-w-full border-separate " style="border-spacing: 0">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th scope="col"
                                                        class="sticky top-0 z-10 border-b border-gray-300 bg-gray-50 bg-opacity-75 py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter sm:pl-6 lg:pl-8">
                                                        <span class="inline-flex group">
                                                            #
                                                        </span>
                                                    </th>
                                                    <th scope="col"
                                                        class="sticky top-0 z-10 border-b border-gray-300 bg-gray-50 bg-opacity-75 py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter sm:pl-6 lg:pl-8">
                                                        <span x-on:click="sortName = !sortName" class="inline-flex group hover:cursor-pointer">
                                                            Name
                                                            <span :class="sortName == true ? 'bg-gray-200 text-gray-900 group-hover:bg-gray-300': 'invisible text-gray-400 group-hover:visible group-focus:visible'"
                                                                class="flex-none ml-2 text-gray-900 bg-gray-200 rounded group-hover:bg-gray-300">
                                                                <!-- Heroicon name: solid/chevron-down -->
                                                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 20 20" fill="currentColor"
                                                                    aria-hidden="true">
                                                                    <path fill-rule="evenodd"
                                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                                        clip-rule="evenodd" />
                                                                </svg>
                                                            </span>
                                                        </span>
                                                    </th>
                                                    <th scope="col"
                                                        class="sticky top-0 z-10 hidden border-b border-gray-300 bg-gray-50 bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter sm:table-cell">
                                                        <span x-on:click="sortSex = !sortSex" class="inline-flex group hover:cursor-pointer">
                                                           Sex
                                                           {{-- <span :class="sortSex == true ? 'bg-gray-200 text-gray-900 group-hover:bg-gray-300': 'invisible text-gray-400 group-hover:visible group-focus:visible'"
                                                                class="flex-none ml-2 text-gray-900 bg-gray-200 rounded group-hover:bg-gray-300">
                                                                <!-- Heroicon name: solid/chevron-down -->
                                                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 20 20" fill="currentColor"
                                                                    aria-hidden="true">
                                                                    <path fill-rule="evenodd"
                                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                                        clip-rule="evenodd" />
                                                                </svg>
                                                            </span> --}}
                                                        </span>
                                                    </th>
                                                    <th scope="col"
                                                        class="sticky top-0 z-10 hidden border-b border-gray-300 bg-gray-50 bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter sm:table-cell">
                                                        <span x-on:click="sortPurok = !sortPurok" class="inline-flex group hover:cursor-pointer">
                                                            Purok
                                                             {{-- <span :class="sortPurok == true ? 'bg-gray-200 text-gray-900 group-hover:bg-gray-300': 'invisible text-gray-400 group-hover:visible group-focus:visible'"
                                                                class="flex-none ml-2 text-gray-900 bg-gray-200 rounded group-hover:bg-gray-300">
                                                                <!-- Heroicon name: solid/chevron-down -->
                                                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 20 20" fill="currentColor"
                                                                    aria-hidden="true">
                                                                    <path fill-rule="evenodd"
                                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                                        clip-rule="evenodd" />
                                                                </svg>
                                                            </span> --}}
                                                        </span>
                                                    </th>
                                                    <th scope="col"
                                                        class="sticky top-0 z-10 hidden border-b border-gray-300 bg-gray-50 bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter lg:table-cell">
                                                        <span x-on:click="sortAppointmentDate = !sortAppointmentDate"class="inline-flex group">
                                                            Date
                                                             {{-- <span :class="sortAppointmentDate == true ? 'bg-gray-200 text-gray-900 group-hover:bg-gray-300': 'invisible text-gray-400 group-hover:visible group-focus:visible'"
                                                                class="flex-none ml-2 text-gray-900 bg-gray-200 rounded group-hover:bg-gray-300">
                                                                <!-- Heroicon name: solid/chevron-down -->
                                                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 20 20" fill="currentColor"
                                                                    aria-hidden="true">
                                                                    <path fill-rule="evenodd"
                                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                                        clip-rule="evenodd" />
                                                                </svg>
                                                            </span> --}}
                                                        </a>
                                                    </th>
                                                    <th scope="col"
                                                        class="sticky top-0 z-10 border-b border-gray-300 bg-gray-50 bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter">
                                                        <span x-on:click="sortAppointmentTime = !sortAppointmentTime" class="inline-flex group hover:cursor-pointer">
                                                            Time Slot
                                                             {{-- <span :class="sortAppointmentTime == true ? 'bg-gray-200 text-gray-900 group-hover:bg-gray-300': 'invisible text-gray-400 group-hover:visible group-focus:visible'"
                                                                class="flex-none ml-2 text-gray-900 bg-gray-200 rounded group-hover:bg-gray-300">
                                                                <!-- Heroicon name: solid/chevron-down -->
                                                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 20 20" fill="currentColor"
                                                                    aria-hidden="true">
                                                                    <path fill-rule="evenodd"
                                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                                        clip-rule="evenodd" />
                                                                </svg>
                                                            </span> --}}
                                                        </span></th>
                                                    <th scope="col"
                                                        class="sticky top-0 z-10 border-b border-gray-300 bg-gray-50 bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter">
                                                        <span x-on:click="sortVaccine = !sortVaccine" class="inline-flex group hover:cursor-pointer">
                                                            Vaccine
                                                             {{-- <span :class="sortVaccine == true ? 'bg-gray-200 text-gray-900 group-hover:bg-gray-300': 'invisible text-gray-400 group-hover:visible group-focus:visible'"
                                                                class="flex-none ml-2 text-gray-900 bg-gray-200 rounded group-hover:bg-gray-300">
                                                                <!-- Heroicon name: solid/chevron-down -->
                                                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 20 20" fill="currentColor"
                                                                    aria-hidden="true">
                                                                    <path fill-rule="evenodd"
                                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                                        clip-rule="evenodd" />
                                                                </svg>
                                                            </span> --}}
                                                        </span></th>
                                                    <th scope="col"
                                                        class="sticky top-0 z-10 border-b border-gray-300 bg-gray-50 bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter">
                                                        <span x-on:click="sortAppointmentType = !sortAppointmentType" class="inline-flex group hover:cursor-pointer">
                                                            Type
                                                             {{-- <span :class="sortAppointmentType == true ? 'bg-gray-200 text-gray-900 group-hover:bg-gray-300': 'invisible text-gray-400 group-hover:visible group-focus:visible'"
                                                                class="flex-none ml-2 text-gray-900 bg-gray-200 rounded group-hover:bg-gray-300">
                                                                <!-- Heroicon name: solid/chevron-down -->
                                                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 20 20" fill="currentColor"
                                                                    aria-hidden="true">
                                                                    <path fill-rule="evenodd"
                                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                                        clip-rule="evenodd" />
                                                                </svg>
                                                            </span> --}}
                                                        </span></th>

                                                    <th scope="col"
                                                        class="sticky top-0 z-10 border-b border-gray-300 bg-gray-50 bg-opacity-75 py-3.5 pr-4 pl-3 backdrop-blur backdrop-filter sm:pr-6 lg:pr-8">
                                                        <span class="sr-only">View</span>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white ">
                                                @if ($appointment_lists->count() > 0)
                                                        @foreach ($appointment_lists as $appointment)
                                                            @if ($loop->index % 2 == 0)
                                                                <tr>
                                                                    <td
                                                                    class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 border-b border-gray-200 whitespace-nowrap sm:pl-6 lg:pl-8">
                                                                    {{ $loop->index+1 }}
                                                                    </td>
                                                                    
                                                                    <td
                                                                        class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 border-b border-gray-200 whitespace-nowrap sm:pl-6 lg:pl-8">
                                                                        {{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }} {{ $appointment->patient->suffix }}</td>
                                                                    <td
                                                                        class="hidden px-3 py-4 text-sm text-gray-500 border-b border-gray-200 whitespace-nowrap sm:table-cell">
                                                                        {{ $appointment->patient->sex }}</td>
                                                                    <td
                                                                        class="hidden px-3 py-4 text-sm text-gray-500 border-b border-gray-200 whitespace-nowrap lg:table-cell">
                                                                        {{ $appointment->patient->purok->name }}</td>
                                                                    <td
                                                                        class="px-3 py-4 text-sm text-gray-500 border-b border-gray-200 whitespace-nowrap">
                                                                        {{ $appointment->appointmentDate->date }}
                                                                    </td>
                                                                    <td
                                                                        class="px-3 py-4 text-sm text-gray-500 border-b border-gray-200 whitespace-nowrap">
                                                                        {{ $appointment->appointmentTime->time_slot }}
                                                                    </td>
                                                                    <td
                                                                        class="px-3 py-4 text-sm text-gray-500 border-b border-gray-200 whitespace-nowrap">
                                                                        {{ $appointment->vaccine->vaccine_name }}
                                                                    </td>
                                                                    <td
                                                                        class="px-3 py-4 text-sm text-gray-500 border-b border-gray-200 whitespace-nowrap">
                                                                        {{ $appointment->appointmentType->name =='first_dose' ? '1st dose' : '2nd dose' }}
                                                                    </td>
                                                                    <td
                                                                        class="relative py-4 pl-3 pr-4 text-sm font-medium text-right border-b border-gray-200 whitespace-nowrap sm:pr-6 lg:pr-8">
                                                                        <a href="{{ route('view-patient-information',['patient_id'=>$appointment->patient_id]) }}"
                                                                            class="text-indigo-600 hover:text-indigo-900">View<span
                                                                                class="sr-only">,  {{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }}</span></a>
                                                                    </td>
                                                                    
                                                                </tr>
                                                                
                                                            @else
                                                            <tr class="bg-gray-100">
                                                                <td
                                                                class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 border-b border-gray-200 whitespace-nowrap sm:pl-6 lg:pl-8">
                                                                {{ $loop->index+1 }}
                                                                </td>
                                                                
                                                                <td
                                                                    class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 border-b border-gray-200 whitespace-nowrap sm:pl-6 lg:pl-8">
                                                                    {{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }} {{ $appointment->patient->suffix }}</td>
                                                                <td
                                                                    class="hidden px-3 py-4 text-sm text-gray-500 border-b border-gray-200 whitespace-nowrap sm:table-cell">
                                                                    {{ $appointment->patient->sex }}</td>
                                                                <td
                                                                    class="hidden px-3 py-4 text-sm text-gray-500 border-b border-gray-200 whitespace-nowrap lg:table-cell">
                                                                    {{ $appointment->patient->purok->name }}</td>
                                                                <td
                                                                    class="px-3 py-4 text-sm text-gray-500 border-b border-gray-200 whitespace-nowrap">
                                                                    {{ $appointment->appointmentDate->date }}
                                                                </td>
                                                                <td
                                                                    class="px-3 py-4 text-sm text-gray-500 border-b border-gray-200 whitespace-nowrap">
                                                                    {{ $appointment->appointmentTime->time_slot }}
                                                                </td>
                                                                <td
                                                                    class="px-3 py-4 text-sm text-gray-500 border-b border-gray-200 whitespace-nowrap">
                                                                    {{ $appointment->vaccine->vaccine_name }}
                                                                </td>
                                                                <td
                                                                    class="px-3 py-4 text-sm text-gray-500 border-b border-gray-200 whitespace-nowrap">
                                                                    {{ $appointment->appointmentType->name =='first_dose' ? '1st dose' : '2nd dose' }}
                                                                </td>
                                                                <td
                                                                    class="relative py-4 pl-3 pr-4 text-sm font-medium text-right border-b border-gray-200 whitespace-nowrap sm:pr-6 lg:pr-8">
                                                                    <a href="{{ route('view-patient-information',['patient_id'=>$appointment->patient_id]) }}"
                                                                        class="text-indigo-600 hover:text-indigo-900">View<span
                                                                            class="sr-only">,  {{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }}</span></a>
                                                                </td>
                                                            </tr>
                                                            @endif
                                                        @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="9"
                                                        class="py-4 pl-4 pr-3 font-bold text-center text-gray-900 border-b border-gray-200 text-md whitespace-nowrap sm:pl-6 lg:pl-8">
                                                        No Entries Found or To Display
                                                        </td>
                                                    </tr>
                                                @endif
                                               

                                                <!-- More people... -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                {{-- end table--}}
                
                <div class="block h-full p-4 mt-2 bg-gray-100 rounded drop-shadow-lg">
                    <div class="grid justify-start grid-cols-3 gap-2 text-gray-800 border-collapse text-md">
                       
                        @foreach ($inventoryToCount as $key => $inventoryCount)
                            <div class="col-span-1 p-2 border border-gray-700 border-dashed rounded-md bg-gray-200/80">
                                    <table class="w-full">
                                        <thead>
                                            <tr>
                                                <th class="text-left">
                                                    <h1 class="text-sm">{{ $inventoryCount->vaccine_name }}</h1>
                                                </th>
                                                <th class="text-right">
                                                    <h1 class="text-sm"></h1>
                                                </th>
                                                <th class="text-right">
                                                    <h1 class="text-sm"></h1>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="py-2">
                                                <td class="px-3 text-left" colspan="2">
                                                    <h1 class="text-sm">Reserved and/or Used</h1>
                                                </td>
                                                <td class="px-3 text-right">
                                                    <h1 class="text-sm">{{ $inventoryCount->maximum_slots - $inventoryCount->available_slots }}</h1>
                                                </td>
                                            </tr>
                                            <tr class="py-2">
                                                <td class="px-3 text-left whitespace-nowrap" colspan="2">
                                                    <h1 class="text-sm">Vaccines in Stock <span class="text-xs italic">unreserved</span></h1>
                                                </td>
                                                <td class="px-3 text-right">
                                                    <h1 class="text-sm">{{ $inventoryCount->available_slots }}</h1>
                                                </td>
                                            </tr>
                                            <tr class="py-2 border-t-2 border-black border-solid">
                                                <td class="px-3 text-left" colspan="2">
                                                    <h1 class="text-sm">Total Vaccines</h1>
                                                </td>
                                                <td class="px-3 text-right">
                                                    <h1 class="text-sm">{{ $inventoryCount->maximum_slots}}</h1>
                                                </td>
                                            </tr>
                                    </table>
                            </div>
                        @endforeach
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
