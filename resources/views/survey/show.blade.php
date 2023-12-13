<x-app-layout>
    <div class="py-12">
        <div class="max-w-9xxl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-8">
                <!-- This example requires Tailwind CSS v2.0+ -->
                <div>
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Survey Information</h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">Survey details and results.</p>
                    </div>
                    <div class="mt-5 border-t border-gray-200">
                        <dl class="sm:divide-y sm:divide-gray-200">
                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500">Project name</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 flex">
                                    {{ $survey->project->name }}
                                    <a href="{{ route('projects.show', $survey->project->id)}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="ml-2 w-4 h-4 ">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                    </svg>
                                  </a>
                                </dd>
                            </div>
                             <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500">Survey name</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $survey->name }}</dd>
                            </div>
                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500">Creation date</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ \Carbon\Carbon::parse($survey->created_at)->format('d/m/Y') }} ({{ \Carbon\Carbon::parse($survey->created_at)->diffInDays(\Carbon\Carbon::now())}} days ago)</dd>
                            </div>
                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 hidden">
                                <dt class="text-sm font-medium text-gray-500">Participants</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                <ul role="list" class="border border-gray-200 rounded-md divide-y divide-gray-200">
                                    @forelse($survey->participants as $participant)
                                        <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                            <div class="w-0 flex-1 flex items-center">
                                                <span class="ml-1 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">   {{ $participant->name }}</span>
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
        <div class="mt-4 max-w-9xl mx-auto sm:px-6 lg:px-8">



            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-8">


                <div class="">
                    <div class="sm:flex sm:items-center">
                      <div class="sm:flex-auto">
                        <h3  class="text-lg leading-6 font-medium text-gray-900">Results</h3>
                        <p class="mt-2 text-sm text-gray-700">A list of all the plants for the survey per participants.</p>
                      </div>
                    </div>
                     <div class="mt-8 flex flex-col ">
                       <livewire:survey-master-table survey="{{$survey->id}}"/>
                     </div>
                  </div>
          </div>

        </div>
    </div>
</x-app-layout>
