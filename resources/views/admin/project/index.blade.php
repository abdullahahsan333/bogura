@extends('layouts.backend')

@section('content')

<div class="w-full">
    <div class="flex items-center justify-between">
        <p class="text-xl pb-3">
            All Projects
        </p>

        <a href="{{ route('admin.project.create') }}" class="w-48 bg-brand-btn text-white font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg flex items-center gap-2 justify-center">
            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 448 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                <path d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path>
            </svg>
            New Project
        </a>
    </div>

    <div class="bg-white overflow-auto mt-3">
        <table class="min-w-full border border-gray-200 leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        SL
                    </th>

                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Employee Info
                    </th>

                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Project Name
                    </th>

                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Project File
                    </th>

                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Status
                    </th>

                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Change Status
                    </th>

                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Action
                    </th>
                </tr>
            </thead>

            <tbody>
                @foreach ($results as $key => $project)
                    @php
                        $status = '';
                        $textclass = '';
                        $bgClass = '';
                        if($project->status == 'active') {
                            $textclass = "text-green-900";
                            $bgClass = "bg-green-200";
                            $status = 'Active';
                        } elseif($project->status == 'inactive') {
                            $textclass = "text-red-900";
                            $bgClass = "bg-red-200";
                            $status = 'Inactive';
                        } else {
                            $textclass = "text-gray-900";
                            $bgClass = "bg-gray-200";
                            $status = 'Hold';
                        }
                    @endphp
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            {{ $key + 1 }}
                        </td>

                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <div class="flex items-center gap-2">
                                <div class="flex-shrink-0 w-10 h-10">
                                    @if (!empty($project->employee->avatar))
                                        <img class="w-full h-full rounded-full" src="{{ asset($project->employee->avatar) }}" alt="" />
                                    @endif
                                </div>
                                <div class="">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ (!empty($project->employee->name) ? strFilter($project->employee->name) : "") }}
                                    </p>
                                </div>
                            </div>
                        </td>

                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="">
                                {{ strFilter($project->name) }}
                            </p>
                        </td>

                        <td>
                            @if (!empty($project->file))
                                <img src="{{ asset($project->file) }}" class="rounded w-14 h-14 cursor" >
                            @endif
                        </td>
                        
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <span
                                class="relative inline-block px-3 py-1 font-semibold {{ $textclass }} leading-tight">
                                <span aria-hidden class="absolute inset-0 {{ $bgClass }} opacity-50 rounded-full"></span>
                                <span class="relative">
                                    {{ $status }}
                                </span>
                            </span>
                        </td>

                        <td>
                            <div class="flex justify-end gap-2">
                                <select id="status" onchange="updateStatusFn({{ $project->id }})" name="status" class="bg-gray-50 px-3 py-2 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-24 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Status</option>
                                    <option value="active" {{ ($project->status == 'active') ? "selected" : "" }}>Active</option>
                                    <option value="inactive" {{ ($project->status == 'inactive') ? "selected" : "" }}>Inactive</option>
                                    <option value="hold" {{ ($project->status == 'hold') ? "selected" : "" }}>Hold</option>
                                </select>
                            </div>
                        </td>

                        <td class="flex justify-end gap-3 px-5 py-5 border-b border-gray-200 bg-white text-sm">

                            <a href="{{ route('admin.project.edit', $project->id) }}" class="flex justify-center gap-3 rounded px-2 py-2 text-white hover:text-black bg-gray-500 hover:bg-gray-400">
                                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path fill="#D9D9D9" d="M761.1 288.3L687.8 215 325.1 577.6l-15.6 89 88.9-15.7z"></path><path d="M880 836H144c-17.7 0-32 14.3-32 32v36c0 4.4 3.6 8 8 8h784c4.4 0 8-3.6 8-8v-36c0-17.7-14.3-32-32-32zm-622.3-84c2 0 4-.2 6-.5L431.9 722c2-.4 3.9-1.3 5.3-2.8l423.9-423.9a9.96 9.96 0 0 0 0-14.1L694.9 114.9c-1.9-1.9-4.4-2.9-7.1-2.9s-5.2 1-7.1 2.9L256.8 538.8c-1.5 1.5-2.4 3.3-2.8 5.3l-29.5 168.2a33.5 33.5 0 0 0 9.4 29.8c6.6 6.4 14.9 9.9 23.8 9.9zm67.4-174.4L687.8 215l73.3 73.3-362.7 362.6-88.9 15.7 15.6-89z"></path></svg>
                                Edit
                            </a>

                            <a href="{{ route('admin.project.delete', $project->id) }}" onclick="return confirm('Do you want to delete this data?')" class="flex justify-center gap-3 rounded px-2 py-2 text-white hover:text-black bg-red-500 hover:bg-red-400">
                                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 448 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M32 464a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V128H32zm272-256a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zM432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16z"></path>
                                </svg>
                                Delete
                            </a>
                              
                        </td>
                    </tr>
                    
                @endforeach
            </tbody>

        </table>
    </div>
</div>


@endsection

@push('footerPartial')
<script>
    // get Upazila list
    function updateStatusFn(id) {
        var _status = $('#status').val();
        $.ajax({
            method: "POST",
            url: "{{route('admin.project.status-update')}}",
            data: {id: id, status: _status, _token: "{{ csrf_token() }}"}
        }).then(function (response) {
            if(response == 'success'){
                location.reload();
            }
        });
    }
</script>
@endpush