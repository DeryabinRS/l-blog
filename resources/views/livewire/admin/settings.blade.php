<div class="tab">
    <ul class="nav nav-tabs customtab" role="tablist">
        <li class="nav-item">
            <a
                wire:click="selectTab('general_settings')"
                class="nav-link {{ $tab == 'general_settings' ? 'active' : '' }}"
                data-toggle="tab"
                href="#general_settings"
                role="tab"
                aria-selected="true"
            >Основные настройки</a>
        </li>
        <li class="nav-item">
            <a
                wire:click="selectTab('logo_favicon')"
                class="nav-link {{ $tab == 'logo_favicon' ? 'active' : '' }}"
                data-toggle="tab"
                href="#logo_favicon"
                role="tab"
                aria-selected="false"
            >Логотип</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade {{ $tab == 'general_settings' ? 'show active' : '' }}" id="general_settings" role="tabpanel">
            <div class="pd-20">
                <form wire:submit="updateSiteInfo()">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Название сайта</label>
                                <input type="text" class="form-control" wire:model="site_title" placeholder="Введите название сайта" />
                                @error('site_title')
                                    <small class="text-danger ml-1">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Основной Email</label>
                                <input type="text" class="form-control" wire:model="site_email" placeholder="Введите email" />
                                @error('site_email')
                                    <small class="text-danger ml-1">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Телефон</label>
                                <input type="text" class="form-control" wire:model="site_phone" placeholder="Введите телефон" />
                                @error('site_phone')
                                    <small class="text-danger ml-1">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Мета теги</label>
                                <input type="text" class="form-control" wire:model="site_meta_keywords" placeholder="Введите метатеги через запятую" />
                                @error('site_meta_keywords')
                                    <small class="text-danger ml-1">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Описание сайта</label>
                        <textarea class="form-control" wire:model="site_meta_description" cols="4" rows="4" placeholder="Введите описание сайта"></textarea>
                        @error('site_meta_description')
                            <small class="text-danger ml-1">{{ $message }}</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Сохранить</button>
                </form>
            </div>
        </div>

        <div class="tab-pane fade {{ $tab == 'logo_favicon' ? 'show active' : '' }}" id="logo_favicon" role="tabpanel">
            <div class="pd-20">
                <div class="row">
                    <div class="col-lg-6">
                        <h6>Логотип сайта</h6>
                        <div class="profile-photo" style="margin: 20px 0; width: 200px; height: 50px">
                            <a
                                href="javascript:;"
                                onclick="event.preventDefault();document.getElementById('siteLogoFile').click();"
                                class="edit-avatar"
                                style="right: -40px"
                            >
                                <i class="fa fa-pencil"></i>
                            </a>
                            <img src="{{ $site_logo }}" alt="" id="siteLogoPreview">
                            <input type="file" name="siteLogoFile" id="siteLogoFile" class="d-none" style="opacity: 0">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
