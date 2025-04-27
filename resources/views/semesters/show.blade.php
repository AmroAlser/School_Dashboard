@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">تفاصيل الفصل الدراسي: {{ $semester->name }}</h5>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-4">
                        <h6 class="text-muted">المعلومات الأساسية</h6>
                        <hr>
                        <p><strong>اسم الفصل:</strong> {{ $semester->name }}</p>
                        <p><strong>السنة:</strong> {{ $semester->year }}</p>
                        <p><strong>تاريخ البدء:</strong> {{ $semester->start_date }}</p>
                        <p><strong>تاريخ الانتهاء:</strong> {{ $semester->end_date }}</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-4">
                        <h6 class="text-muted">الإحصاءات</h6>
                        <hr>
                        <p><strong>عدد الصفوف:</strong> {{ $semester->grades->count() }}</p>
                        <p><strong>تاريخ الإنشاء:</strong> {{ $semester->created_at }}</p>
                        <p><strong>آخر تحديث:</strong> {{ $semester->updated_at}}</p>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('semesters.index') }}" class="btn btn-secondary">رجوع للقائمة</a>
                <div>
                    <a href="{{ route('semesters.edit', $semester->id) }}" class="btn btn-warning">تعديل</a>
                    <form action="{{ route('semesters.destroy', $semester->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
