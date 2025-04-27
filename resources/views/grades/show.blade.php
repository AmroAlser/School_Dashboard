@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">تفاصيل الدرجة</h5>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-4">
                        <h6 class="text-muted">المعلومات الأساسية</h6>
                        <hr>
                        <p><strong>الطالب:</strong> {{ $grade->student->name }}</p>
                        <p><strong>المادة:</strong> {{ $grade->subject->name }}</p>
                        <p><strong>الصف:</strong> {{ $grade->class->name }}</p>
                        <p><strong>الفصل الدراسي:</strong> {{ $grade->semester->name }}</p>
                        <p><strong>الدرجة:</strong> {{ $grade->score }}</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-4">
                        <h6 class="text-muted">تفاصيل إضافية</h6>
                        <hr>
                        <p><strong>ملاحظات:</strong> {{ $grade->remarks ?? 'لا يوجد' }}</p>
                        <p><strong>تاريخ الإضافة:</strong> {{ $grade->created_at->format('Y-m-d') }}</p>
                        <p><strong>آخر تحديث:</strong> {{ $grade->updated_at->format('Y-m-d') }}</p>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('grades.index') }}" class="btn btn-secondary">رجوع للقائمة</a>
                <div>
                    <a href="{{ route('grades.edit', $grade->id) }}" class="btn btn-warning">تعديل</a>
                    <form action="{{ route('grades.destroy', $grade->id) }}" method="POST" class="d-inline">
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
