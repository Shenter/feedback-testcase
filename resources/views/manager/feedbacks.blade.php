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
                    <table class="min-w-max w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">
                                    Номер
                                </th>
                                <th class="py-3 px-6 text-left">
                                    Заголовок
                                </th>
                                <th class="py-3 px-6 text-left">
                                    Сообщение
                                </th>
                                <th class="py-3 px-6 text-left">
                                    Файл
                                </th>
                                <th class="py-3 px-6 text-left">
                                    Загрузил
                                </th>
                                <th class="py-3 px-6 text-left">
                                    E-mail
                                </th>
                                <th class="py-3 px-6 text-left">
                                    Время создания
                                </th>
                                <th class="py-3 px-6 text-left">
                                    Обработан
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                    @forelse($feedbacks as $feedback)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                 {{($feedback->id)}}
                            </td>
                            <td  class="py-3 px-6 text-left">
                                {{($feedback->title)}}
                            </td>
                            <td class="py-3 px-6 text-left">
                                {{($feedback->message)}}
                            </td>
                            <td class="py-3 px-6 text-left">
                                @if ($feedback->attach)
                                    <a href="{{Storage::url($feedback->attach)}}">Вложение</a>
                                @endif
                            </td>
                            <td class="py-3 px-6 text-left">
                                {{$feedback->user->name}}
                            </td>
                            <td class="py-3 px-6 text-left">
                                {{$feedback->user->email}}
                            </td>
                            <td class="py-3 px-6 text-left">
                                {{$feedback->created_at}}
                            </td>
                            <td class="py-3 px-6 text-left">

                                @if($feedback->is_managed)
                                    Обработан
                                @else
                                    @livewire('managed-button',['feedbackId'=>$feedback->id])
                                @endif
                            </td>

                        </tr>
                    @empty
                        No results
                    @endforelse
                        </tbody>
                    </table>
                    {{$feedbacks->links()}}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
