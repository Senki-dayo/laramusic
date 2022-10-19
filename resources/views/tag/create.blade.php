<x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('タグの管理ページ') }}
      </h2>
    </x-slot>

    <div class="py-6">
      <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            @include('common.errors')
            <form class="mb-6" action="{{ route('tag.store') }}" method="POST">
              @csrf
              <div class="flex flex-col mb-4">
                <label class="mb-2 uppercase font-bold text-lg text-grey-darkest" for="tag_title">新しいタグを登録しよう</label>
                <input class="border py-2 px-3 text-grey-darkest" type="text" name="tag_title" id="tag_title">
              </div>

              <button type="submit" class="w-full py-3 mt-6 font-medium tracking-widest text-white uppercase bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
                登録
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:w-10/12 md:w-8/10 lg:w-8/12">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <table class="text-left w-full border-collapse">

                <thead>
                    <tr>
                    <th class="py-3 px-6 bg-grey-lightest font-bold text-lg text-grey-dark border-b border-grey-light">登録済みのタグ</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($tags as $tag)
                    <tr class="hover:bg-grey-lighter">
                    <td class="py-4 px-6 border-b border-grey-light">
                        <form action="{{ route('tag.destroy',$tag->id) }}" method="POST">
                            @method('delete')
                            @csrf

                            <style>
                                .container {
                                    justify-content : space-between;
                                }
                            </style>

                            <div class="flex container">
                                <h3 class="w-1/3 mt-2 text-left font-bold text-lg text-grey-dark" name="tag_title">{{$tag->tag_title}}</h3>
                                <h3 class="w-1/3 mt-2">登録楽曲数({{ $tag->songs()->count() }})</h3>
                                <button type="submit" class="w-1/12 rounded-md px-2 py-2 font-medium tracking-widest text-white bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
                                    削除
                                </button>
                            </div>

                        </form>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>

</x-app-layout>
