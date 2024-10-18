<div dir="rtl">
    <x-modal>
        <x-slot name="title">
            اضافه کردن تسک جدید
        </x-slot>

        <x-slot name="content">
            <div class="form">
                <div class="mb-4">
                    <label>عنوان</label>
                    <input type="text" class="form-control" wire:model="form.title">
                    <x-livewire.alert.error.validation-error model="form.title"/>
                </div>
                <div class="mb-4">
                    <label>توضیحات</label>
                    <textarea class="form-control" wire:model="form.des"></textarea>
                    <x-livewire.alert.error.validation-error model="form.des"/>
                </div>
                <div class="mb-4">
                    <label>اولویت</label>
                    <select class="form-control" wire:model="form.priority">
                        @foreach(\App\Enums\TaskPriorityEnum::cases() as $item)
                            <option value="{{ $item->value }}">{{ $item->label() }}</option>
                        @endforeach
                    </select>
                    <x-livewire.alert.error.validation-error model="form.priority"/>
                </div>
                <div class="mb-4">
                    <label>وضعیت</label>
                    <select class="form-control" wire:model="form.status">
                        @foreach(\App\Enums\TaskStatusEnum::cases() as $item)
                            <option value="{{ $item->value }}">{{ $item->label() }}</option>
                        @endforeach
                    </select>
                    <x-livewire.alert.error.validation-error model="form.status"/>
                </div>
                <div class="mb-4">
                    <label>تاریخ پایان</label>
                    <input type="datetime-local" dataformatas="Y-m-d H:i:s" class="form-control" wire:model="form.end_at">
                    <x-livewire.alert.error.validation-error model="form.end_at"/>
                </div>
            </div>
        </x-slot>

        <x-slot name="buttons">
            <button class="btn btn-success" wire:click="save" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="save">ذخیره</span>
                <span wire:loading.class.remove="d-none" class="d-none" wire:target="save">در حال ذخیره ...</span>
            </button>
        </x-slot>
    </x-modal>
</div>
