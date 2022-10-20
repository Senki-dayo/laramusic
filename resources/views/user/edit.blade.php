<x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Edit User Detail') }}
      </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
              @include('common.errors')
              <form class="mb-6" action="{{ route('follow.update',$user->id) }}" method="POST" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="flex flex-col mb-4">
                  <label class="mb-2 uppercase font-bold text-lg text-grey-darkest" for="name">name</label>
                  <input class="border py-2 px-3 text-grey-darkest" type="text" name="name" id="name" value="{{$user->name}}">
                </div>
                <div class="flex flex-col mb-4">
                  <label class="mb-2 uppercase font-bold text-lg text-grey-darkest" for="email">email</label>
                  <input class="border py-2 px-3 text-grey-darkest" type="text" name="email" id="email" value="{{$user->email}}">
                </div>
                <div class="flex justify-evenly">
                  <a href="{{ url()->previous() }}" class="block text-center w-5/12 py-3 mt-6 font-medium tracking-widest text-black uppercase bg-gray-100 shadow-sm focus:outline-none hover:bg-gray-200 hover:shadow-none">
                    Back
                  </a>
                  <button type="submit" class="w-5/12 py-3 mt-6 font-medium tracking-widest text-white uppercase bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
                    Update
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>
</x-app-layout>
