@extends('layouts.app')

@section('title', 'إضافة دورة جديدة')
@section('page-title', 'إضافة دورة جديدة')
@section('title-icon', 'fas fa-plus-circle')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-purple text-white py-3">
                    <h5 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i> إضافة دورة جديدة
                    </h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('courses.store') }}" class="needs-validation" novalidate>
                        @csrf

                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                           id="title" name="title" value="{{ old('title') }}" required>
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
                                           id="instructor" name="instructor" value="{{ old('instructor') }}" required>
                                    <label for="instructor">اسم المدرب</label>
                                    @error('instructor')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" min="1" class="form-control @error('participants') is-invalid @enderror"
                                           id="participants" name="participants" value="{{ old('participants') }}" required>
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
                                           id="start_date" name="start_date" value="{{ old('start_date') }}" required>
                                    <label for="start_date">تاريخ البدء</label>
                                    @error('start_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                                           id="end_date" name="end_date" value="{{ old('end_date') }}" required>
                                    <label for="end_date">تاريخ الانتهاء</label>
                                    @error('end_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                              id="description" name="description" style="height: 100px">{{ old('description') }}</textarea>
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
                                <i class="fas fa-save me-2"></i> حفظ الدورة
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

@push('styles')
<style>
    .form-floating label {
        right: auto !important;
        left: 0;
        padding: 1rem 0.75rem;
    }

    .form-floating > .form-control:focus ~ label,
    .form-floating > .form-control:not(:placeholder-shown) ~ label,
    .form-floating > .form-select ~ label {
        transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);
        opacity: 0.8;
    }
</style>
@endpush
