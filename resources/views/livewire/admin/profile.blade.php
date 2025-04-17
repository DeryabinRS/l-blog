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
            <h5 class="text-center h5 mb-0">{{ $user->firstname . ' ' . $user->lastname }}</h5>
            <p class="text-center text-muted font-14">
                {{ $user->email }}
            </p>
            <div class="profile-info">
                <h5 class="mb-20 h5 text-blue">Contact Information</h5>
                <ul>
                    <li>
                        <span>Email Address:</span>
                        FerdinandMChilds@test.com
                    </li>
                    <li>
                        <span>Phone Number:</span>
                        619-229-0054
                    </li>
                    <li>
                        <span>Country:</span>
                        America
                    </li>
                    <li>
                        <span>Address:</span>
                        1807 Holden Street<br>
                        San Diego, CA 92115
                    </li>
                </ul>
            </div>
            <div class="profile-social">
                <h5 class="mb-20 h5 text-blue">Social Links</h5>
                <ul class="clearfix">
                    <li>
                        <a href="#" class="btn" data-bgcolor="#3b5998" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(59, 89, 152);"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li>
                        <a href="#" class="btn" data-bgcolor="#1da1f2" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(29, 161, 242);"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li>
                        <a href="#" class="btn" data-bgcolor="#007bb5" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(0, 123, 181);"><i class="fa fa-linkedin"></i></a>
                    </li>
                    <li>
                        <a href="#" class="btn" data-bgcolor="#f46f30" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(244, 111, 48);"><i class="fa fa-instagram"></i></a>
                    </li>
                    <li>
                        <a href="#" class="btn" data-bgcolor="#c32361" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(195, 35, 97);"><i class="fa fa-dribbble"></i></a>
                    </li>
                    <li>
                        <a href="#" class="btn" data-bgcolor="#3d464d" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(61, 70, 77);"><i class="fa fa-dropbox"></i></a>
                    </li>
                    <li>
                        <a href="#" class="btn" data-bgcolor="#db4437" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(219, 68, 55);"><i class="fa fa-google-plus"></i></a>
                    </li>
                    <li>
                        <a href="#" class="btn" data-bgcolor="#bd081c" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(189, 8, 28);"><i class="fa fa-pinterest-p"></i></a>
                    </li>
                    <li>
                        <a href="#" class="btn" data-bgcolor="#00aff0" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(0, 175, 240);"><i class="fa fa-skype"></i></a>
                    </li>
                    <li>
                        <a href="#" class="btn" data-bgcolor="#00b489" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(0, 180, 137);"><i class="fa fa-vine"></i></a>
                    </li>
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
                            >Personal details</a>
                        </li>
                        <li class="nav-item">
                            <a
                                wire:click="selectTab('update_password')"
                                class="nav-link {{ $tab === 'update_password' ? 'active' : '' }}"
                                data-toggle="tab"
                                href="#update_password"
                                role="tab"
                            >Update password</a>
                        </li>
                        <li class="nav-item">
                            <a
                                wire:click="selectTab('social_links')"
                                class="nav-link {{ $tab === 'social_links' ? 'active' : '' }}"
                                data-toggle="tab"
                                href="#social_links"
                                role="tab"
                            >Social links</a>
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
                                Update password
                            </div>
                        </div>
                        <div class="tab-pane fade {{ $tab == 'social_links' ? 'show active' : '' }}" id="social_links" role="tabpanel">
                            <div class="pd-20 profile-task-wrap">
                                Social links
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
