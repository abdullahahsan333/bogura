@extends('layouts.backend')

@section('content')

<div class="w-full">
    <div class="flex items-center justify-between">
        <p class="text-xl pb-3">
            Edit Employee
        </p>

        <a href="{{ route('admin.employees') }}" class="w-48 text-white bg-brand-btn font-semibold py-2 rounded-br-lg rounded-bl-lg rounded-tr-lg flex items-center gap-2 justify-center">
            <i class="fas fa-list mr-3"></i>
            All Employees
        </a>
    </div>

    <div class="bg-white overflow-auto mt-3">
        <form action="{{ route('admin.employee.update') }}" method="POST" enctype="multipart/form-data" class="p-10 bg-white rounded shadow-xl">
            @csrf

            <input type="hidden" hidden name="id" value="{{ $info->id }}">

            <div class="leading-loose">

                <div class="mt-2">
                    <label class="mb-4 block text-sm text-gray-600" for="name">Name <span class="req">*</span></label>
                    <input class="w-full px-5 py-4 text-gray-700 bg-gray-200 rounded" autocorrect="off" spellcheck="false" autocomplete="off"
                        id="name" name="name" type="text" value="{{ $info->name }}" required="" placeholder="Your Name" aria-label="Name">
                </div>

                <div class="mt-2">
                    <label class="mb-4 block text-sm text-gray-600" for="email">Email</label>
                    <input class="w-full px-5 py-4 text-gray-700 bg-gray-200 rounded" autocorrect="off" spellcheck="false" autocomplete="off"
                        id="email" name="email" type="text" value="{{ (!empty($info->email) ? $info->email : "") }}" placeholder="Your Email" aria-label="Email">
                </div>
                
                <div class="mt-2">
                    <label class="mb-4 block text-sm text-gray-600" for="mobile">Mobile</label>
                    <input class="w-full px-5 py-4 text-gray-700 bg-gray-200 rounded" autocorrect="off" spellcheck="false" autocomplete="off"
                        id="mobile" name="mobile" type="text" value="{{ (!empty($info->mobile) ? $info->mobile : "") }}" placeholder="Your Mobile" aria-label="Email">
                </div>

                <div class="mt-2">
                    <label class="mb-4  block text-sm text-gray-600" for="address">Address</label>
                    <textarea class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded" autocorrect="off" spellcheck="false" autocomplete="off"
                        id="address" name="address" rows="3" placeholder="Your Address" aria-label="Address">{{ (!empty($info->address) ? $info->address : "") }}</textarea>
                </div>

                <div class="mt-2">
                    <label for="avatar" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload Avatar</label>
                    @if (!empty($info->avatar))
                        <div class="image mb-2">
                            <img src="{{ asset($info->avatar) }}" class="rounded mt-1 w-14 h-14 cursor" alt="About us image" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="About us image">
                        </div>
                    @else
                        <div class="image mb-2"></div>
                    @endif
                    <input id="avatar" name="avatar" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file">
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
<style>
    #displayImage {
        height: 320px;
        border: 1px solid #E5E7EB;
        background-size: cover !important;
        background-repeat: no-repeat !important;
        background: #d8d8d860;
    }
    .req {
        color: red;
    }
</style>
@endpush

@push('footerPartial')
<script>
    //   Display Blog Thumbnail
    const imageUrl = "{{ (!empty($info->avatar) ? asset($info->avatar) : asset('assets/images/user.webp')) }}";
    document.getElementById('displayImage').style.backgroundImage = 'url(' + imageUrl + ')';

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('displayImage').style.backgroundImage = 'url(' + e.target.result + ')';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    document.getElementById("featuredImage").addEventListener("change", function () {
        readURL(this);
    });
</script>
@endpush