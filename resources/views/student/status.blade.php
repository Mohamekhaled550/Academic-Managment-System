@extends('layouts.app')

@section('content')
<div class="container">
    <h2>حالة الطالب</h2>

    <p><strong>إجمالي الساعات المجتازة:</strong> {{ $passedCredits }}</p>

    <h4>المقررات المجتازة:</h4>
    <table class="table">
        <thead>
            <tr>
                <th>اسم المادة</th>
                <th>الكود</th>
                <th>عدد الساعات</th>
                <th>الدرجة</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($passedRegistrations as $registration)
                <tr>
                    <td>{{ $registration->course->name }}</td>
                    <td>{{ $registration->course->code }}</td>
                    <td>{{ $registration->course->credit_hours }}</td>
                    <td>{{ $registration->grade }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
