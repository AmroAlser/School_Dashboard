@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">إضافة فصل دراسي جديد</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('semesters.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name">اسم الفصل</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                               id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="year">السنة</label>
                        <input type="number" class="form-control @error('year') is-invalid @enderror"
                               id="year" name="year" value="{{ old('year') }}" required min="2000" max="2100">
                        @error('year')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="start_date">تاريخ البدء</label>
                        <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                               id="start_date" name="start_date" value="{{ old('start_date') }}" required>
                        @error('start_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="end_date">تاريخ الانتهاء</label>
                        <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                               id="end_date" name="end_date" value="{{ old('end_date') }}" required>
                        @error('end_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('semesters.index') }}" class="btn btn-secondary">رجوع</a>
                    <button type="submit" class="btn btn-primary">حفظ</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
