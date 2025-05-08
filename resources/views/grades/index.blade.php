@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between">
            <h5 class="mb-0">سجل الدرجات</h5>
            <a href="{{ route('grades.create') }}" class="btn btn-light">
                <i class="fas fa-plus"></i> إضافة درجة جديدة
            </a>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>الطالب</th>
                            <th>المادة</th>
                            <th>الصف</th>
                            <th>الفصل</th>
                            <th>الدرجة</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($grades as $grade)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $grade->student->name }}</td>
                            <td>{{ $grade->subject->name }}</td>
                            <td>{{ $grade->class->name }}</td> <!-- عرض اسم الصف -->
                            <td>{{ $grade->semester->name }}</td>
                            <td>{{ $grade->score }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('grades.show', $grade->id) }}"  class="btn btn-action btn-view rounded-3"
                                        data-bs-toggle="tooltip">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('grades.edit', $grade->id) }}"  class="btn btn-action btn-view rounded-3"
                                        data-bs-toggle="tooltip">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('grades.destroy', $grade->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"  class="btn btn-action btn-view rounded-3"
                                        data-bs-toggle="tooltip" onclick="return confirm('هل أنت متأكد؟')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $grades->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
