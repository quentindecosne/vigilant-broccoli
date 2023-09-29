<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                                                {{ $participant->name }}
                                                @if ($participant->id == 1)
                                                    <span class="ml-1 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">submitted</span>
                                                @else
                                                    <span class="ml-1 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-indigo-100 text-indigo-800">pending</span>
                                                @endif
                                            </div>
                                            {{-- <div class="ml-4 flex-shrink-0">
                                                <a href="{{route('surveys.show', $survey->id )}}" class="font-medium text-indigo-600 hover:text-indigo-500"> View </a>
                                            </div> --}}
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
        <div class="mt-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-8">

          
                <div class="">
                    <div class="sm:flex sm:items-center">
                      <div class="sm:flex-auto">
                        <h3  class="text-lg leading-6 font-medium text-gray-900">Results</h3>
                        <p class="mt-2 text-sm text-gray-700">A list of all the plants for the survey per participants.</p>
                      </div>
                      <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                        {{-- <button type="button" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">Add user</button> --}}
                      </div>
                    </div>
                    <div class="mt-8 flex flex-col">
                      <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                          <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300 stripped">
                              <thead class="bg-gray-50">
                                <tr>
                                  {{-- <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">ID</th> --}}
                                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Family name</th>
                                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Botanical Name</th>
                                  <th colspan="{{$survey->participants->count()}}" scope="col" class="text-center px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Number present</th>
                                  <th colspan="{{$survey->participants->count()}}"  scope="col" class="text-center px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Occurence</th>
                                  <th colspan="{{$survey->participants->count()}}"  scope="col" class="text-center px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Regeneration</th>
                                  {{-- <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                    <span class="sr-only">Edit</span>
                                  </th> --}}
                                </tr>
                              </thead>
                              <tbody class="divide-y divide-gray-200 bg-white">
                                <tr class="bg-gray-50">
                                    <td colspan="2">&nbsp;</td>
                                    @foreach($survey->participants as $participant)
                                        <td class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">{{$participant->name}}</td>
                                    @endforeach
                                    @foreach($survey->participants as $participant)
                                        <td class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">{{$participant->name}}</td>
                                    @endforeach
                                    @foreach($survey->participants as $participant)
                                        <td class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">{{$participant->name}}</td>
                                    @endforeach
                                </tr>
                                {{-- @dd($survey_results) --}}
                                @foreach($survey_results as $result)
                                <tr class="divide-x">
                                  {{-- <td class=" whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ $result['id'] }}</td> --}}
                                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $result['family_name'] }}</td>
                                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $result['botanical_name'] }}</td>
                                @foreach($result['number_present'] as $number_present)
                                    <td class=" whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $number_present }}</td>
                                @endforeach
                                @foreach($result['occurrence'] as $occurrence)
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $occurrence }}</td>
                                @endforeach
                                @foreach($result['regeneration'] as $regeneration)
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $regeneration }}</td>
                                 @endforeach
                            
                                  {{-- <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit<span class="sr-only">, Lindsay Walton</span></a>
                                  </td> --}}
                                </tr>
                                @endforeach
                                <!-- More people... -->
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
          </div>
         
        </div>
    </div>
</x-app-layout>
