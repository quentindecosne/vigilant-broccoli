<div class="modal modal-save">
    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="sm:flex sm:items-start">
            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                </svg>     
            </div>
            <div class="mt-3 text-center sm:mt-0  sm:text-left w-12/12">
                <h3 class="text-lg leading-6 font-medium text-gray-900 " id="modal-title">Survey's participants</h3>
                <div class="mt-8 flex flex-col">
                    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                      <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                        <table class="min-w-full divide-y divide-gray-300">
                          <thead>
                            <tr>
                              <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 md:pl-0">Name</th>
                              <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 md:pl-0">Email</th>
                              <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 md:pl-0">Phone</th>

                              <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6 md:pr-0">
                                <span class="sr-only">Remove</span>
                              </th>
                            </tr>
                          </thead>
                          <tbody class="divide-y divide-gray-200">
                            @forelse ($participants as $participant)
                            <tr id="participant-{{ $participant['id'] }}" class="participants">
                              <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 md:pl-0">{{ $participant['name'] }}</td>
                              <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">{{ $participant['email'] }}</td>
                              <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">1122334455</td>
                              <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6 md:pr-0">
                                <button wire:click="deleteParticipant({{ $participant['id'] }})" class="text-red-600 hover:text-red-900">Remove</button>
                              </td>
                            </tr>
                            @empty
                                <tr>
                                <td colspan="4">No participant.</td>
                                </tr>
                            @endforelse
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>
    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
        <button wire:click="save()" class="modal-action-button modal-save-button">Save</button>
        <button wire:click="$emit('closeModal')"  type="button" class="modal-cancel-button">Cancel</button>
    </div>
</div>