<div class="modal modal-save">
    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="sm:flex sm:items-start">
            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                </svg>     
            </div>
            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-10/12">
                <h3 class="text-lg leading-6 font-medium text-gray-900 " id="modal-title">Create new project</h3>
                <form class="space-y-8 divide-y divide-gray-200">
                    <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5 pt-4">
                        <div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5">

                          <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                            <label for="name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Project Name </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                              <div class="max-w-lg flex rounded-md shadow-sm">
                                <input wire:model="name" type="text" name="name" id="name" autocomplete="name" class="block w-full focus:ring-indigo-500 focus:border-indigo-500 min-w-0 rounded sm:text-sm border-gray-300">
                              </div>
                            </div>
                          </div>

                          <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                            <label for="contact_name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"> Contact name </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                              <div class="max-w-lg flex rounded-md shadow-sm">
                                <input wire:model="contact" type="text" name="contact_name" id="contact_name" autocomplete="contact_name" class="flex-1 block w-full focus:ring-indigo-500 focus:border-indigo-500 min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300">
                              </div>
                            </div>
                          </div>
                  
                          <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                            <label for="address" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"> Address </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                              <div class="max-w-lg flex rounded-md shadow-sm">
                                <input wire:model="address" type="text" name="address" id="address" autocomplete="address" class="flex-1 block w-full focus:ring-indigo-500 focus:border-indigo-500 min-w-0 rounded sm:text-sm border-gray-300">
                              </div>
                            </div>
                          </div>
                               
                          <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                            <label for="email_address" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"> Email address </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                              <div class="max-w-lg flex rounded-md shadow-sm">
                                <input wire:model="email" type="email" name="email_address" id="email_address" autocomplete="email_address" class="flex-1 block w-full focus:ring-indigo-500 focus:border-indigo-500 min-w-0 rounded sm:text-sm border-gray-300">
                              </div>
                            </div>
                          </div>

                          <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                            <label for="phone" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"> Phone </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                              <div class="max-w-lg flex rounded-md shadow-sm">
                                <input wire:model="phone" type="text" name="phone" id="phone" autocomplete="phone" class="flex-1 block w-full focus:ring-indigo-500 focus:border-indigo-500 min-w-0 rounded sm:text-sm border-gray-300">
                              </div>
                            </div>
                          </div>

                        </div>
                    </div>
                  </form>
            </div>
        </div>
    </div>
    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
        @if ($project)
        <button wire:click="edit()" class="modal-action-button modal-save-button">Edit</button>
        @else
          <button wire:click="save()" class="modal-action-button modal-save-button">Save</button>
        @endif      
        <button wire:click="$emit('closeModal')"  type="button" class="modal-cancel-button">Cancel</button>
    </div>
</div>