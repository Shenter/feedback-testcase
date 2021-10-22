<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add feedback') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div>
                        @if($errors->any())
                            @forelse($errors->all() as $error)
                                <span style="color: red">
                                {{$error}}<br>
                            </span>
                            @empty
                            @endforelse
                        @endif

                        @if ($availableIn)
                            You can submit feedback in {{$humanTime }}
                        @else
                    </div>
                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                            <div class="text-gray-600">
                                <p class="font-medium text-lg">Форма обратной связи</p>
                                <p>Поля тема и сообщение обязательны для заполнения</p>
                            </div>
                            <form method="POST" action="{{route('feedback.post')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="lg:col-span-2">
                                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                                        <div class="md:col-span-5">
                                            <label for="title">Тема обращения</label>
                                            <input type="text" maxlength="255" required name="title" id="title" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="{{old('title')}}" placeholder="Введите тему обращения"/>
                                        </div>
                                        <div class="md:col-span-5">
                                            <label for="text">Ваше сообщение</label>
                                            <textarea name="text" required id="text" maxlength="16000" class="h-40 border mt-1 rounded px-4 w-full bg-gray-50" placeholder="Введите ваше сообщение" >{{old('text')}}</textarea>
                                        </div>
                                        <div class="md:col-span-2">
                                            <label for="file">Выберите файл</label>
                                            <input type="file" id="file" name="file" >
                                        </div>
                                        <div class="md:col-span-5 text-right">
                                            <div class="inline-flex items-end">
                                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
