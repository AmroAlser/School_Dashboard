@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-white">
            <h5 class="mb-0">تعديل الفصل الدراسي: {{ $semester->name }}</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('semesters.update', $semester->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name">اسم الفصل</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                               id="name" name="name" value="{{ old('name', $semester->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="year">السنة</label>
                        <input type="number" class="form-control @error('year') is-invalid @enderror"
                               id="year" name="year" value="{{ old('year', $semester->year) }}" required min="2000" max="2100">
                        @error('year')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="start_date">تاريخ البدء</label>
                        <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                               id="start_date" name="start_date" value="{{ old('start_date', $semester->start_date) }}" required>
                        @error('start_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="end_date">تاريخ الانتهاء</label>
                        <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                               id="end_date" name="end_date" value="{{ old('end_date', $semester->end_date) }}" required>
                        @error('end_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('semesters.show', $semester->id) }}" class="btn btn-secondary">إلغاء</a>
                    <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
