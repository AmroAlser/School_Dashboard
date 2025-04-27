@extends('layouts.app')

@section('title', 'تعديل الصف')
@section('page-title', 'تعديل بيانات الصف')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white py-3">
            <h5 class="mb-0">
                <i class="fas fa-edit me-2"></i> تعديل الصف: {{ $class->name }}
            </h5>
        </div>

        <div class="card-body">
            <form action="{{ route('classes.update', $class) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">اسم الصف</label>
                        <div class="input-group">
                            <span class="input-group-text bg-primary text-white">
                                <i class="fas fa-chalkboard"></i>
                            </span>
                            <input type="text" name="name" value="{{ $class->name }}" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('classes.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i> إلغاء
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> تحديث
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
