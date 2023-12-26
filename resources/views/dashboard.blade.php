<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <h1 class="text-3xl font-bold underline">
            Hello world!
          </h1>
    </x-slot> --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">Overview</h3>
                <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">
                    <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                    <dt class="text-sm font-medium text-gray-500 truncate">Projects</dt>
                    <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ $projects }}</dd>
                    </div>

                    <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                    <dt class="text-sm font-medium text-gray-500 truncate">Surveys</dt>
                    <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ $surveys }}</dd>
                    </div>

                    <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                    <dt class="text-sm font-medium text-gray-500 truncate">Plants</dt>
                    <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ $plants }}</dd>
                    </div>
                </dl>
            </div>

            <div class="pt-8">
               <h3 class="mx-auto mt-8 text-lg leading-6 font-medium text-gray-900">Recent activity</h3>
               <table class="min-w-full divide-y divide-gray-200 mt-5 ">
                <thead>
                    <tr>
                      <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                      {{-- <th class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">User</th> --}}
                      <th class="hidden px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider md:block">Status</th>
                      <th class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($activity as $log)
                    <tr class="bg-white">
                      <td class="max-w-0 w-full px-6 py-4 whitespace-nowrap text-sm text-gray-900">

                            <div class="flex">
                                @if (isset($log->properties['project_id']))
                                    <a href="{{ route('projects.show', $log->properties['project_id']) }}" class="group inline-flex space-x-2 truncate text-sm">
                                        <svg class="flex-shrink-0 h-5 w-5 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                        </svg>
                                        <p class="text-gray-500 truncate group-hover:text-gray-900">{{ $log->description}}</p>
                                    </a>
                                @elseif (isset($log->properties['survey_id']))
                                    <a href="{{ route('surveys.show', $log->properties['survey_id']) }}" class="group inline-flex space-x-2 truncate text-sm">
                                        <svg class="flex-shrink-0 h-5 w-5 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                        </svg>
                                        <p class="text-gray-500 truncate group-hover:text-gray-900">{{ $log->description}}</p>
                                    </a>
                                @else
                                    <p class="text-gray-500 truncate group-hover:text-gray-900">{{ $log->description}}</p>
                                @endif
                            </div>

                      </td>
                      {{-- <td class="px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500">
                        <span class="text-gray-900 font-medium">{{ $log->causer->name }}</span>
                      </td> --}}
                      <td class="hidden px-6 py-4 whitespace-nowrap text-sm text-gray-500 md:block">
                        @if ($log->event == "success")
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 capitalize"> success </span>
                        @elseif ($log->event == "warning")
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800 capitalize"> warning </span>
                        @elseif ($log->event == "error")
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 capitalize"> delete </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 capitalize"> info </span>
                        @endif
                    </td>
                      <td class="px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500">
                        <time datetime="2020-07-11">{{ Carbon\Carbon::parse($log->created_at)->toFormattedDayDateString() }}</time>
                      </td>
                    </tr>
                    @endforeach
                    <!-- More transactions... -->
                  </tbody>
               </table>
            </div>
            <div class="mt-4">
                 <x-mapbox
                id="map"
                position="relative"
                class="w-12"
                style="height: 500px;"
    {{--            mapStyle="mapbox/navigation-night-v1"--}}
                :zoom="8"
                :center="['long' => 79.80698481268966,'lat' => 11.986645190074816]"
                :navigationControls="true"
                geocoderPosition="top-left"
                :markers="[['long' => 79.80698481268966,'lat' => 11.986645190074816,'description' => 'Auroville Botanical Gardens'], ['long' => 9, 'lat' => 10]]" />
            </div>
        </div>
    </div>


</x-app-layout>
