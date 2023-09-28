<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-8">
                <!-- This example requires Tailwind CSS v2.0+ -->
                <div>
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Project Information</h3>
                        {{-- <p class="mt-1 max-w-2xl text-sm text-gray-500">Personal details and application.</p> --}}
                    </div>
                    <div class="mt-5 border-t border-gray-200">
                        <dl class="sm:divide-y sm:divide-gray-200">
                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500">Name</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $project->name }}</dd>
                            </div>
                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500">Address</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $project->address }}</dd>
                            </div>
                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500">Contact</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $project->contact }}</dd>
                            </div>
                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500">Email address</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $project->email }}</dd>
                            </div>
                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500">Phone</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $project->phone }}</dd>
                            </div>
                            
                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 hidden">
                                <dt class="text-sm font-medium text-gray-500">Surveys</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                <ul role="list" class="border border-gray-200 rounded-md divide-y divide-gray-200">
                                    @forelse($project->surveys as $survey)
                                        <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                            <div class="w-0 flex-1 flex items-center">
                                                <!-- Heroicon name: solid/paper-clip -->
                                                <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
                                                </svg>
                                                <span class="ml-2 flex-1 w-0 truncate"> {{ $survey->name }} </span>
                                                <span onclick="Livewire.emit('openModal', 'surveys-participants', {{ json_encode(['survey' => $survey->id]) }})" class="mr-1 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800 cursor-pointer">click to add participant</span>
                                                @forelse($survey->participants as $participant)
                                                    @if(in_array($participant->id, $submitted_surveys))
                                                        <span class="mr-1 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">{{ $participant->name }}</span>
                                                    @else
                                                        <span class="mr-1 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">{{ $participant->name }}</span>
                                                    @endif
                                                @empty
                                                        <span onclick="Livewire.emit('openModal', 'surveys-participants', {{ json_encode(['survey' => $survey->id]) }})" class="mr-1 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-orange-100 text-orange-800"> No participant</span>
                                               @endforelse
                                            </div>
                                            <div class="ml-4 flex-shrink-0">
                                                <a href="{{route('surveys.show', $survey->id )}}" class="font-medium text-indigo-600 hover:text-indigo-500"> View </a>
                                            </div>
                                        </li>
                                    @empty
                                        <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm"><div class="w-0 flex-1 flex items-center"><span class="ml-2 flex-1 w-0 truncate">No survey.</span></div></li>
                                    @endforelse
                                </ul>
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
