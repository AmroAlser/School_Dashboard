@extends('layouts.app')

@section('title', 'إضافة فصل دراسي جديد')
@section('page-title', 'إضافة فصل دراسي جديد')
@section('title-icon', 'fas fa-plus-circle')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-teal text-white py-3">
                    <h5 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i> إضافة فصل دراسي جديد
                    </h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('semesters.store') }}" class="needs-validation" novalidate>
                        @csrf

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           id="name" name="name" value="{{ old('name') }}" required>
                                    <label for="name">اسم الفصل</label>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" class="form-control @error('year') is-invalid @enderror"
                                           id="year" name="year" value="{{ old('year', date('Y')) }}"
                                           min="2000" max="2100" required>
                                    <label for="year">السنة</label>
                                    @error('year')
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

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('semesters.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i> رجوع
                            </a>
                            <button type="submit" class="btn btn-teal">
                                <i class="fas fa-save me-2"></i> حفظ الفصل
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
document.addEventListener('DOMContentLoaded', function() {
    // Form validation
    var forms = document.querySelectorAll('.needs-validation');

    Array.prototype.slice.call(forms).forEach(function(form) {
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });

    // Date validation
    $('#start_date, #end_date').change(function() {
        const startDate = new Date($('#start_date').val());
        const endDate = new Date($('#end_date').val());

        if (startDate && endDate && startDate > endDate) {
            $('#end_date').addClass('is-invalid');
            $('#end_date').next('.invalid-feedback').text('تاريخ الانتهاء يجب أن يكون بعد تاريخ البدء');
        } else {
            $('#end_date').removeClass('is-invalid');
        }
    });
});
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
