@extends('layouts.app')

@section('title', 'تفاصيل الفصل الدراسي')
@section('page-title', 'تفاصيل الفصل الدراسي')
@section('title-icon', 'fas fa-info-circle')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-teal text-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-info-circle me-2"></i> تفاصيل الفصل: {{ $semester->name }}
                        </h5>
                        <div class="d-flex gap-2">
                            <a href="{{ route('semesters.edit', $semester->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit me-1"></i> تعديل
                            </a>
                            <form action="{{ route('semesters.destroy', $semester->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('هل أنت متأكد من حذف هذا الفصل؟')">
                                    <i class="fas fa-trash me-1"></i> حذف
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="semester-header mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="text-teal">{{ $semester->name }}</h3>
                            @php
                                $status = $semester->status();
                                $statusClass = [
                                    'active' => 'success',
                                    'upcoming' => 'info',
                                    'completed' => 'secondary'
                                ][$status];
                            @endphp
                            <span class="badge bg-{{ $statusClass }}">
                                {{ [
                                    'active' => 'جاري',
                                    'upcoming' => 'قادم',
                                    'completed' => 'منتهي'
                                ][$status] }}
                            </span>
                        </div>

                        <div class="progress mb-3" style="height: 8px;">
                            @php
                                $progress = $semester->progress();
                            @endphp
                            <div class="progress-bar bg-teal" role="progressbar" style="width: {{ $progress }}%"
                                 aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <small class="text-muted d-flex justify-content-between">
                            <span>تقدم الفصل الدراسي</span>
                            <span>{{ $progress }}% مكتمل</span>
                        </small>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="info-card p-3 rounded bg-light mb-3">
                                <h6 class="text-muted mb-2">
                                    <i class="fas fa-calendar-alt me-2 text-teal"></i> السنة الدراسية
                                </h6>
                                <h5 class="mb-0">{{ $semester->year }}</h5>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-card p-3 rounded bg-light mb-3">
                                <h6 class="text-muted mb-2">
                                    <i class="fas fa-users me-2 text-teal"></i> عدد الطلاب
                                </h6>
                                <h5 class="mb-0">{{ $semester->students->count() }}</h5>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="info-card p-3 rounded bg-light mb-3">
                                <h6 class="text-muted mb-2">
                                    <i class="fas fa-calendar-day me-2 text-teal"></i> تاريخ البدء
                                </h6>
                                <h5 class="mb-0">{{ $semester->start_date->format('d/m/Y') }}</h5>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-card p-3 rounded bg-light mb-3">
                                <h6 class="text-muted mb-2">
                                    <i class="fas fa-calendar-check me-2 text-teal"></i> تاريخ الانتهاء
                                </h6>
                                <h5 class="mb-0">{{ $semester->end_date->format('d/m/Y') }}</h5>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('semesters.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i> رجوع للقائمة
                        </a>
                        <div class="d-flex gap-2">
                            <a href="{{ route('semesters.edit', $semester->id) }}" class="btn btn-teal">
                                <i class="fas fa-edit me-2"></i> تعديل الفصل
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .info-card {
        transition: all 0.3s ease;
        border-left: 3px solid #20c997;
    }

    .info-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }

    .semester-header {
        border-bottom: 1px solid rgba(32, 201, 151, 0.1);
        padding-bottom: 1rem;
    }
</style>
@endpush
