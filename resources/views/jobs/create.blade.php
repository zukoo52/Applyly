<x-layout>
    <x-slot name="title">Create New Job</x-slot>

    <div
        class="bg-white mx-auto p-8 rounded-lg shadow-md w-full md:max-w-3xl">
        <h2 class="text-4xl text-center font-bold mb-4">
            Create Job Listing
        </h2>
        <form
            @if ($errors->any())
            <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            method="POST"
            action="{{route('jobs.store')}}"
            enctype="multipart/form-data">
            @csrf
            <h2
                class="text-2xl font-bold mb-6 text-center text-gray-500">
                Job Info
            </h2>

            <x-inputs.text id="title"
                name="title"
                lable="Job Title"
                placeholder="Software Engineer" />

            <x-inputs.text-area
                id="description"
                name="description"
                lable="Description"
                placeholder="We Are Seeking a Skilled and Motivated Software Developer..." />


            <x-inputs.text id="salary"
                name="salary"
                lable="salary"
                type="number"
                placeholder="90000" />


            <x-inputs.text-area
                id="requirements"
                name="requirements"
                lable="Requirements"
                placeholder="Bachelor's degree in Computer Science" />



            <x-inputs.text-area
                id="benefits"
                name="benefits"
                lable="Benefits"
                placeholder="Health insurance, 401k, paid time off" />

            <x-inputs.text id="tags"
                name="tags"
                lable="Tags (comma-separated)"
                placeholder="development, coding, java, python" />

            <x-inputs.select
                id="job_type"
                name="job_type"
                lable="Job Type"
                value="old('job_type')"
                :options="[
        'Full-Time' => 'Full-Time',
        'Part-Time' => 'Part-Time',
        'Contract' => 'Contract',
        'Temporary' => 'Temporary',
        'Internship' => 'Internship',
        'Volunteer' => 'Volunteer',
        'On-Call' => 'On-Call'
    ]" />


          <x-inputs.select id="remote" name="remote" label="Remote"
           :options="[0 => 'No', 1 => 'Yes']" />


            <x-inputs.text id="address"
                name="address"
                lable="Address"
                type="text"
                placeholder="123 Main St" />

            <x-inputs.text id="city"
                name="city"
                lable="City"
                type="text"
                placeholder="Albany" />

            <x-inputs.text id="state"
                name="state"
                lable="State"
                type="text"
                placeholder="NY" />

            <x-inputs.text id="zipcode"
                name="zipcode"
                lable="Zipcode"
                type="text"
                placeholder="12201" />


            <h2
                class="text-2xl font-bold mb-6 text-center text-gray-500">
                Company Info
            </h2>


            <x-inputs.text id="company_name"
                name="company_name"
                lable="Company Name"
                placeholder="Enter Company name" />


            <x-inputs.text-area
                id="company_description"
                name="company_description"
                lable="company Description"
                placeholder=" Enter Company Description" />

            <x-inputs.text id="company_website"
                name="company_website"
                lable="Company Website"
                type="url"
                placeholder="Enter Company Website" />

            <x-inputs.text id="contact_phone"
                name="contact_phone"
                lable="Contact Phone"
                placeholder="Enter Contact Phone" />


            <x-inputs.text id="contact_email"
                name="contact_email"
                lable="Contact Email"
                type="email"
                placeholder="Enter contact Email" />


            <x-inputs.file
                id="company_logo"
                label="Company Logo"
                name="company_logo" />

            <button
                type="submit"
                class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 my-3 rounded focus:outline-none">
                Save
            </button>
        </form>
    </div>

</x-layout>