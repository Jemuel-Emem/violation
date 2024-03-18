<div>
    <x-button label="Add User" dark icon="plus" wire:click="$set('add_modal', true)" />
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
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                       Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                    Password
                     </th>
                     <th scope="col" class="px-6 py-3">
                       User Type
                     </th>

                    {{-- <th scope="col" class="px-6 py-3 text-center">
                        Action
                    </th> --}}
                </tr>
            </thead>
            <tbody>
                  @forelse($user as $User)
                <tr>
                    <td class="px-6 py-4">{{ $User->name }}</td>
                    <td class="px-6 py-4">{{ $User->email }}</td>
                     <td class="px-6 py-4">{{ $User->password }}</td>

                     @if ($User->is_admin=='1')
                     <td class="px-6 py-4">Admin</td>
                     @else
                     <td class="px-6 py-4">User</td>
                     @endif

                    {{-- <td class="px-6 py-4 flex gap-2 mt-4">
                        <x-button class="w-16 h-6" label="edit" icon="pencil-alt" wire:click="edit({{ $User->id }})" positive />
                        <x-button class="w-16 h-6" label="delete" icon="pencil-alt" wire:click="delete({{ $User->id }})" negative />
                    </td> --}}

                </tr>
                @empty
                <tr>
                    <td colspan="10">No data</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <div>
             {{ $user->links() }}
           </div>
    </div>



    <x-modal wire:model.defer="add_modal">
        <x-card title="Add Users">
            <div class="space-y-3">
                <x-input label="Name" placeholder="" wire:model="name" />
                <x-input label="Email" wire:model="email" placeholder="" />
                <x-input label="Password" placeholder="" wire:model="password" />
                <label for="">User Type</label>
                <p class="text-blue-700">If the user is Admin choose 1, if not choose 0</p>
                <select x-model="" class="w-full"  wire:model="is_admin">
                    <option value="" disabled>Select A  User Type</option>
                    <option>1</option>
                    <option>0</option>
                </select>


            </div>

            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close" wire:click="back" />
                    <x-button primary label="Submit" wire:click="submit" spinner="submit" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>


    {{-- <x-modal wire:model.defer="edit_modal">
        <x-card title="Edit Model">
            <div class="space-y-3">
              <div class="flex gap-2">
                <x-input label="Name" wire:model="name" placeholder="" />
                <x-input label="Age" placeholder="" wire:model="age" />
              </div>
                <x-input label="Address" placeholder="" wire:model="address" />
                <x-input label="Contact" placeholder="" wire:model="contact" />
                <x-input label="Number" placeholder="" wire:model="number" />
                <x-input label="Grade" wire:model="grade" placeholder="" />
                <x-input label="Strand and Course" wire:model="strand_course" placeholder="" />
                <x-input label="Section" placeholder="" wire:model="section" />


            </div>

            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close"  wire:click="back"/>
                    <x-button primary label="Submit" wire:click="submitEdit" spinner="submitEdit" />
                </div>
            </x-slot>
        </x-card>
    </x-modal> --}}
</div>

