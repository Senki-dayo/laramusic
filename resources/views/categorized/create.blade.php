<x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('曲をタグごとに振り分けしよう！') }}
      </h2>
    </x-slot>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            @include('common.errors')


        {{-- ここにコメント --}}
            <form action="{{ route('categorized.store') }}" method = "POST">
            @csrf
                <table border="1">
                    <tr>
                        <td>
                            <div>
                                <p>曲を選択</p>
                                <select name="song">
                                    @foreach ($songs as $song)
                                    <option>{{$song->song}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p>タグを選択</p>
                                <select name="tag_title">
                                @foreach ($tags as $tag)
                                    <option>{{$tag->tag_title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                    </tr>
                </table>

                <button type="submit" class="w-full py-3 mt-6 font-medium tracking-widest text-white uppercase bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
                    登録！
                </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </x-app-layout>
