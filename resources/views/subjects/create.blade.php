@extends('layouts.app')

@section('title', 'إضافة مادة جديدة')
@section('page-title', 'مادة جديدة')

@section('content')
<div class="container-fluid">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <i class="fas fa-plus-circle me-2"></i>استمارة إضافة مادة جديدة
            </h5>
        </div>

        <div class="card-body">
            <form action="{{ route('subjects.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf

                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="form-floating mb-4">
                            <input type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   id="name"
                                   name="name"
                                   placeholder="اسم المادة"
                                   value="{{ old('name') }}"
                                   required>
                            <label for="name">اسم المادة <span class="text-danger">*</span></label>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">أدخل اسم المادة الدراسية بالكامل</div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('subjects.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-1"></i> إلغاء
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> حفظ المادة
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    (function () {
        'use strict'

        var forms = document.querySelectorAll('.needs-validation')

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
    })()
</script>
@endpush

@push('styles')
<style>
    .form-floating label {
        padding-right: 3.5rem;
    }

    .form-floating>.form-control {
        padding: 1rem 0.75rem;
    }

    .form-floating>.form-control:focus~label,
    .form-floating>.form-control:not(:placeholder-shown)~label {
        transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);
    }

    .card {
        border-radius: 0.5rem;
    }

    .btn {
        border-radius: 0.25rem;
        padding: 0.5rem 1.25rem;
    }
</style>
@endpush
