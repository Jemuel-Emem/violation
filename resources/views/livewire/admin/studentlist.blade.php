<div>
    <x-button label="Add Student" dark icon="plus" wire:click="$set('add_modal', true)" />
    <div class="flex gap-2 mt-2">
        <x-input label="" placeholder="Search..." wire:model="search" />
    <div>
        <x-button  label="Search " wire:click.prevent="asss" class="bg-green-700 text-white hover:bg-green-900" />
    </div>
    </div>
    <div class="relative overflow-x-auto ">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                       LRN
                    </th>
                <th scope="col" class="px-6 py-3">
                        First Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Middle Initial
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Last Name
                    <th scope="col" class="px-6 py-3">
                        Age
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Sex
                    </th>
                    <th scope="col" class="px-6 py-3">
                       Address
                    </th>
                    <th scope="col" class="px-6 py-3">
                       Contact Number
                    </th>

                    <th scope="col" class="px-6 py-3">
                       Grade
                    </th>
                    <th scope="col" class="px-6 py-3">
                    Strand/Course
                    </th>
                    <th scope="col" class="px-6 py-3">
                      Section
                    </th>

                    <th scope="col" class="px-6 py-3 text-center">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                 @forelse($student as $Student)
                <tr>
                    <td class="px-6 py-4">{{ $Student->lrn }}</td>
                    <td class="px-6 py-4">{{ $Student->firstname }}</td>
                    <td class="px-6 py-4">{{ $Student->middlename }}</td>
                    <td class="px-6 py-4">{{ $Student->lastname }}</td>
                    <td class="px-6 py-4">{{ $Student->age }}</td>
                    <td class="px-6 py-4">{{ $Student->sex }}</td>
                    <td class="px-6 py-4">{{ $Student->address }}</td>
                    <td class="px-6 py-4">{{ $Student->contactnumber }}</td>
                    <td class="px-6 py-4">{{ $Student->grade }}</td>
                    <td class="px-6 py-4">{{ $Student->strand_course }}</td>
                    <td class="px-6 py-4">{{ $Student->section }}</td>
                    <td class="px-6 py-4 flex gap-2 mt-4">
                        <x-button class="w-16 h-6" label="edit" icon="pencil-alt" wire:click="edit({{ $Student->id }})" positive />
                        <x-button class="w-16 h-6" label="delete" icon="pencil-alt" wire:click="delete({{ $Student->id }})" negative />
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="10">No data</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <div>
            {{ $student->links() }}
           </div>
    </div>



    <x-modal wire:model.defer="add_modal">
        <x-card title="Add Student">
            <div class="space-y-3">
                <x-input label="Lrn" wire:model="lrn" placeholder="" />
                <div class="flex gap-2">
                    <x-input label="First Name" wire:model="firstname" placeholder="" />
                    <x-input label="Middle Name" wire:model="middlename" placeholder="" />
                    <x-input label="Last Name" wire:model="lastname" placeholder="" />
                    <x-input label="Age" wire:model="age" placeholder="" />
                </div>
                <x-native-select
    label="Sex"
    placeholder=""
    :options="['N/A','M', 'F']"
    wire:model="sex"
/>

<x-native-select
label="Grade"
placeholder=""
:options="['N/A','11', '12', '1st Year', '2nd Year', '3rd Year', '4th Year']"
wire:model="grade"
/>

                <x-input label="Address" placeholder="" wire:model="address" />
                <x-input label="Contact Number" wire:model="contactnumber" placeholder="" />


                <x-native-select
label="Strand/Course"
placeholder=""
:options="['N/A','ICT', 'HUMSS', 'STEM', 'GAS', 'ABM', 'H.E', 'BSIT', 'BSCS', 'CRIMINILOGY', 'BS PSYCHOLOGY'. 'BSSED']"
wire:model="strand_course"
/>

                <x-input label="Section" wire:model="section" placeholder="" />

            </div>

            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close" wire:click="back" />
                    <x-button primary label="Submit" wire:click="submit" spinner="submit" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>


    <x-modal wire:model.defer="edit_modal">
        <x-card title="Edit Model">
            <div class="space-y-3">
                <x-input label="Lrn" wire:model="lrn" placeholder="" />
                <div class="flex gap-2">
                    <x-input label="First Name" wire:model="firstname" placeholder="" />
                    <x-input label="Middle Name" wire:model="middlename" placeholder="" />
                    <x-input label="Last Name" wire:model="lastname" placeholder="" />
                    <x-input label="Age" wire:model="age" placeholder="" />
                </div>
                <x-native-select
    label="Sex"
    placeholder=""
    :options="['N/A','M', 'F']"
    wire:model="sex"
/>

<x-native-select
label="Grade"
placeholder=""
:options="['N/A','11', '12', '1st Year', '2nd Year', '3rd Year', '4th Year']"
wire:model="grade"
/>

                <x-input label="Address" placeholder="" wire:model="address" />
                <x-input label="Contact Number" wire:model="contactnumber" placeholder="" />

                <x-input label="Grade" placeholder="" wire:model="grade" />
                <x-native-select
label="Strand/Course"
placeholder=""
:options="['N/A','ICT', 'HUMSS', 'STEM', 'GAS', 'ABM', 'H.E', 'BSIT', 'BSCS', 'CRIMINILOGY', 'BS PSYCHOLOGY'. 'BSSED']"
wire:model="strand_course"
/>

                <x-input label="Section" wire:model="section" placeholder="" />
            </div>

            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close"  wire:click="back"/>
                    <x-button primary label="Submit" wire:click="submitEdit" spinner="submitEdit" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>
</div>

