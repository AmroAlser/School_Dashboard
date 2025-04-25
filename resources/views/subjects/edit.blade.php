@extends('layouts.app')

@section('title', 'تعديل المادة')
@section('page-title', 'تعديل المادة')

@section('content')
<div class="container-fluid">
    <div class="card shadow-lg">
        <div class="card-header bg-warning text-white">
            <h5 class="mb-0">
                <i class="fas fa-edit me-2"></i>تعديل المادة: {{ $subject->name }}
            </h5>
        </div>

        <div class="card-body">
            <form action="{{ route('subjects.update', $subject->id) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('PUT')

                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="form-floating mb-4">
                            <input type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   id="name"
                                   name="name"
                                   placeholder="اسم المادة"
                                   value="{{ old('name', $subject->name) }}"
                                   required>
                            <label for="name">اسم المادة <span class="text-danger">*</span></label>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('subjects.show', $subject->id) }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-1"></i> إلغاء
                            </a>
                            <button type="submit" class="btn btn-warning text-white">
                                <i class="fas fa-sync-alt me-1"></i> تحديث المادة
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
