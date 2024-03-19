<div>

    <x-button label="Add Violation" dark icon="plus" wire:click="$set('add_modal', true)" />
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
                        Lrn
                    </th>
                    <th scope="col" class="px-6 py-3">
                        First Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Middle Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Last Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Sex
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Grade
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Strand
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Section
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Violation
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Sanction
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Offence
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Date and Time
                    </th>

                    <th scope="col" class="px-6 py-3 text-center">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($violations as $violation)
                <tr>
                    <td class="px-6 py-4">{{ $violation->lrn }}</td>
                    <td class="px-6 py-4">{{ $violation->firstname }}</td>
                    <td class="px-6 py-4">{{ $violation->middlename }}</td>
                    <td class="px-6 py-4">{{ $violation->lastname }}</td>
                    <td class="px-6 py-4">{{ $violation->sex}}</td>
                    <td class="px-6 py-4">{{ $violation->grade }}</td>
                    <td class="px-6 py-4">{{ $violation->strand }}</td>
                    <td class="px-6 py-4">{{ $violation->section }}</td>
                    <td class="px-6 py-4">{{ $violation->violation }}</td>
                    @if ( $violation->offence >= 3)
                        <td class="px-6 py-4 text-red-700 ">{{ $violation->sanction }}</td>
                    @else
                    <td class="px-6 py-4">{{ $violation->sanction }}</td>
                    @endif
                    <td class="px-6 py-4">{{ $violation->offence }}</td>
                    <td class="px-6 py-4">{{ $violation->date_and_time }}</td>

                    <td class="px-6 py-4 flex gap-2 mt-4">
                        <x-button class="w-16 h-6 space-y-2" label="edit" icon="pencil-alt" wire:click="edit({{ $violation->id }})" positive />
                        <x-button class="w-16 h-6 space-y-2" label="delete" icon="pencil-alt" wire:click="delete({{ $violation->id }})" negative />
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
        {{ $violations->links() }}
       </div>
    </div>



    <x-modal wire:model.defer="add_modal">
        <x-card title="Add Modal">
            <div class="space-y-3">
                <div class="flex gap-2">
    <x-input label="Lrn" wire:model="lrn" placeholder="" autocomplete="off" wire:keyup="searchStudents" />
    <x-input label="First Name" wire:model="firstname" placeholder="" autocomplete="off" wire:keyup="searchStudents" />


    @if(count($students) > 0)
    <div class="absolute z-50 mt-2 bg-white border border-gray-300 rounded-md shadow-md w-48">
        @foreach($students as $student)
            <div class="py-1 px-2 cursor-pointer hover:bg-gray-200" wire:click="fillName('{{ $student->lrn }}','{{ $student->firstname }}','{{ $student->middlename }}','{{ $student->lastname }}','{{ $student->sex }}', '{{ $student->grade }}', '{{ $student->strand_course }}','{{ $student->section}}')">
                {{ $student->lrn }}
            </div>
        @endforeach
    </div>
@endif
                <x-input label="Middle Name" wire:model="middlename" placeholder="" />
                </div>

                <div class="flex gap-2">
                    <x-input label="Last Name" wire:model="lastname" placeholder="" />
                    <x-input label="Sex" wire:model="sex" placeholder="" />
                    <x-input label="Grade" wire:model="grade" placeholder="" />
                </div>
                <x-input label="Strand" placeholder="" wire:model="strand" />
                <x-input label="Section" wire:model="section" placeholder="" />
                <x-input label="violation" placeholder="" wire:model="violation" />
                <x-input label="sanction" placeholder="" wire:model="sanction" />
                <x-input label="Offence" wire:model="offence" placeholder="" />
                <x-input label="Date and Time" wire:model="date_and_time" placeholder="" />

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
              <div class="flex gap-2">
                <x-input label="Lrn" wire:model="lrn" placeholder="" />
                <x-input label="First Name" placeholder="" wire:model="firstname" />
              </div>
              <div class="flex gap-2">
                <x-input label="Middle Name" wire:model="middlename" placeholder="" />
                <x-input label="Last Name" placeholder="" wire:model="lastname" />
              </div>
              <div class="flex gap-2">
                <x-input label="Sex" wire:model="sex" placeholder="" />
                <x-input label="Grade" placeholder="" wire:model="grade" />
              </div>
                <x-input label="Strand" placeholder="" wire:model="strand" />
                <x-input label="Section" placeholder="" wire:model="section" />
                <x-input label="Violation" placeholder="" wire:model="violation" />
                <x-input label="Sanction" wire:model="sanction" placeholder="" />
                <x-input label="Offence" wire:model="offence" placeholder="" />
                <x-input label="Date and Time" placeholder="" wire:model="date_and_time" />
                <td class="px-6 py-4">
                    {{-- {{Storage::url($violation->photo)}} --}}


                </td>

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
