<div>
    <div class="pd-20 card-box mb-30">
        <div class="row mb-20">
            <div class="col-md-4">
                <label for="search">Поиск</label>
                <input wire:model.live="search" id="search" type="text" class="form-control text-secondary" placeholder="Найти...">
            </div>
            <div class="col-md-2">
                <label for="status">Статус</label>
                <select wire:model.live="status" id="status" class="custom-select form-control">
                    <option value="">Выберите статус...</option>
                    <option value="active">Активный</option>
                    <option value="pending">На проверке</option>
                    <option value="blocked">Заблокирован</option>
                </select>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-auto table-sm">
                <thead class="bg-secondary text-white">
                    <th scope="col">#ID</th>
                    <th scope="col">Аватар</th>
                    <th scope="col">Email</th>
                    <th scope="col">Имя</th>
                    <th scope="col">Статус</th>
                    <th scope="col">Роль</th>
                    <th scope="col">Действия</th>
                </thead>
                <tbody>
                @forelse($users as $item)
                    <tr>
                        <td scope="row" width="30">{{ $item->id }}</td>
                        <td scope="row" width="90"><img src="{{ $item->picture }}" width="50" alt=""></td>
                        <td scope="row" width="250">
                            <div class="mb-1">{{ $item->email }}</div>
                            @if ($item->email_verified_at)
                                <div class="badge badge-success">Подтвержден</div>
                            @else
                                <div class="badge badge-warning">Не подтвержден</div>
                            @endif
                        </td>
                        <td scope="row">
                            <div>{{ $item->lastname.' '.$item->firstname.' '.$item->middlename }}</div>
                        </td>
                        <td scope="row">
                            {{ getUserStatus($item->status->value) ? getUserStatus($item->status->value)['label'] : '' }}
                        </td>
                        <td>
                            <div class="badge badge-light">
                                {{ getUserRole($item->role) ? getUserRole($item->role)['label'] : '' }}
                            </div>
                        </td>
                        <td scope="row" width="100">
                            <div class="table-actions">
                                <a
                                    href="{{ route('admin.edit_user', ['id' => $item->id]) }}"
                                    data-color="#265ed7"
                                    style="color: rgb(38, 94, 215)"
                                >
                                    <i class="icon-copy dw dw-edit2"></i>
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
            {{ $users->links('livewire::simple-bootstrap') }}
        </div>
    </div>
</div>
