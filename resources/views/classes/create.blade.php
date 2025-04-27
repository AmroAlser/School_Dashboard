@extends('layouts.app')

@section('title', 'إضافة صف جديد')
@section('page-title', 'إنشاء صف')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white py-3">
            <h5 class="mb-0">
                <i class="fas fa-plus-circle me-2"></i> إضافة صف جديد
            </h5>
        </div>

        <div class="card-body">
            <form action="{{ route('classes.store') }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">اسم الصف</label>
                        <div class="input-group">
                            <span class="input-group-text bg-primary text-white">
                                <i class="fas fa-chalkboard"></i>
                            </span>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> حفظ
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
