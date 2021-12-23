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
                                            <label for="role">نقش <i class="new-user-req text-danger"> * </i> </label>
                                            <select name="role" id="role" class="form-select" required onchange="redirect_to()">
                                                <option value="">انتخاب کنید</option>
                                                @foreach($role as $item)
                                                    <option value="{{ $item->id }}" @if(isset($This) && $This['role_id'] == $item->id || old('role') == $item->id || (isset($role_id) && $role_id == $item->id)) selected @endif>
                                                        #{{ $item->id }}-{{ $item->display_name }} ({{ $item->name }})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12 invisible">
                                        <div class="form-group">
                                            <label for="permission">دسترسی <i class="new-user-req text-danger"> * </i> </label>
                                            <select name="" id="permission" class="form-select">
                                                <option value="">انتخاب کنید</option>
                                                {{--@foreach($permission as $item)
                                                    <option value="{{ $item->id }}" @if(isset($This) && $This['permission_id'] == $item->id || old('permission') == $item->id) selected @endif>
                                                        #{{ $item->id }}-{{ $item->display_name }} ({{ $item->name }})</option>
                                                @endforeach--}}
                                            </select>
                                        </div>
                                    </div>

                                    @foreach($permission as $key => $item)
                                        <div class="col-md-3 col-6">
                                            <label class="invisible">-</label>
                                            <div class="form-check">
                                                <div class="custom-control custom-checkbox">
                                                    <label class="form-check-label" for="permission-{{ $item['id'] }}">{{ $item['display_name'] }}</label>
                                                    <input type="checkbox" class="form-check-input form-check-info" name="permission-{{ $item['id'] }}" id="permission-{{ $item['id'] }}"
                                                           @if(isset($selected_permition) && in_array($item['id'], $selected_permition)) checked @endif>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

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
    <script>
        function redirect_to() {
            let role = document.getElementById('role');
            window.location.replace('{{ url("/_manager/permissionToRole/create") }}/' + role.value)
        }
    </script>
@endsection
