@extends('layouts.app')

@section('title', 'تعديل الدورة')
@section('page-title', 'تعديل الدورة')
@section('title-icon', 'fas fa-edit')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-purple text-white py-3">
                    <h5 class="mb-0">
                        <i class="fas fa-edit me-2"></i> تعديل الدورة: {{ $course->title }}
                    </h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('courses.update', $course->id) }}" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                           id="title" name="title" value="{{ old('title', $course->title) }}" required>
                                    <label for="title">اسم الدورة</label>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('instructor') is-invalid @enderror"
                                           id="instructor" name="instructor" value="{{ old('instructor', $course->instructor) }}" required>
                                    <label for="instructor">اسم المدرب</label>
                                    @error('instructor')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" min="1" class="form-control @error('participants') is-invalid @enderror"
                                           id="participants" name="participants" value="{{ old('participants', $course->participants) }}" required>
                                    <label for="participants">عدد المشاركين</label>
                                    @error('participants')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                                           id="start_date" name="start_date"
                                           value="{{ old('start_date', $course->start_date->format('Y-m-d')) }}" required>
                                    <label for="start_date">تاريخ البدء</label>
                                    @error('start_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                                           id="end_date" name="end_date"
                                           value="{{ old('end_date', $course->end_date->format('Y-m-d')) }}" required>
                                    <label for="end_date">تاريخ الانتهاء</label>
                                    @error('end_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select @error('status') is-invalid @enderror"
                                            id="status" name="status" required>
                                        <option value="active" {{ old('status', $course->status) == 'active' ? 'selected' : '' }}>نشطة</option>
                                        <option value="finished" {{ old('status', $course->status) == 'finished' ? 'selected' : '' }}>منتهية</option>
                                    </select>
                                    <label for="status">حالة الدورة</label>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                              id="description" name="description" style="height: 100px">{{ old('description', $course->description) }}</textarea>
                                    <label for="description">وصف الدورة (اختياري)</label>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i> رجوع
                            </a>
                            <button type="submit" class="btn btn-purple">
                                <i class="fas fa-save me-2"></i> حفظ التغييرات
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Form validation
document.addEventListener('DOMContentLoaded', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
})
</script>
@endpush
