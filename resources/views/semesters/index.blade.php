@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between">
            <h5 class="mb-0">الفصول الدراسية</h5>
            <a href="{{ route('semesters.create') }}" class="btn btn-light">
                <i class="fas fa-plus"></i> إضافة فصل جديد
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
                            <th>اسم الفصل</th>
                            <th>السنة</th>
                            <th>تاريخ البدء</th>
                            <th>تاريخ الانتهاء</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($semesters as $semester)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $semester->name }}</td>
                            <td>{{ $semester->year }}</td>
                            <td>{{ $semester->start_date }}</td>
                            <td>{{ $semester->end_date }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('semesters.show', $semester->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('semesters.edit', $semester->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('semesters.destroy', $semester->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد؟')">
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
                {{ $semesters->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
