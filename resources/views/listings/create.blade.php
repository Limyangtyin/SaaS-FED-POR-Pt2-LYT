<x-app-layout>
    <article class="container mx-auto max-w-7xl">
        <header
            class="py-4 bg-gray-600 text-gray-200 px-4 rounded-t-lg mb-4 flex flex-row justify-between items-center">
            <div>
                <h2 class="text-3xl font-semibold">Management Area</h2>
                <h3 class="text-2xl">Add Listing</h3>
            </div>
            <i class="fa fa-user-plus text-5xl"></i>
        </header>

        @if(Session::has('success'))
            <section id="Messages" class="my-4 px-4">
                <div class="p-4 border-green-500 bg-green-100 text-green-700 rounded-lg">
                    {{Session::get('success')}}
                </div>
            </section>
        @endif

        @if($errors->count()>0)
            <section class="bg-red-200 text-red-800 mx-4 my-2 px-4 py-2 flex flex-col gap-1 rounded border-red-600">
                <p>We have noted some data entry issues, please update and resubmit.</p>
                                @foreach($errors->all() as $error)
                                    <p class="text-sm">{{ $error }}</p>
                                @endforeach
            </section>
        @endif

        <section class="p-4 ">
            <form action="{{ route('listings.store') }}"
                  method="POST"
                  class="max-w-3xl flex flex-col gap-4">

                @csrf

                <fieldset class="grid grid-cols-7">
                    <label class="text-gray-500 col-span-2"
                           for="Title">Title:</label>
                    <input type="text"
                           id="Title"
                           name="title"
                           value="{{ old('title') }}"
                           placeholder="Enter Job Title"
                           class="border-gray-200 col-span-5">
                    @error("title")
                    <span class="text-gray-500 col-span-2"></span>
                    <p class="small text-red-500 col-span-5 text-sm">{{ $message }}</p>
                    @enderror
                </fieldset>

                <fieldset class="grid grid-cols-7">
                    <label class="text-gray-500 col-span-2"
                           for="Description">Description:</label>
                    <input type="text"
                           id="Description"
                           name="description"
                           value="{{ old('description') }}"
                           placeholder="Enter Job Description"
                           class="border-gray-200 col-span-5">
                    @error("description")
                    <span class="text-gray-500 col-span-2"></span>
                    <p class="small text-red-500 col-span-5 text-sm">{{ $message }}</p>
                    @enderror
                </fieldset>

                <fieldset class="grid grid-cols-7">
                    <label class="text-gray-500 col-span-2"
                           for="Salary">Salary:</label>
                    <input type="text"
                           id="Salary"
                           name="salary"
                           value="{{ old('salary') }}"
                           placeholder="Enter Salary"
                           class="border-gray-200 col-span-5">
                    @error("salary")
                    <span class="text-gray-500 col-span-2"></span>
                    <p class="small text-red-500 col-span-5 text-sm">{{ $message }}</p>
                    @enderror
                </fieldset>

                <fieldset class="grid grid-cols-7">
                    <label class="text-gray-500 col-span-2"
                           for="City">City:</label>
                    <input type="text"
                           id="City"
                           name="city"
                           value="{{ old('city') }}"
                           placeholder="Enter City"
                           class="border-gray-200 col-span-5">
                    @error("city")
                    <span class="text-gray-500 col-span-2"></span>
                    <p class="small text-red-500 col-span-5 text-sm">{{ $message }}</p>
                    @enderror
                </fieldset>

                <fieldset class="grid grid-cols-7">
                    <label class="text-gray-500 col-span-2"
                           for="State">State:</label>
                    <input type="text"
                           id="State"
                           name="state"
                           value="{{ old('state') }}"
                           placeholder="Enter State"
                           class="border-gray-200 col-span-5">
                    @error("state")
                    <span class="text-gray-500 col-span-2"></span>
                    <p class="small text-red-500 col-span-5 text-sm">{{ $message }}</p>
                    @enderror
                </fieldset>

                <fieldset class="grid grid-cols-7">
                    <label class="text-gray-500 col-span-2"
                           for="Tags">Tags:</label>
                    <input type="text"
                           id="Tags"
                           name="tags[]"
                           value="{{ old('tags') }}"
                           placeholder="Enter Tags"
                           class="border-gray-200 col-span-5">
                    @error("tags")
                    <span class="text-gray-500 col-span-2"></span>
                    <p class="small text-red-500 col-span-5 text-sm">{{ $message }}</p>
                    @enderror
                </fieldset>


                <fieldset class="grid grid-cols-7">
                    <label class="text-gray-500 col-span-2"
                           for="Company">Company:</label>
                    <input type="text"
                           id="Company"
                           name="company"
                           value="{{ old('company') }}"
                           placeholder="Enter Company"
                           class="border-gray-200 col-span-5">
                    @error("company")
                    <span class="text-gray-500 col-span-2"></span>
                    <p class="small text-red-500 col-span-5 text-sm">{{ $message }}</p>
                    @enderror
                </fieldset>

                <fieldset class="grid grid-cols-7">
                    <label class="text-gray-500 col-span-2"
                           for="Address">Address:</label>
                    <input type="text"
                           id="Address"
                           name="address"
                           value="{{ old('address') }}"
                           placeholder="Enter Address"
                           class="border-gray-200 col-span-5">
                    @error("address")
                    <span class="text-gray-500 col-span-2"></span>
                    <p class="small text-red-500 col-span-5 text-sm">{{ $message }}</p>
                    @enderror
                </fieldset>

                <fieldset class="grid grid-cols-7">
                    <label class="text-gray-500 col-span-2"
                           for="Phone">Phone:</label>
                    <input type="text"
                           id="Phone"
                           name="phone"
                           value="{{ old('phone') }}"
                           placeholder="Enter Phone"
                           class="border-gray-200 col-span-5">
                    @error("phone")
                    <span class="text-gray-500 col-span-2"></span>
                    <p class="small text-red-500 col-span-5 text-sm">{{ $message }}</p>
                    @enderror
                </fieldset>

                <fieldset class="grid grid-cols-7">
                    <label class="text-gray-500 col-span-2"
                           for="Email">Email:</label>
                    <input type="text"
                           id="Email"
                           name="email"
                           value="{{ old('email') }}"
                           placeholder="Enter Email"
                           class="border-gray-200 col-span-5">
                    @error("email")
                    <span class="text-gray-500 col-span-2"></span>
                    <p class="small text-red-500 col-span-5 text-sm">{{ $message }}</p>
                    @enderror
                </fieldset>

                <fieldset class="grid grid-cols-7">
                    <label class="text-gray-500 col-span-2"
                           for="Requirements">Requirements:</label>
                    <input type="text"
                           id="Requirements"
                           name="requirements"
                           value="{{ old('requirements') }}"
                           placeholder="Enter Requirements"
                           class="border-gray-200 col-span-5">
                    @error("requirements")
                    <span class="text-gray-500 col-span-2"></span>
                    <p class="small text-red-500 col-span-5 text-sm">{{ $message }}</p>
                    @enderror
                </fieldset>

                <fieldset class="grid grid-cols-7">
                    <label class="text-gray-500 col-span-2"
                           for="Benefits">Benefits:</label>
                    <input type="text"
                           id="Benefits"
                           name="benefits"
                           value="{{ old('benefits') }}"
                           placeholder="Enter Benefits"
                           class="border-gray-200 col-span-5">
                    @error("benefits")
                    <span class="text-gray-500 col-span-2"></span>
                    <p class="small text-red-500 col-span-5 text-sm">{{ $message }}</p>
                    @enderror
                </fieldset>

                <fieldset class="grid grid-cols-7">
                    <label class="text-gray-500 col-span-2"
                           for="">Actions</label>
                    <p class="col-span-5 flex gap-4">
                        <button type="submit"
                                class="p-2 px-4 text-center rounded-md
                                      text-green-600 hover:text-green-200 dark:hover:text-black bg-green-200 dark:bg-black hover:bg-green-500
                                      duration-300 ease-in-out transition-all">
                            <i class="fa fa-save text-lg"></i>
                            {{ __('Save Listing') }}
                        </button>
                        <a href="{{ route('listings.index') }}"
                           class="p-2 px-4 text-center rounded-md
                                      text-blue-600 hover:text-blue-200 dark:hover:text-black bg-blue-200 dark:bg-black hover:bg-blue-500
                                      duration-300 ease-in-out transition-all">
                            <i class="fa fa-arrow-left text-lg"></i>
                            {{ __('Cancel') }}
                        </a>
                    </p>
                </fieldset>
            </form>
        </section>
    </article>
</x-app-layout>

