<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Task stats
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-5">

        <div class="grid grid-cols-2 sm:grid-cols-1 md:grid-cols-2 ">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mr-2">
                <h3 class="text-gray-900 font-bold text-center mt-4 p-3 border-b border-gray-100">Tasks assigned to each user</h3>
                <div class="p-6 text-gray-900">
                    <div class="relative flex flex-col text-gray-700 bg-white shadow-md w-96 rounded-xl bg-clip-border">
                        <nav class="flex min-w-[240px] flex-col p-2 font-sans text-base font-normal text-blue-gray-700">

                            @foreach($taskUsers as $task)
                                <div role="button" class="flex items-center w-full p-3 leading-tight transition-all rounded-lg outline-none text-start hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900">
                                    {{ $task['name'] }}
                                    <div class="grid ml-auto place-items-center justify-self-end">
                                        <div class="relative grid items-center px-2 py-1 font-sans text-xs font-bold text-gray-900 uppercase rounded-full select-none whitespace-nowrap bg-gray-900/10">
                                            <span class="p-1">{{ $task['tasks_count'] }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </nav>
                    </div>

                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <h3 class="text-gray-900 font-bold text-center mt-4 p-3 border-b border-gray-100">Completed tasks</h3>
                <div class="p-6 text-gray-900">
                    <div class="relative flex flex-col text-gray-700 bg-white shadow-md w-96 rounded-xl bg-clip-border">
                        <nav class="flex min-w-[240px] flex-col p-2 font-sans text-base font-normal text-blue-gray-700">

                            <div role="button" class="flex items-center w-full p-3 leading-tight transition-all rounded-lg outline-none text-start hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900">
                                This Week
                                <div class="grid ml-auto place-items-center justify-self-end">
                                    <div
                                        class="relative grid items-center px-2 py-1 font-sans text-xs font-bold text-gray-900 uppercase rounded-full select-none whitespace-nowrap bg-gray-900/10">
                                        <span class="">{{ $tasks['this_week'] }}</span>
                                    </div>
                                </div>
                            </div>

                            <div role="button" class="flex items-center w-full p-3 leading-tight transition-all rounded-lg outline-none text-start hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900">
                                This Month
                                <div class="grid ml-auto place-items-center justify-self-end">
                                    <div
                                        class="relative grid items-center px-2 py-1 font-sans text-xs font-bold text-gray-900 uppercase rounded-full select-none whitespace-nowrap bg-gray-900/10">
                                        <span class="">{{ $tasks['this_month'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>


        </div>
    </div>


</x-app-layout>
