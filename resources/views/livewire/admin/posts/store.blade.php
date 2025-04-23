<div>
    <div class="pd-20 card-box mb-30">
        <div class="row mb-20">
            <div class="col-md-4">
                <label for="search">Поиск</label>
                <input wire:model.live="search" id="search" type="text" class="form-control text-secondary" placeholder="Найти...">
            </div>
            <div class="col-md-2">
                <label for="post_category">Категория</label>
                <select wire:model.live="postCategory" id="post_category" class="custom-select form-control">
                    <option value="">Выберите категорию...</option>
                    @foreach(App\Models\PostCategory::whereHas('posts')->get() as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label for="author">Автор</label>
                <select wire:model.live="author" id="author" class="custom-select form-control">
                    <option value="">Выберите автора...</option>
                    @foreach(App\Models\User::whereHas('posts')->get() as $user)
                        <option value="{{ $user->id }}">{{ $user->firstname.' '.$user->lastname }}</option>
                    @endforeach
                </select>
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
                <th scope="col">Изображение</th>
                <th scope="col">Название</th>
                <th scope="col">Автор</th>
                <th scope="col">Категория</th>
                <th scope="col">Видимость</th>
                <th scope="col">Действия</th>
                </thead>
                <tbody>
                    @forelse($posts as $item)
                        <tr>
                            <td scope="row">{{ $item->id }}</td>
                            <td scope="row"><img src="/images/posts/thumb/thumb_{{ $item->featured_image }}" width="50" alt=""></td>
                            <td scope="row">{{ $item->title }}</td>
                            <td scope="row">{{ $item->author->firstname.' '.$item->author->lastname }}</td>
                            <td scope="row">{{ $item->category->name }}</td>
                            <td scope="row">
                                @if($item->visibility == 1)
                                    <span class="badge badge-pill badge-success">Опубликовано</span>
                                @else
                                    <span class="badge badge-pill badge-warning">Скрыто</span>
                                @endif
                            </td>
                            <td scope="row">
                                <div class="table-actions">
                                    <a
                                        href="{{ route('admin.edit_post', ['id' => $item->id]) }}"
                                        data-color="#265ed7"
                                        style="color: rgb(38, 94, 215)"
                                    >
                                        <i class="icon-copy dw dw-edit2"></i>
                                    </a>
                                    <a
                                        href="javascript:;"
                                        data-color="#e95959"
                                        style="color: rgb(233, 89, 89)"
                                        wire:click="deletePost({{ $item->id }})"
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
            {{ $posts->links('livewire::simple-bootstrap') }}
        </div>
    </div>
</div>
