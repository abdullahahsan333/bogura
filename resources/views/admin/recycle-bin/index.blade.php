@extends('layouts.backend')

@section('content')

<div class="w-full">
    <div class="flex items-center justify-between">
        <p class="text-xl pb-3">
            All Recycle Bin
        </p>
    </div>

    <div class="bg-white flex justify-between gap-3 overflow-auto mt-3">
        <table class="w-1/2 border border-gray-200 leading-normal">
            <caption class="text-3xl py-2">Employee List</caption>
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        SL
                    </th>

                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Name
                    </th>

                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Action
                    </th>
                </tr>
            </thead>

            <tbody>
                @foreach ($employeeList as $key => $employee)
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            {{ $key + 1 }}
                        </td>

                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="">
                                {{ (!empty($employee->name) ? strFilter($employee->name) : "") }}
                            </p>
                        </td>

                        <td class="flex justify-end gap-3 px-5 py-5 border-b border-gray-200 bg-white text-sm">

                            <a href="{{ route('admin.employee.restore', $employee->id) }}" onclick="return confirm('Do you want to restore this data?')" class="flex justify-center gap-3 rounded px-2 py-2 text-white hover:text-black bg-red-500 hover:bg-red-400">
                                <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M3.06 13a9 9 0 1 0 .49 -4.087"></path><path d="M3 4.001v5h5"></path><path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path></svg>
                                Restore
                            </a>
                              
                        </td>
                    </tr>
                    
                @endforeach
            </tbody>

        </table>

        <table class="w-1/2 border border-gray-200 leading-normal">
            <caption class="text-3xl py-2">Project List</caption>
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        SL
                    </th>

                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Name
                    </th>

                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Action
                    </th>
                </tr>
            </thead>

            <tbody>
                @foreach ($projectList as $key => $project)
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            {{ $key + 1 }}
                        </td>

                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="">
                                {{ (!empty($project->name) ? strFilter($project->name) : "") }}
                            </p>
                        </td>

                        <td class="flex justify-end gap-3 px-5 py-5 border-b border-gray-200 bg-white text-sm">

                            <a href="{{ route('admin.project.restore', $project->id) }}" onclick="return confirm('Do you want to restore this data?')" class="flex justify-center gap-3 rounded px-2 py-2 text-white hover:text-black bg-red-500 hover:bg-red-400">
                                <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M3.06 13a9 9 0 1 0 .49 -4.087"></path><path d="M3 4.001v5h5"></path><path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path></svg>
                                Restore
                            </a>
                              
                        </td>
                    </tr>
                    
                @endforeach
            </tbody>

        </table>
    </div>

</div>


@endsection
