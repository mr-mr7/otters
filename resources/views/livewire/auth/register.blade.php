@extends('components.layouts.fortify')
@php($title='ثبت نام')
@section('content')
    <div class="mt-4 col-md-6 mx-auto">
        <div class="card">
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="post">
                    @csrf
                    <div class="mb-3">
                        <label>نام</label>
                        <input class="form-control" name="name">
                    </div>
                    <div class="mb-3">
                        <label>ایمیل</label>
                        <input class="form-control" name="email">
                    </div>
                    <div class="mb-3">
                        <label>رمز عبور</label>
                        <input class="form-control" name="password">
                    </div>
                    <div class="mb-3">
                        <label>تکرار رمز عبور</label>
                        <input class="form-control" name="password_confirmation">
                    </div>
                    <div class="">
                        <button type="submit" class="btn btn-success">ثبت نام</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
