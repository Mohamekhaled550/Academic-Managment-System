@extends('admin.layouts.app')

@section('content')
    <h3>تعديل الترم</h3>
    <form action="{{ route('admin.terms.update', $term) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.terms._form', ['term' => $term])
        <button class="btn btn-primary">تحديث</button>
    </form>
@endsection
