<div class="pd-20 card-box mb-30">
    <div class="row mb-20">
        <div class="col-md-4">
            <label for="search">Поиск</label>
            <input wire:model.live="search" id="search" type="text" class="form-control text-secondary" placeholder="Найти...">
        </div>
        <div class="col-md-2">
            <label for="visibility">Видимость</label>
            <select wire:model.live="visibility" id="visibility" class="custom-select form-control">
                <option value="">Не выбрано...</option>
                <option value="public">Опубликовано</option>
                <option value="private">Скрыто</option>
            </select>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-auto table-sm">
            <thead class="bg-secondary text-white">
            <th scope="col">#ID</th>
            <th scope="col">Название</th>
            <th scope="col">Родитель</th>
            <th scope="col">Видимость</th>
            <th scope="col">Действия</th>
            </thead>
            <tbody>
            @forelse($menuItems as $item)
                <tr>
                    <td scope="row" width="30">{{ $item->id }}</td>
                    <td scope="row">{{ $item->title }}</td>
                    <td scope="row">
                        {{ $item->parent ? $item->parent->title : '' }}
                    </td>
                    <td scope="row" width="150">
                        @if($item->visibility == 1)
                            <span class="badge badge-pill badge-success">Опубликовано</span>
                        @else
                            <span class="badge badge-pill badge-warning">Скрыто</span>
                        @endif
                    </td>
                    <td scope="row" width="100">
                        <div class="table-actions">
                            <a
                                href="{{ route('admin.edit_page', ['id' => $item->id]) }}"
                                data-color="#265ed7"
                                style="color: rgb(38, 94, 215)"
                            >
                                <i class="icon-copy dw dw-edit2"></i>
                            </a>
                            <a
                                href="javascript:;"
                                data-color="#e95959"
                                style="color: rgb(233, 89, 89)"
                                wire:click="deleteRecord({{ $item->id }})"
                            >
                                <i class="icon-copy dw dw-delete-3"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7">Нет данных</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="block mt-1">
        {{ $menuItems->links('livewire::simple-bootstrap') }}
    </div>
</div>
