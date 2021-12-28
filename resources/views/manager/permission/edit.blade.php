@extends('manager.base-forms.edit')
@section('head')
    <link rel="stylesheet" href="{{ asset('manager/assets/vendors/choices.js/choices.min.css') }}">
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
                                            <label for="module">ماژول <i class="text-danger"> * </i></label>
                                            <select name="module" id="module" class="choices form-select" required>
                                                <option value="">انتخاب کنید</option>
                                                @foreach($module as $key => $item)
                                                    <option value="{{ $key }}" @if(isset($This) && $This['module'] == $key) selected @endif>{{ $item }} ({{ $key }})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="description">توضیحات </label>
                                            <input type="text" id="description" name="description" class="form-control @error('description') is-invalid @enderror"
                                                   value="{{ ((isset($This) && $This->description)) ? $This->description : old('description') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-6">
                                        <label class="invisible">-</label>
                                        <div class="form-check">
                                            <div class="custom-control custom-checkbox">
                                                <label class="form-check-label" for="show">نمایش</label>
                                                <input type="checkbox" class="form-check-input form-check-info" name="show" id="show"
                                                       @if(isset($This) && !$This->show) @else checked @endif>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-6">
                                        <label class="invisible">-</label>
                                        <div class="form-check">
                                            <div class="custom-control custom-checkbox">
                                                <label class="form-check-label" for="create">ایجاد</label>
                                                <input type="checkbox" class="form-check-input form-check-info" name="create" id="create"
                                                       @if(isset($This) && !$This->create) @else checked @endif>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-6">
                                        <label class="invisible">-</label>
                                        <div class="form-check">
                                            <div class="custom-control custom-checkbox">
                                                <label class="form-check-label" for="update">ویرایش</label>
                                                <input type="checkbox" class="form-check-input form-check-info" name="update" id="update"
                                                       @if(isset($This) && !$This->update) @else checked @endif>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-6">
                                        <label class="invisible">-</label>
                                        <div class="form-check">
                                            <div class="custom-control custom-checkbox">
                                                <label class="form-check-label" for="delete">حذف</label>
                                                <input type="checkbox" class="form-check-input form-check-info" name="delete" id="delete"
                                                       @if(isset($This) && !$This->delete) @else checked @endif>
                                            </div>
                                        </div>
                                    </div>
{{--

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="name">نام <i class="text-danger"> * </i></label>
                                            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" required autofocus autocomplete="name"
                                                   value="{{ ((isset($This) && $This->name)) ? $This->name : old('name') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="display_name">عنوان </label>
                                            <input type="text" id="display_name" name="display_name" class="form-control @error('display_name') is-invalid @enderror"
                                                   value="{{ ((isset($This) && $This->display_name)) ? $This->display_name : old('display_name') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="display_name">توضیحات</label>
                                            <textarea name="description" id="description" cols="30" rows="10" class="w-100 form-control @error('description') is-invalid @enderror">{{ ((isset($This) && $This->description)) ? $This->description : old('description') }}</textarea>
                                        </div>
                                    </div>
--}}

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
    <script src="{{ asset('manager/assets/vendors/choices.js/choices.min.js') }}"></script>
    <script>

    </script>
@endsection
