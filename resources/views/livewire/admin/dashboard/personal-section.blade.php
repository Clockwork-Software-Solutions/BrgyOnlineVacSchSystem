<div class="py-3 bg-white rounded-lg shadow-lg shadow-slate-400/40"
    x-data="{showConfirmModal : @entangle('showConfirmModal'), showSuccessModal : @entangle('showSuccessModal'),showOpenCancelModal : @entangle('showOpenCancelModal'),showCancelModal : @entangle('showCancelModal')}">
    <div class="items-center w-full h-full mb-5 space-y-3">
        <section id="header" class="block space-y-5 text-center">
            <h1 class="text-4xl font-extrabold tracking-wider text-blue-600 uppercase">Reports</h1>
           
            <div class="flex w-full px-3 mx-auto text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" wire:click="addMonth(0)"
                    class="w-4 h-auto text-blue-600 rounded-full hover:bg-blue-600 hover:text-white active:ring-2 active:ring-black hover:cursor-pointer"fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                <span class="mx-auto text-3xl"> {{ $currentMonth }} {{ $currentYear }}</span>
               
                    <svg xmlns="http://www.w3.org/2000/svg" wire:click="addMonth(1)"
                        class="w-4 h-auto text-blue-600 rounded-full hover:bg-blue-600 hover:text-white active:ring-2 active:ring-black hover:cursor-pointer" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                
            </div>
        </section>
     
        <div class="grid grid-cols-7 py-5 mx-10 bg-red-100 border-collapse rounded-lg shadow-md shadow-red-100">
            <div class="col-span-1 text-xl font-bold tracking-wide text-center text-white bg-blue-300">
                <span class="m-auto sm:truncate">Sunday </span>
            </div>
            <div class="col-span-1 text-xl font-bold tracking-wide text-center text-white bg-blue-300">
                <span class="m-auto sm:truncate">Monday</span>
            </div>
            <div class="col-span-1 text-xl font-bold tracking-wide text-center text-white bg-blue-300">
                <span class="m-auto sm:truncate">Tuesday</span>
            </div>
            <div class="col-span-1 text-xl font-bold tracking-wide text-center text-white bg-blue-300">
                <span class="m-auto sm:truncate">Wednesday</span>
            </div>
            <div class="col-span-1 text-xl font-bold tracking-wide text-center text-white bg-blue-300">
                <span class="m-auto sm:truncate">Thursday</span>
            </div>
            <div class="col-span-1 text-xl font-bold tracking-wide text-center text-white bg-blue-300">
                <span class="m-auto sm:truncate">Friday</span>
            </div>
            <div class="col-span-1 text-xl font-bold tracking-wide text-center text-white bg-blue-300">
                <span class="m-auto sm:truncate">Saturday</span>
            </div>
            <div class="grid grid-cols-7 col-span-7 mx-3 mt-2">
                @for ($j = 1; $j <= $endDay+$blockSkip; $j++)
                @if ($j <=$blockSkip)
                    <div
                        class="col-span-1 p-5 text-2xl font-bold tracking-wide text-center">
                        <span class="m-auto"></span>
                    </div>
                @else
                @php
                    $key = array_search($j-$blockSkip, array_column($daysWithAppointments, 'date'));
                    $fixx = $j;
                @endphp
                    @if ($key !== false)
                 
                        @if ($daysWithAppointments[$key]['available_slots'] == '0')
                        <div wire:mouseover="getSlots({{ $daysWithAppointments[$key]['adid'] }})" wire:key='{{ $fixx-$blockSkip }}' wire:click="redir({{ $daysWithAppointments[$key]['adid'] }})"
                        class="col-span-1 p-5 m-1 text-3xl font-bold tracking-wide text-center text-black bg-orange-400 rounded-lg shadow-md shadow-slate-500 hover:bg-blue-200 hover:text-blue-600 hover:cursor-pointer sm:text-xs md:text-xl lg:text-2xl">
                        <span class="m-auto">{{ $fixx-$blockSkip }}</span>
                        </div>
                        @else
                        @if ($daysWithAppointments[$key]['type'] == 'first_dose')
                            <div wire:mouseover="getSlots({{ $daysWithAppointments[$key]['adid'] }})" wire:key='{{ $fixx-$blockSkip }}' wire:click="showopencancelModal({{ $daysWithAppointments[$key]['adid'] }})"
                            class="col-span-1 p-5 m-1 text-3xl font-bold tracking-wide text-center text-black rounded-lg shadow-md shadow-slate-500 bg-lime-300 hover:bg-blue-200 hover:text-blue-600 hover:cursor-pointer sm:text-xs md:text-xl lg:text-2xl">
                            <span class="m-auto">{{ $fixx-$blockSkip }}</span>
                            </div>
                        @else
                            <div wire:mouseover="getSlots({{ $daysWithAppointments[$key]['adid'] }})" wire:key='{{ $fixx-$blockSkip }}' wire:click="showopencancelModal({{ $daysWithAppointments[$key]['adid'] }})"
                            class="col-span-1 p-5 m-1 text-3xl font-bold tracking-wide text-center text-black rounded-lg shadow-md shadow-slate-500 bg-cyan-500 hover:bg-blue-200 hover:text-blue-600 hover:cursor-pointer sm:text-xs md:text-xl lg:text-2xl">
                            <span class="m-auto">{{ $fixx-$blockSkip }}</span>
                            </div>
                        @endif
                       
                        @endif
                        
                    @else
                        <div wire:click="showconfirmModal({{ $fixx-$blockSkip }})" wire:key='{{ $fixx-$blockSkip }}' wire:mouseover="getSlots(0)"
                        class="col-span-1 p-5 m-1 text-3xl font-bold tracking-wide text-center text-black bg-red-300 rounded-lg hover:bg-blue-200 hover:text-blue-600 hover:cursor-pointer sm:text-xs md:text-xl lg:text-2xl">
                            <span class="m-auto">{{ $fixx-$blockSkip }}</span>
                        </div>
                    @endif
                
                @endif
            @endfor
            </div>
            
        </div>
        <div class="grid grid-cols-10 grid-rows-4 gap-3 p-5 mx-10 border-collapse rounded-lg">
            <span class="col-span-1 row-start-1 text-lg font-extrabold tracking-wider">Legends:</span>
            <span class="col-span-2 row-start-2 pl-3">Available / <span class="text-cyan-500">Second Dose</span> :</span>
            <span class="col-span-1 col-start-3 row-start-2 shadow-md shadow-lime-400 bg-lime-300"></span>
            <span class="col-span-1 col-start-4 row-start-2 shadow-md shadow-cyan-400 bg-cyan-500"></span>
            <span class="col-span-1 row-start-3 pl-3">Full:</span><span
                class="col-span-1 col-start-2 row-start-3 bg-orange-400 shadow-md shadow-orange-500"></span>
            <span class="col-span-1 row-start-4 pl-3">No Schedule:</span><span
                class="col-span-1 col-start-2 row-start-4 bg-red-300 shadow-md shadow-red-400"></span>

            <span class="col-span-1 col-start-9 row-start-1 text-right">Available Slots:</span>
            <span class="col-span-1 col-start-9 row-start-2 text-right">Occupied Slots:</span>
            <span class="col-span-1 col-start-9 row-start-3 text-right">Total:</span>
            <span class="col-span-1 col-start-9 row-start-4 text-right">Vaccine:</span>
            <span class="col-span-1 col-start-10 row-start-1 text-right">{{ $availableSlots }}</span>
            <span class="col-span-1 col-start-10 row-start-2 text-right">{{ $occupiedSlots }}</span>
            <span class="col-span-1 col-start-10 row-start-3 text-right">{{ $totalSlots }}</span>
            <span class="col-span-1 col-start-10 row-start-4 text-right">{{ $vaccineName }}</span>

        </div>
    </div>
    {{-- //confirm MOdal --}}
    <div class="fixed inset-0 z-10 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" x-cloak
        x-show="showConfirmModal">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">

            <div x-transition-enter="ease-out duration-300" x-transition-enter-start="opacity-0"
                x-transition-enter-end="opacity-100" x-transition-leave="ease-in duration-200"
                x-transition-leave-start="opacity-100" x-transition-leave-end="opacity-0"
                class="fixed inset-0 bg-opacity-75 transition-opacit" aria-hidden="true" x-cloak x-show="showConfirmModal">
            </div>

            <!-- This element is to trick the browser into centering the modal contents. -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div x-transition-enter="ease-out duration-300"
                x-transition-enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition-enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition-leave="ease-in duration-200"
                x-transition-leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition-leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-cloak
                x-show="showConfirmModal" @click.away="showConfirmModal=false"
                class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                <div>
                    <div class="flex items-center justify-center w-12 h-12 mx-auto bg-yellow-100 rounded-full">
                        <!-- Heroicon name: outline/check -->

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-yellow-700" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-5">
                        <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">Confirm Vaccination
                            Schedule</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">Would you like to set up a vaccination schedule for
                                    {{ $day_to_store }} {{ $currentMonth }}, {{ $currentYear }}? Vaccination schedule will have
                                    default slots of 120(max)</p>
                            </div>
                            <div class="items-center block mt-4">
                                <p class="font-bold tracking-wider text-blue-500 text-md">Select Vaccine:</p>
                                <select name="vaccines" id="vaccines" class="w-full px-3 py-1 mx-2 my-1 rounded-lg text-md group hover:cursor-pointer" wire:model="vaccineid">
                                    @foreach ($vaccines as $vaccine)
                                    @if ($loop->index == 0)
                                    <option class="p-1 m-1 text-sm hover:bg-blue-100 group-hover:cursor-pointer" value="{{ $vaccine->id }}">{{ $vaccine->vaccine_name }}</option>   
                                    @else
                                    <option class="p-1 m-1 text-sm hover:bg-blue-100 group-hover:cursor-pointer" value="{{ $vaccine->id }}">{{ $vaccine->vaccine_name }}</option>   
                                    @endif                                     
                                    @endforeach
                                </select>
                            </div>
                    </div>
                </div>
                <div class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
                    <button type="button" wire:click='makeAppointmentSchedule'
                        class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:col-start-2 sm:text-sm">Set
                        Schedule</button>
                    <button type="button" x-on:click="showConfirmModal=false"
                        class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:col-start-1 sm:text-sm">Cancel</button>
                </div>
            </div>
        </div>
    </div>
{{-- success modal --}}
    <div class="fixed inset-0 z-10 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" x-cloak x-show="showSuccessModal">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div x-transition-enter = "ease-out duration-300"
        x-transition-enter-start =  "opacity-0"
        x-transition-enter-end =  "opacity-100"
        x-transition-leave =  "ease-in duration-200"
        x-transition-leave-start =  "opacity-100"
        x-transition-leave-end ="opacity-0"   class="fixed inset-0 transition-opacity bg-opacity-75" aria-hidden="true" x-cloak x-show="showSuccessModal"></div>
    
        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div x-transition-enter = "ease-out duration-300"
        x-transition-enter-start =  "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition-enter-end =  "opacity-100 translate-y-0 sm:scale-100"
        x-transition-leave =  "ease-in duration-200"
        x-transition-leave-start =  "opacity-100 translate-y-0 sm:scale-100"
        x-transition-leave-end = "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"  x-cloak x-show="showSuccessModal" class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-sm sm:w-full sm:p-6">
            <div>
            <div class="flex items-center justify-center w-12 h-12 mx-auto bg-green-100 rounded-full">
                <!-- Heroicon name: outline/check -->
                <svg class="w-6 h-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <div class="mt-3 text-center sm:mt-5">
                <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">Vaccination Schedule Set Up Successful</h3>
                <div class="mt-2">
                <p class="text-sm text-gray-500">Vaccination Schedule for {{ $day_to_store }} {{ $currentMonth }}, {{ $currentYear }} has been set successfully!</p>
                </div>
            </div>
            </div>
            <div class="mt-5 sm:mt-6">
            <a  href="{{ route('dashboard',['adp_id' => 0,'dateSelected' => '0']) }}" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:text-sm">Got it!</a>
            </div>
        </div>
        </div>
    </div>
{{-- open cancel --}}
<div class="fixed inset-0 z-10 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" x-cloak x-show="showOpenCancelModal">
    <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
    <div x-transition-enter = "ease-out duration-300"
    x-transition-enter-start =  "opacity-0"
    x-transition-enter-end =  "opacity-100"
    x-transition-leave =  "ease-in duration-200"
    x-transition-leave-start =  "opacity-100"
    x-transition-leave-end ="opacity-0"   class="fixed inset-0 transition-opacity bg-opacity-75" aria-hidden="true" x-cloak x-show="showOpenCancelModal"></div>

    <!-- This element is to trick the browser into centering the modal contents. -->
    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
    <div x-transition-enter = "ease-out duration-300"
    x-transition-enter-start =  "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
    x-transition-enter-end =  "opacity-100 translate-y-0 sm:scale-100"
    x-transition-leave =  "ease-in duration-200"
    x-transition-leave-start =  "opacity-100 translate-y-0 sm:scale-100"
    x-transition-leave-end = "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showOpenCancelModal=false" x-cloak x-show="showOpenCancelModal" class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-sm sm:w-full sm:p-6">
        <div>
        <div class="flex items-center justify-center w-12 h-12 mx-auto bg-green-100 rounded-full">
        
            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-green-700" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
              </svg>
        </div>
        <div class="mt-3 text-center sm:mt-5">
            <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">What would you like to do?</h3>
            <div class="mt-2">
            <p class="text-sm text-gray-700">Would you like to <strong> open the schedule</strong>? or <strong>cancel the schedule?</strong></p>
            </div>
        </div>
        </div>
        <div class="grid w-full grid-cols-2 gap-2 mt-5 sm:mt-6">
            <button type="button" wire:click='redirectFromOpen' class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-blue-400 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:text-sm">Open Schedule</button>
            <button type="button" wire:click='showcancelModal' class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-red-400 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:text-sm">Cancel Schedule</button>
        </div>
    </div>
    </div>
</div>
{{-- cancel modal--}}
<div class="fixed inset-0 z-10 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" x-cloak x-show="showCancelModal">
    <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
    <div x-transition-enter = "ease-out duration-300"
    x-transition-enter-start =  "opacity-0"
    x-transition-enter-end =  "opacity-100"
    x-transition-leave =  "ease-in duration-200"
    x-transition-leave-start =  "opacity-100"
    x-transition-leave-end ="opacity-0"   class="fixed inset-0 transition-opacity bg-opacity-75" aria-hidden="true" x-cloak x-show="showCancelModal"></div>

    <!-- This element is to trick the browser into centering the modal contents. -->
    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
    <div x-transition-enter = "ease-out duration-300"
    x-transition-enter-start =  "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
    x-transition-enter-end =  "opacity-100 translate-y-0 sm:scale-100"
    x-transition-leave =  "ease-in duration-200"
    x-transition-leave-start =  "opacity-100 translate-y-0 sm:scale-100"
    x-transition-leave-end = "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
     x-cloak x-show="showCancelModal" class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-sm sm:w-full sm:p-6">
        <div>
        <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 rounded-full">
            <!-- Heroicon name: outline/check -->
          
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
              </svg>
        </div>
        <div class="mt-3 text-center sm:mt-5">
            <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">Do you really want to cancel schedule?</h3>
            <div class="mt-2">
            <p class="text-red-500 text-md">This action cannot be undone!</p>
            </div>
        </div>
        </div>
        <div class="grid grid-cols-2 gap-3 mt-5 sm:mt-6">
            <button type="button" wire:click='cancelSchedule' class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-red-400 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:text-sm">Cancel Schedule</button>
            <a href="/" wire:click='$refresh' class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-blue-400 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:text-sm">Exit</a>
        </div>
    </div>
    </div>
</div>

</div>
