<div class="modal modal-save">
    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="sm:flex sm:items-start">
            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                </svg>     
            </div>
            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-10/12">
                <h3 class="text-lg leading-6 font-medium text-gray-900 " id="modal-title">Create new survey</h3>
                <form class="space-y-8 divide-y divide-gray-200">
                    <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5 pt-4">
                        <div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5">

                          <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                            <label for="name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Survey Name </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                              <div class="max-w-lg flex rounded-md shadow-sm">
                                <input wire:model.live="name" type="text" name="name" id="name" autocomplete="name" class="block w-full focus:ring-indigo-500 focus:border-indigo-500 min-w-0 rounded sm:text-sm border-gray-300">
                              </div>
                            </div>
                          </div>

                          <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                            <label for="project" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"> Project </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                              <select wire:model.live="project_id" id="project_id" name="project_id" autocomplete="off" class="max-w-lg block focus:ring-indigo-500 focus:border-indigo-500 w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                                <option value="" >-- Select --</option>
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}" >{{ $project->name }}</option>
                                @endforeach
                              </select>
                              @error('project_id') <span class="error">{{ $message }}</span> @enderror
                            </div>
                          </div>
            
                        </div>
                    </div>
                  </form>
            </div>
        </div>
    </div>
    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
        @if ($survey)
        <button wire:click="edit()" class="modal-action-button modal-save-button">Edit</button>
        @else
          <button wire:click="save()" class="modal-action-button modal-save-button">Save</button>
        @endif      
        <button wire:click="$dispatch('closeModal')"  type="button" class="modal-cancel-button">Cancel</button>
    </div>
</div>