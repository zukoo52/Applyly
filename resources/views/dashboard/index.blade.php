<x-layout>
    <section class="flex flex-col md:flex-row gap-4">
        <!-- profile info form -->
        <div class="bg-white p-8 rounded-lg shadow-md w-full">
            <h3 class="text-3xl text-center font-bold md-4">My profile Info</h3>
            @if($user->avatar)
            <div class="mt-2 flex justify-center">
                <img src="{{asset('storage/' . $user->avatar)}}" alt="{{$user->name}}" class="w-32 h-32 object-cover rounded-full">
            </div>
            @endif
            <form method="POST" action="{{route('profile.update')}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <x-inputs.text
                    id="name"
                    name="name"
                    label="Name"
                    value="{{$user->name}}" />

                <x-inputs.text
                    id="email"
                    name="email"
                    label="Email Address"
                    type="email"
                    value="{{$user->email}}" />

                <x-inputs.file
                    id="avatar"
                    name="avatar"
                    label="Upload a Avatar" />

                <button type="submit"
                    class="w-full bg-green-500  hover:bg-green-600 text-white px-4 py-2 border-rounded focus:outline-none">Save</button>

            </form>
        </div>

        <!-- Job listing -->
        <div class="bg-white p-8 rounded-lg shadow-md w-full">
            <h3 class="text-3xl text-center font-bold md-4">My Job listings</h3>
            @forelse($jobs as $job)
            <div class="flex justify-between item-center border-b-2 border-gray-200 py-2">
                <div>
                    <h3 class="text-xl font-semibold">{{$job->title}}</h3>
                    <p class="text-gray-700">{{$job->job_type}}</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{route('jobs.edit',$job->id)}}" class="w-24 h-10 flex items-center justify-center bg-blue-500 hover:bg-blue-600 text-white rounded text-sm">Edit</a>
                    <!-- Delete Form -->
                    <form method="POST" action="{{route('jobs.destroy', $job->id)}}?from=dashboard"
                        onsubmit="return confirm('are you sure? ')">
                        @csrf
                        @method('DELETE')
                        <button
                            type="submit"
                            class="w-24 h-10 flex items-center justify-center bg-red-500 hover:bg-red-600 text-white rounded text-sm">
                            Delete
                        </button>
                    </form>
                    <!-- End Delete Form -->
                </div>
            </div>

            <!-- Applicant -->
            <div class="mt-4 bg-gray-100 p-2 mb-2">
                <h4 class="text-lg font-semibold mb-4">Applicants</h4>
                @forelse($job->applicants as $applicant)
                <div class="py-2">
                    <p class="text-gray-800">
                        <strong>Name: </strong> {{$applicant->full_name}}
                    </p>
                    <p class="text-gray-800">
                        <strong>Phone: </strong> {{$applicant->contact_phone}}
                    </p>
                    <p class="text-gray-800">
                        <strong>Email: </strong> {{$applicant->contact_email}}
                    </p>
                    <p class="text-gray-800">
                        <strong>Message: </strong> {{$applicant->massage}}
                    </p>
                    <p class="text-gray-800 mt-2">
                        <a href="{{asset('storage/'.$applicant->resume_path)}}" class="text-blue-500 hover:underline text-sm" download>
                            <i class="fas fa-download"></i>
                            Download Resume</a>
                    </p>
                    <!-- delete applicant -->
                    <form method="POST" action="{{ route('applicant.destroy', $applicant->id) }}"

                    onsubmit="return confirm('Are you sure want to delete this ?')">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-500 hover:text-red-700 text-sm">
                        <i class="fas fa-trash"></i>Delete Applicant
                    </button>
                    </form>
                </div>
                @empty
                <p class="text-gray-700 mb-5 ">No Applicant For This Job</p>
                @endforelse
            </div>
            @empty
            <p class="text-gray-700 b">You Have No Job Listings</p>
            @endforelse
        </div>
    </section>
    <x-bottom-banner />
</x-layout>