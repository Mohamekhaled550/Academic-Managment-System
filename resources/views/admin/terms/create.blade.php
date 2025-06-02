@extends('admin.layouts.app')

@section('content')
    <h3>إضافة ترم جديد</h3>
    <form action="{{ route('admin.terms.store') }}" method="POST">
        @csrf
        @include('admin.terms._form', ['term' => null])
        <button class="btn btn-success">حفظ</button>
    </form>
@endsection
