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
                                                <label for="title">عنوان <i class="text-danger"> * </i></label>
                                                <input type="text" id="title" name="title" class="form-control" required autofocus autocomplete="title"
                                                       value="{{ ((isset($This) && $This->title)) ? $This->title : old('title') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="slug">Slug <i class="text-danger"> * </i></label>
                                                <input type="text" id="slug" name="slug" class="form-control" required
                                                       value="{{ ((isset($This) && $This->slug)) ? $This->slug : old('slug') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="country">کشور</label>
                                                <select name="country" id="country" class="choices form-select">
                                                    <option value="">انتخاب کنید</option>
                                                    @foreach($country as $item)
                                                        <option value="{{ $item['id'] }}" @if(isset($This) && $This['country_id'] == $item['id']) selected @endif>#{{ $item['id'] }}-{{ $item['title'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="service">خدمت ها</label>
                                                <select name="service" id="service" class="choices form-select">
                                                    <option value="">انتخاب کنید</option>
                                                    @foreach($service as $item)
                                                        <option value="{{ $item['id'] }}" @if(isset($This) && $This['service_id'] == $item['id']) selected @endif>#{{ $item['id'] }}-{{ $item['title'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="h1">عنوان (h1)</label>
                                                <input type="text" id="h1" name="h1" class="form-control"
                                                       value="{{ ((isset($This) && $This->h1)) ? $This->h1 : old('h1') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group position-relative">
                                                <label for="meta_title">متاتگ (meta_title)</label>
                                                <input type="text" id="meta_title" name="meta_title" class="form-control" maxlength="60" onkeyup="input_counter('meta_title', 'meta_title_count')"
                                                       value="{{ ((isset($This) && $This->meta_title)) ? $This->meta_title : old('meta_title') }}">
                                                <span class="pull-right label label-default count_message"><span>60</span> | <span id="meta_title_count">0</span></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group position-relative">
                                                <label for="meta_desc">متاتگ (meta_desc)</label>
                                                <input type="text" id="meta_desc" name="meta_desc" class="form-control" maxlength="160" onkeyup="input_counter('meta_desc', 'meta_desc_count')"
                                                       value="{{ ((isset($This) && $This->meta_desc)) ? $This->meta_desc : old('meta_desc') }}">
                                                <span class="pull-right label label-default count_message"><span>160</span> | <span id="meta_desc_count">0</span></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="meta_canonical">متاتگ (meta_canonical)</label>
                                                <input type="text" id="meta_canonical" name="meta_canonical" class="form-control"
                                                       value="{{ ((isset($This) && $This->meta_canonical)) ? $This->meta_canonical : old('meta_canonical') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="meta_keyword">متاتگ (meta_keyword)</label>
                                                <input type="text" id="meta_keyword" name="meta_keyword" class="form-control"
                                                       value="{{ ((isset($This) && $This->meta_keyword)) ? $This->meta_keyword : old('meta_keyword') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="meta_redirect">متاتگ - Redirect (meta_refresh)</label>
                                                <input type="text" id="meta_redirect" name="meta_redirect" class="form-control"
                                                       value="{{ ((isset($This) && $This->meta_redirect)) ? $This->meta_redirect : old('meta_redirect') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="meta_robot">متاتگ - Index (meta_robot)</label>
                                                <select name="meta_robot" id="meta_robot" class="form-select">
                                                    <option value="index" @if(isset($This) && $This['meta_robot'] == 'index') selected @endif>Index</option>
                                                    <option value="noindex" @if(isset($This) && $This['meta_robot'] == 'noindex') selected @endif>Noindex</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="meta_follow">متاتگ - Follow (meta_robot)</label>
                                                <select name="meta_follow" id="meta_follow" class="form-select">
                                                    <option value="follow" @if(isset($This) && $This['meta_follow'] == 'follow') selected @endif>Follow</option>
                                                    <option value="unfollow" @if(isset($This) && $This['meta_follow'] == 'unfollow') selected @endif>Unfollow</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="tag">تگ ها</label>
                                                <select name="tag[]" id="tag" class="choices form-select multiple-remove" multiple="multiple">
                                                    @foreach($tagCategory as $item)
                                                        @if(isset($item->tag) && count($item->tag))
                                                            <optgroup label="{{ $item->title }} (#{{ $item->id }})">
                                                                @foreach($item->tag as $tag_item)
                                                                    <option value="{{ $tag_item->id }}" @if(isset($tag_rel) && in_array($tag_item->id, $tag_rel)) selected @endif>#{{ $tag_item->id }}-{{ $tag_item->title }}</option>
                                                                @endforeach
                                                            </optgroup>
                                                        @endif
                                                    @endforeach
                                                </select>
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

                                        <div class="col-md-6 col-12">
                                            <label class="invisible">-</label>
                                            <div class="form-check">
                                                <div class="custom-control custom-checkbox">
                                                    <label class="form-check-label" for="active">فعال</label>
                                                    <input type="checkbox" class="form-check-input form-check-info" name="active" id="active"
                                                           @if(isset($This) && !$This->active) @else checked @endif>
                                                </div>
                                            </div>
                                        </div>

                                        @php $model = '\App\\' . $modulename['model']; @endphp
                                        @if($model::$commentable)
                                            <div class="col-md-6 col-12">
                                                <label class="invisible">-</label>
                                                <div class="form-check">
                                                    <div class="custom-control custom-checkbox">
                                                        <label class="form-check-label" for="comment">پرسش و پاسخ فعال شود؟</label>
                                                        <input type="checkbox" class="form-check-input form-check-info" name="comment" id="comment"
                                                               @if(isset($This) && isset($This->options['comment']) && $This->options['comment']) checked @endif>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @if($model::$publisher)
                                            <div class="col-md-6 col-12">
                                                <label class="invisible">-</label>
                                                <div class="form-check">
                                                    <div class="custom-control custom-checkbox">
                                                        <label class="form-check-label" for="publisher">اطلاعات ناشر نمایش داده شود؟</label>
                                                        <input type="checkbox" class="form-check-input form-check-info" name="publisher" id="publisher"
                                                               @if(isset($This) && isset($This->options['publisher']) &&  $This->options['publisher']) checked @endif>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="editor">متن بلاگ</label>
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
    <script src="{{ asset('manager/assets/vendors/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('manager/assets/vendors/choices.js/choices.min.js') }}"></script>

    <script src="{{ asset('manager/assets/vendors/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('manager/assets/vendors/ckeditor/ckeditor-init.js') }}"></script>
    <script>
        initSample();

        input_counter('meta_title', 'meta_title_count');
        input_counter('meta_desc', 'meta_desc_count');

        function input_counter(input, display) {
            let _input = document.getElementById(input);
            document.getElementById(display).innerHTML =_input.value.length;
        }
    </script>
@endsection
