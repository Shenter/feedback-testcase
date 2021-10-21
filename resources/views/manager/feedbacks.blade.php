<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Feedbacks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table border="1">
                        <thead>
                            <tr>
                                <td>
                                    Номер
                                </td>
                                <td>
                                    Заголовок
                                </td>
                                <td>
                                    Сообщение
                                </td>
                                <td>
                                    Файл
                                </td>
                                <td>
                                    Обработан
                                </td>
                            </tr>
                        </thead>
                    @forelse($feedbacks as $feedback)
                        <tr>
                            <td>
                                 {{($feedback->id)}}
                            </td>
                            <td>
                                {{($feedback->title)}}
                            </td>
                            <td>
                                {{($feedback->message)}}
                            </td>
                            <td>
                                @if ($feedback->attach)
                                    <a href="{{url($feedback->attach)}}">Вложение</a>
                                @endif
                            </td>
                            <td>
                                @if($feedback->managed)
                                    Обработан
                                @else

                                @endif
                            </td>

                        </tr>
                    @empty
                        No results
                    @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
