<div class="row">
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
        <div class="pd-20 card-box height-100-p">
            <div class="profile-photo">
                <a
                    href="javascript:;"
                    onclick="event.preventDefault();document.getElementById('profilePictureFile').click();"
                    class="edit-avatar"
                >
                    <i class="fa fa-pencil"></i>
                </a>
                <img src="{{ $user->picture }}" alt="" class="avatar-photo" id="profilePicturePreview">
                <input type="file" name="profilePictureFile" id="profilePictureFile" class="d-none" style="opacity: 0">
            </div>
            <h5 class="text-center h5 mb-2">{{ $user->firstname . ' ' . $user->lastname }}</h5>

            <div class="profile-info">
                <h5 class="mb-20 h5 text-blue">Контактная информация</h5>
                <ul>
                    <li>
                        <span>Email Address:</span>
                        {{ $user->email }}
                    </li>
                    <li>
                        <span>Телефон:</span>
                        --------------
                    </li>
                </ul>
            </div>
            <div class="profile-social">
                <h5 class="mb-20 h5 text-secondary">Ссылки</h5>
                <ul class="clearfix">
                    @if($facebook_url)
                        <li>
                            <a href="{{ $facebook_url }}" class="btn" style="color: #ffffff; background-color: #3b5998;"><i class="fa fa-facebook"></i></a>
                        </li>
                    @endif
                    @if($twitter_url)
                        <li>
                            <a href="{{ $twitter_url }}" class="btn" style="color: #1da1f2; background-color: #ffffff;"><i class="fa fa-twitter"></i></a>
                        </li>
                    @endif
                    @if($linkedin_url)
                        <li>
                            <a href="{{ $linkedin_url }}" class="btn" data-bgcolor="#007bb5" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(0, 123, 181);"><i class="fa fa-linkedin"></i></a>
                        </li>
                    @endif
                    @if($instagram_url)
                        <li>
                            <a href="{{ $instagram_url }}" class="btn" data-bgcolor="#f46f30" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(244, 111, 48);"><i class="fa fa-instagram"></i></a>
                        </li>
                    @endif
                    @if($github_url)
                        <li>
                            <a href="{{ $github_url }}" class="btn" style="color: #ffffff; background-color: #3d464d;"><i class="fa fa-github"></i></a>
                        </li>
                    @endif
                    @if($vk_url)
                        <li>
                            <a href="{{ $vk_url }}" class="btn" style="color: #ffffff; background-color: #3b5998;"><i class="fa fa-vk"></i></a>
                        </li>
                    @endif
                    @if($youtube_url)
                        <li>
                            <a href="{{ $youtube_url }}" class="btn" data-bgcolor="#db4437" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(219, 68, 55);"><i class="fa fa-youtube"></i></a>
                        </li>
                    @endif
                </ul>
            </div>

        </div>
    </div>
    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
        <div class="card-box height-100-p overflow-hidden">
            <div class="profile-tab height-100-p">
                <div class="tab height-100-p">
                    <ul class="nav nav-tabs customtab" role="tablist">
                        <li class="nav-item">
                            <a
                                wire:click="selectTab('personal_details')"
                                class="nav-link {{ $tab === 'personal_details' ? 'active' : '' }}"
                                data-toggle="tab"
                                href="#personal_details"
                                role="tab"
                            >Персональные данные</a>
                        </li>
                        <li class="nav-item">
                            <a
                                wire:click="selectTab('update_password')"
                                class="nav-link {{ $tab === 'update_password' ? 'active' : '' }}"
                                data-toggle="tab"
                                href="#update_password"
                                role="tab"
                            >Изменить пароль</a>
                        </li>
                        <li class="nav-item">
                            <a
                                wire:click="selectTab('social_links')"
                                class="nav-link {{ $tab === 'social_links' ? 'active' : '' }}"
                                data-toggle="tab"
                                href="#social_links"
                                role="tab"
                            >Ссылки</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade {{ $tab == 'personal_details' ? 'show active' : '' }}" id="personal_details" role="tabpanel">
                            <div class="pd-20">
                                <form wire:submit="updatePersonalDetails()">
                                    <div class="row">
                                        <div class="col-lg-4 mb-3">
                                            <label for="">Фамилия</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                wire:model="lastname"
                                                placeholder="Введите данные"
                                            >
                                            @error('lastname')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <label for="">Имя</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                wire:model="firstname"
                                                placeholder="Введите данные"
                                            >
                                            @error('firstname')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <label for="">Отчество</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                wire:model="middlename"
                                                placeholder="Введите данные"
                                            >
                                            @error('middlename')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label for="">Email</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                wire:model="email"
                                                placeholder="Введите данные"
                                                disabled
                                            >
                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Сохранить изменения</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade {{ $tab == 'update_password' ? 'show active' : '' }}" id="update_password" role="tabpanel">
                            <div class="pd-20 profile-task-wrap">
                                <form wire:submit="updatePassword()">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Текущий пароль</label>
                                                <input type="password" class="form-control" wire:model="current_password" placeholder="Введите текущий пароль">
                                                @error('current_password')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Новый пароль</label>
                                                <input type="password" class="form-control" wire:model="new_password" placeholder="Введите новый пароль">
                                                @error('new_password')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Повторите новый пароль</label>
                                                <input type="password" class="form-control" wire:model="new_password_confirmation" placeholder="Введите новый пароль">
                                                @error('new_password_confirmation')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Обновить пароль</button>
                                </form>
                            </div>
                        </div>

                        <div class="tab-pane fade {{ $tab == 'social_links' ? 'show active' : '' }}" id="social_links" role="tabpanel">
                            <div class="pd-20 profile-task-wrap">
                                <form method="POST" wire:submit="updateSocialLinks()">
                                    <div class="row">

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for=""><b>Facebook</b></label>
                                                <input type="text" class="form-control" wire:model="facebook_url" placeholder="Facebook Url">
                                                @error('facebook_url')
                                                    <small class="text-danger ml-1">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for=""><b>Instagram</b></label>
                                                <input type="text" class="form-control" wire:model="instagram_url" placeholder="Instagram Url">
                                                @error('instagram_url')
                                                    <small class="text-danger ml-1">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for=""><b>YouTube</b></label>
                                                <input type="text" class="form-control" wire:model="youtube_url" placeholder="YouTube Url">
                                                @error('youtube_url')
                                                    <small class="text-danger ml-1">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for=""><b>ВК</b></label>
                                                <input type="text" class="form-control" wire:model="vk_url" placeholder="ВК Url">
                                                @error('vk_url')
                                                    <small class="text-danger ml-1">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for=""><b>LinkedIn</b></label>
                                                <input type="text" class="form-control" wire:model="linkedin_url" placeholder="LinkedIn Url">
                                                @error('linkedin_url')
                                                    <small class="text-danger ml-1">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for=""><b>Twitter</b></label>
                                                <input type="text" class="form-control" wire:model="twitter_url" placeholder="Twitter Url">
                                                @error('twitter_url')
                                                    <small class="text-danger ml-1">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for=""><b>GitHub</b></label>
                                                <input type="text" class="form-control" wire:model="github_url" placeholder="GitHub Url">
                                                @error('github_url')
                                                    <small class="text-danger ml-1">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-3">Обновить</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
