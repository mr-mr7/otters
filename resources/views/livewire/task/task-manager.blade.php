<div class="p-4">
    <h4 class="text-center">
        لیست تسک ها
        <button class="btn btn-info btn-sm" wire:click="$dispatch('openModal', { component: 'task.create' })">اضافه کردن</button>
    </h4>
    <livewire:task.index />
</div>
