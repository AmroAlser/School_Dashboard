@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-white">
            <h5 class="mb-0">تعديل الدرجة</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('grades.update', $grade->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="student_id">الطالب</label>
                        <select class="form-select @error('student_id') is-invalid @enderror" id="student_id" name="student_id" required>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}" {{ $grade->student_id == $student->id ? 'selected' : '' }}>
                                    {{ $student->name }} ({{ $student->national_id }})
                                </option>
                            @endforeach
                        </select>
                        @error('student_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="subject_id">المادة</label>
                        <select class="form-select @error('subject_id') is-invalid @enderror" id="subject_id" name="subject_id" required>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}" {{ $grade->subject_id == $subject->id ? 'selected' : '' }}>
                                    {{ $subject->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('subject_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="class_id" class="form-label">الصف</label>
                        <select name="class_id" id="class_id" class="form-select select2" required>
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}" {{ old('class_id', $grade->class_id ?? '') == $class->id ? 'selected' : '' }}>
                                    {{ $class->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="semester_id">الفصل الدراسي</label>
                        <select class="form-select @error('semester_id') is-invalid @enderror" id="semester_id" name="semester_id" required>
                            @foreach($semesters as $semester)
                                <option value="{{ $semester->id }}" {{ $grade->semester_id == $semester->id ? 'selected' : '' }}>
                                    {{ $semester->name }} ({{ $semester->year }})
                                </option>
                            @endforeach
                        </select>
                        @error('semester_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="score">الدرجة</label>
                        <input type="number" step="0.01" class="form-control @error('score') is-invalid @enderror"
                               id="score" name="score" value="{{ old('score', $grade->score) }}" required min="0" max="100">
                        @error('score')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="remarks">ملاحظات</label>
                        <textarea class="form-control @error('remarks') is-invalid @enderror"
                                  id="remarks" name="remarks" rows="1">{{ old('remarks', $grade->remarks) }}</textarea>
                        @error('remarks')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('grades.show', $grade->id) }}" class="btn btn-secondary">إلغاء</a>
                    <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
