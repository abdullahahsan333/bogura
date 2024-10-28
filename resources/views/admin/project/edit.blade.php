@extends('layouts.backend')

@section('content')

<div class="w-full">
    <div class="flex items-center justify-between">
        <p class="text-xl pb-3">
            Edit Project
        </p>

        <a href="{{ route('admin.projects') }}" class="w-48 text-white bg-brand-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg flex items-center gap-2 justify-center">
            <i class="fas fa-list mr-3"></i>
            All Projects
        </a>
    </div>

    <div class="bg-white overflow-auto mt-3">
        <form action="{{ route('admin.project.update') }}" method="POST" enctype="multipart/form-data" class="p-10 bg-white rounded shadow-xl">
            @csrf

            <input type="hidden" hidden name="id" value="{{ $info->id }}">

            <div class="leading-loose">

                <div class="mt-2">
                    <label class="mb-4 block text-sm text-gray-600" for="name">Project Name<span class="req">*</span></label>
                    <input class="w-full px-5 py-4 text-gray-700 bg-gray-200 rounded" autocorrect="off" spellcheck="false" autocomplete="off"
                        id="name" name="name" type="text" required="" value="{{ $info->name }}" placeholder="Project Name" aria-label="Name">
                </div>

                <div class="mt-2">
                    <label class="mb-4  block text-sm text-gray-600" for="description">Description</label>
                    <textarea class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded" autocorrect="off" spellcheck="false" autocomplete="off"
                        id="description" name="description" rows="4" required="" placeholder="Description" aria-label="Description">{{ (!empty($info->description) ? $info->description : "") }}</textarea>
                </div>

                <div class="mt-2">
                    <label for="empId" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Employee</label>
                    <select id="empId" name="emp_id" class="employeeList w-full">
                        <option selected>Select Employee</option>
                        @if (!empty($employeeList))
                        @foreach ($employeeList as $employee)
                            <option value="{{ $employee->id }}" {{ ($info->emp_id == $employee->id) ? "selected" : "" }}>{{ strFilter($employee->name) }}</option>
                        @endforeach
                        @endif
                    </select>
                </div>

                <div class="mt-2">
                    <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Status</label>
                    <select id="status" name="status" class="bg-gray-50 px-5 py-4 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Select Status</option>
                        <option value="active" {{ ($info->status == "active") ? "selected" : "" }} >Active</option>
                        <option value="inactive" {{ ($info->status == "inactive") ? "selected" : "" }} >Inactive</option>
                        <option value="hold" {{ ($info->status == "hold") ? "selected" : "" }} >Hold</option>
                    </select>
                </div>

                <div class="mt-2">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">File Upload</label>
                    @if (!empty($info->file))
                        <div class="image mb-2">
                            <img src="{{ asset($info->file) }}" class="rounded mt-1 w-14 h-14 cursor" alt="About us image" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="About us image">
                        </div>
                    @endif

                    <div class="upload-container relative flex items-center justify-between w-full">
                        <div class="drop-area w-full rounded-md border-2 border-dotted border-gray-200 transition-all hover:border-blue-600/30 text-center">
                            <label for="file-input" class="block w-full h-full text-gray-500 p-4 text-sm cursor-pointer">
                                Drop your image here or click to browse
                            </label>
                            <input name="file" type="file" id="file-input" accept="image/*" class="hidden" />
                            <div class="preview-container hidden items-center justify-center flex-col">
                                <div class="preview-image w-36 h-36 bg-cover bg-center rounded-md"></div>
                                <span class="file-name my-4 text-sm font-medium"></span>
                                <p class="close-button cursor-pointer transition-all mb-4 rounded-md px-3 py-1 border text-xs text-red-500 border-red-500 hover:bg-red-500 hover:text-white">Delete</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <button class="px-4 py-1 text-white font-light bg-brand-btn rounded" type="submit">Update</button>
                </div>
            </div>
            

        </form>
    </div>
</div>


@endsection


@push('headerPartial')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    .drop-area.active {
        border-color: #2563eb;
    }
    .select2-container .select2-selection--single,
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        height: 58px !important;
        line-height: 58px !important;
        padding-left: 12px;
    }
</style>
@endpush

@push('footerPartial')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.employeeList').select2();
        });


        const dropArea = document.querySelector('.drop-area');
        const fileInput = document.querySelector('#file-input');
        const previewContainer = document.querySelector('.preview-container');
        const previewImage = document.querySelector('.preview-image');
        const closeButton = document.querySelector('.close-button');
        const fileName = document.querySelector('.file-name');

        dropArea.addEventListener('dragover', (event) => {
            event.preventDefault();
            dropArea.classList.add('active');
        });
        
        dropArea.addEventListener('dragleave', () => {
            dropArea.classList.remove('active');
        });
        
        dropArea.addEventListener('drop', (event) => {
            event.preventDefault();
            const file = event.dataTransfer.files[0];
            showPreview(file);
            showFileName(file);
        });

        fileInput.addEventListener('change', () => {
            const file = fileInput.files[0];
            showPreview(file);
            showFileName(file);
        });

        closeButton.addEventListener('click', (event) => {
            event.preventDefault();
            fileInput.value = '';
            previewImage.style.backgroundImage = '';
            fileName.textContent = '';
            previewImage.classList.add('hidden');
            previewContainer.classList.add('hidden');
            previewImage.classList.remove('flex');
        });
        
        function showPreview(file) {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = () => {
                    previewImage.style.backgroundImage = `url(${reader.result})`;
                    previewImage.classList.remove('hidden');
                    dropArea.classList.remove('active');
                    previewContainer.classList.remove('hidden');
                    previewContainer.classList.add('flex');
                };
            }
        }
        
        function showFileName(file) {
            fileName.textContent = file.name;
            fileName.style.display = 'block';
        }
        // Refarance From: https://codepen.io/umurkose/pen/poxPbej
    </script>
@endpush