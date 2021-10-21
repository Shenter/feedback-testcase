<div>

@if (!$is_managed)
    <button class="p-1 pl-5 pr-5 bg-green-500 text-gray-100 text-lg rounded-lg focus:border-4 border-green-300"
        wire:click="markAsManaged({{$feedbackId}})"
        >Отметить выполненным</button>
    @else
    Обработано!
    @endif
</div>
