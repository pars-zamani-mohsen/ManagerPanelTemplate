@extends('manager.base-forms.edit')
@section('head')
@endsection
@section('form')
    <!-- // Basic multiple Column Form section start -->
    @php #$login_user = \Illuminate\Support\Facades\Auth::user(); @endphp
    <section id="ticket-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content pt-4">
                        {{--@if(isset($This) && $This)
                            <div class="card-header">
                                <small class="">عنوان</small>
                                <h4 class="card-title">{{ $This['title'] }}</h4>
                            </div>
                        @endif--}}
                        <div class="card-body">
                            @php
                                if(isset($This) && $This)
                                    $url = url('/'. App\Http\Controllers\HomeController::fetch_manager_pre_url() .'/'. $modulename['en'] .'/' . $This['id']);
                                else
                                    $url = url('/'. App\Http\Controllers\HomeController::fetch_manager_pre_url() .'/'. $modulename['en']);
                            @endphp
                            <form class="form" name="ticket" method="post" action="{{ $url }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    @if(isset($This) && $This)
                                        <input type="hidden" name="id" value="{{ $This['id'] }}">
                                        @method('put')
                                    @endif

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="name">نام <i class="text-danger"> * </i></label>
                                            <input type="text" id="name" class="form-control" name="name" required autofocus autocomplete="name"
                                                   value="{{ ((isset($This) && $This->name)) ? $This->name : old('name') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="mobile">تلفن همراه <i class="text-danger"> * </i></label>
                                            <input type="text" id="mobile" class="form-control" name="mobile" required
                                                   value="{{ ((isset($This) && $This->mobile)) ? $This->mobile : old('mobile') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="role_id">نقش <i class="new-user-req text-danger"> * </i> </label>
                                            <select name="role_id" id="role_id" class="form-select" required>
                                                @foreach($role as $item)
                                                    <option value="{{ $item->id }}" @if(isset($This) && $This['role_id'] == $item->id || old('role_id') == $item->id) selected @endif>
                                                        {{ $item->display_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    @if(isset($This) && $This)
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="password">کلمه عبور </label>
                                                <input type="checkbox" class="form-check-input form-check-danger" id="password_ch" onclick="password_checker()">
                                                <input type="password" id="password" class="form-control" name="password" disabled
                                                       value="{{ old('password') }}">
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="password">کلمه عبور <i class="text-danger"> * </i></label>
                                                <input type="password" id="password" class="form-control" name="password" required
                                                       value="{{ ((isset($This) && $This->password)) ? $This->password : old('password') }}">
                                            </div>
                                        </div>
                                    @endif

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="title">عنوان</label>
                                            <input type="text" id="title" class="form-control" name="title"
                                                   value="{{ ((isset($This) && $This->title)) ? $This->title : old('title') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="side">سمت</label>
                                            <input type="text" id="side" class="form-control" name="side"
                                                   value="{{ ((isset($This) && $This->side)) ? $This->side : old('side') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="expertise">تخصص</label>
                                            <input type="text" id="expertise" class="form-control" name="expertise"
                                                   value="{{ ((isset($This) && $This->expertise)) ? $This->expertise : old('expertise') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group row">
                                            <div class="col-10">
                                                <label for="file">تصویر </label>
                                                <input type="file" name="file" id="file" class="form-control" accept="image/*">
                                            </div>
                                            <div class="col-2">
                                                @if((isset($This) && $This))
                                                    <a href="{{ asset($This->picture) }}" target="_blank"><img class="img-thumbnail img-fluid w-100" src="{{ asset($This->picture) }}" alt="{{ $This->title }}"></a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="editor">توضیحات</label>
                                            <textarea class="editor" id="editor" name="description">{{ ((isset($This) && $This->description)) ? $This->description : old('description') }}</textarea>
                                        </div>
                                    </div>

                                    <div class="row col-12 d-flex justify-content-end mt-5">
                                        <div class="col-xxl-2 col-md-2 col-12">
                                            <div class="form-group">
                                                <label for="submit" class="invisible">ثبت</label>
                                                <button type="submit" id="submit" class="btn btn-primary me-1 mb-1 form-control">
                                                    <i class="bi bi-check bi-line-height"></i> ثبت </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- // Basic multiple Column Form section end -->

@endsection
@section('script')
    <script src="{{ asset('manager/assets/vendors/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('manager/assets/vendors/ckeditor/ckeditor-init.js') }}"></script>
    <script>
        initSample();
    </script>
    <script>
        function password_checker()
        {
            document.getElementById("password").disabled = !document.getElementById('password_ch').checked;
        }
    </script>
@endsection
