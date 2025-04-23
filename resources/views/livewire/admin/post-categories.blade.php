<div>
    <div class="row">
        <div class="col-12">
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="h4 text-blue">Категории событий</h4>
                    </div>
                    <div class="pull-right">
                        <a href="javascript:;" wire:click="createPostCategoryForm()" class="btn btn-primary btn-sm">Добавить</a>
                    </div>
                </div>
                <div class="table-responsive mt-4">
                    <table class="table table-striped">
                        <thead class="bg-secondary text-white">
                            <th scope="col">#</th>
                            <th scope="col">ico</th>
                            <th scope="col">Наименование</th>
                            <th scope="col">Cобытий</th>
                            <th scope="col">Действия</th>
                        </thead>
                        <tbody>
                        @forelse($post_categories as $item)
                            <tr>
                                <td width="30">{{ $item->id }}</td>
                                <td width="30">{!! $item->icon !!}</td>
                                <td>{{ $item->name }}</td>
                                <td width="100" align="center">{{ $item->posts->count() }}</td>
                                <td width="100">
                                    <div class="table-actions">
                                        <a href="javascript:;" wire:click="editPostCategoryForm({{ $item->id }})" class="text-primary mx-2">
                                            <i class="dw dw-edit2"></i>
                                        </a>
                                        <a href="javascript:;" wire:click="deletePostCategoryForm({{ $item->id }})" class="text-danger mx-2">
                                            <i class="dw dw-delete-3"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3"><span class="text-danger">Нет данных</span></td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="d-block mt-1">
                        {{ $post_categories->links('livewire::simple-bootstrap') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--MODALS--}}

    <div
        wire:ignore.self
        class="modal fade"
        id="post_category_modal"
        tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel"
        aria-hidden="true"
        data-backdrop="static"
        data-keyboard="false"
    >
        <div class="modal-dialog modal-dialog-centered">
            <form
                class="modal-content"
                wire:submit="{{$isUpdatePostCategoryMode ? 'updatePostCategory()' : 'createPostCategory()'}}"
            >
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        {{ $isUpdatePostCategoryMode ? 'Редактировать' : 'Добавить' }}
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    @if($isUpdatePostCategoryMode)
                        <input type="hidden" wire:model="category_id">
                    @endif
                    <div class="form-group">
                        <label for="">Наименование категории</label>
                        <input
                            wire:model="category_name"
                            type="text"
                            class="form-control"
                            name="category_name"
                            placeholder="Введите название категории"
                        >
                        @error('category_name')
                            <small class="text-danger ml-1">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">
                            Наименование html код иконки
                            <small>
                                (Не обязательно)<br />
                                Пример: <i class="fa fa-cog" aria-hidden="true"></i> - {{'<i class="fa fa-cog"></i>'}}<br/>
                                <a href="https://fontawesome.ru/all-icons/" class="text-primary" target="_blank">Коллекция иконок</a>
                            </small>
                        </label>
                        <input
                            wire:model="icon"
                            type="text"
                            class="form-control"
                            name="icon"
                            placeholder="Введите html код иконки"
                        >
                        @error('icon')
                            <small class="text-danger ml-1">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Описание категории <small>(Не обязательно)</small></label>
                        <textarea
                            wire:model="category_description"
                            class="form-control"
                            name="category_description"
                            placeholder="Введите название категории"
                        ></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">
                        {{ $isUpdatePostCategoryMode ? 'Сохранить' : 'Добавить' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
