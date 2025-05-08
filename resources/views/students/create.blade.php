@extends('layouts.app')

@section('title', 'إضافة طالب جديد')
@section('page-title', 'تسجيل طالب جديد')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <i class="fas fa-user-plus me-2"></i>استمارة تسجيل طالب جديد
            </h5>
        </div>

        <div class="card-body">
            <form action="{{ route('students.store') }}" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <!-- الصف الأول -->
                    <div class="col-md-6 mb-3">
                        <label for="national_id" class="form-label">رقم الهوية الوطنية <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-primary text-white">
                                <i class="fas fa-id-card"></i>
                            </span>
                            <input type="text" class="form-control @error('national_id') is-invalid @enderror"
                                   id="national_id" name="national_id"
                                   value="{{ old('national_id') }}" required
                                   placeholder="أدخل رقم الهوية الوطنية">
                            @error('national_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">الاسم الكامل <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-primary text-white">
                                <i class="fas fa-user"></i>
                            </span>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="name" name="name"
                                   value="{{ old('name') }}" required
                                   placeholder="الاسم الرباعي للطالب">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- الصف الثاني -->
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="gender" class="form-label">الجنس <span class="text-danger">*</span></label>
                        <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                            <option value="" disabled selected>اختر الجنس</option>
                            <option value="ذكر" {{ old('gender') == 'ذكر' ? 'selected' : '' }}>ذكر</option>
                            <option value="أنثى" {{ old('gender') == 'أنثى' ? 'selected' : '' }}>أنثى</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="birth_date" class="form-label">تاريخ الميلاد <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-primary text-white">
                                <i class="fas fa-calendar-alt"></i>
                            </span>
                            <input type="date" class="form-control @error('birth_date') is-invalid @enderror"
                                   id="birth_date" name="birth_date"
                                   value="{{ old('birth_date') }}" required>
                            @error('birth_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="status" class="form-label">الحالة <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="" disabled selected>اختر الحالة</option>
                            <option value="مواطن" {{ old('status') == 'مواطن' ? 'selected' : '' }}>مواطن</option>
                            <option value="لاجئ" {{ old('status') == 'لاجئ' ? 'selected' : '' }}>لاجئ</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <!-- الصف الثالث -->
                <div class="row">
                    <div class="form-group">
                        <label for="class_id" class="form-label">الصف الدراسي</label>
                        <select name="class_id" id="class_id" class="form-control" required>
                            <option value="">اختر الصف</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="mb-3">
                        <label for="semester_id" class="form-label">الفصل الدراسي</label>
                        <select name="semester_id" id="semester_id" class="form-select select2" required>
                            <option value="">-- اختر الفصل الدراسي --</option>
                            @foreach ($semesters as $semester)
                                <option value="{{ $semester->id }}" {{ old('semester_id', $student->semester_id ?? '') == $semester->id ? 'selected' : '' }}>
                                    {{ $semester->name }} - {{ $semester->year }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="col-md-4 mb-3">
                        <label for="academic_year" class="form-label">السنة الدراسية <span class="text-danger">*</span></label>
                        <select class="form-select @error('academic_year') is-invalid @enderror" id="academic_year" name="academic_year" required>
                            <option value="" disabled selected>اختر السنة الدراسية</option>
                            @for ($year = 2023; $year <= 2030; $year++)
                                @php
                                    $nextYear = $year + 1;
                                    $value = "$year-$nextYear";
                                @endphp
                                <option value="{{ $value }}" {{ old('academic_year') == $value ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endfor
                        </select>
                        @error('academic_year')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="entry_date" class="form-label">تاريخ التسجيل <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-primary text-white">
                                <i class="fas fa-calendar-check"></i>
                            </span>
                            <input type="date" class="form-control @error('entry_date') is-invalid @enderror"
                                   id="entry_date" name="entry_date"
                                   value="{{ old('entry_date') }}" required>
                            @error('entry_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- الصف الرابع -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label">رقم الجوال</label>
                        <div class="input-group">
                            <span class="input-group-text bg-primary text-white">
                                <i class="fas fa-phone"></i>
                            </span>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                   id="phone" name="phone"
                                   value="{{ old('phone') }}"
                                   placeholder="أدخل رقم الجوال">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="guardian_national_id" class="form-label">رقم هوية ولي الأمر</label>
                        <div class="input-group">
                            <span class="input-group-text bg-primary text-white">
                                <i class="fas fa-id-card-alt"></i>
                            </span>
                            <input type="text" class="form-control @error('guardian_national_id') is-invalid @enderror"
                                   id="guardian_national_id" name="guardian_national_id"
                                   value="{{ old('guardian_national_id') }}"
                                   placeholder="رقم هوية ولي الأمر">
                            @error('guardian_national_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- الصف الخامس -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="disability" class="form-label">الإعاقة (إن وجدت)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-primary text-white">
                                <i class="fas fa-wheelchair"></i>
                            </span>
                            <input type="text" class="form-control @error('disability') is-invalid @enderror"
                                   id="disability" name="disability"
                                   value="{{ old('disability') }}"
                                   placeholder="نوع الإعاقة إن وجدت">
                            @error('disability')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="address" class="form-label">العنوان</label>
                        <div class="input-group">
                            <span class="input-group-text bg-primary text-white">
                                <i class="fas fa-map-marker-alt"></i>
                            </span>
                            <input type="text" class="form-control @error('address') is-invalid @enderror"
                                   id="address" name="address"
                                   value="{{ old('address') }}"
                                   placeholder="العنوان التفصيلي">
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- الصف السادس -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="transferred_from" class="form-label">محول من (إن وجد)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-primary text-white">
                                <i class="fas fa-school"></i>
                            </span>
                            <input type="text" class="form-control @error('transferred_from') is-invalid @enderror"
                                   id="transferred_from" name="transferred_from"
                                   value="{{ old('transferred_from') }}"
                                   placeholder="الروضة">
                            @error('transferred_from')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="transferred_to" class="form-label">محول إلى (إن وجد)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-primary text-white">
                                <i class="fas fa-school"></i>
                            </span>
                            <input type="text" class="form-control @error('transferred_to') is-invalid @enderror"
                                   id="transferred_to" name="transferred_to"
                                   value="{{ old('transferred_to') }}"
                                   placeholder="اسم المدرسة المحول إليها">
                            @error('transferred_to')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-label">
                    <label for="report_image">صورة التقرير</label>
                    <input type="file" name="report_image" id="report_image" class="form-control">
                </div>


                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('students.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-right me-1"></i> رجوع للقائمة
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> حفظ البيانات
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
        border-radius: 0.5rem;
        border: none;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }

    .card-header {
        border-radius: 0.5rem 0.5rem 0 0 !important;
        padding: 1.25rem 1.5rem;
    }

    .form-label {
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .input-group-text {
        border-radius: 0.25rem 0 0 0.25rem;
    }

    .form-control, .form-select {
        border-radius: 0 0.25rem 0.25rem 0;
        padding: 0.5rem 0.75rem;
    }

    .invalid-feedback {
        display: block;
        font-size: 0.85rem;
    }

    .text-danger {
        color: #dc3545;
    }

    .btn {
        padding: 0.5rem 1.25rem;
        border-radius: 0.25rem;
        font-weight: 500;
    }

    .btn-primary {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    .btn-primary:hover {
        background-color: #0b5ed7;
        border-color: #0a58ca;
    }
</style>
@endpush

@push('scripts')
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
        'use strict'

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
    })()
</script>
@endpush
