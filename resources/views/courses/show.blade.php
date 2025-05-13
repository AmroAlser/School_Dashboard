@extends('layouts.app')

@section('title', 'تفاصيل الدورة')
@section('page-title', 'تفاصيل الدورة')
@section('title-icon', 'fas fa-info-circle')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-purple text-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-info-circle me-2"></i> تفاصيل الدورة
                        </h5>
                        <div class="d-flex gap-2">
                            <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit me-1"></i> تعديل
                            </a>
                            <form action="{{ route('courses.destroy', $course->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('هل أنت متأكد من حذف هذه الدورة؟')">
                                    <i class="fas fa-trash me-1"></i> حذف
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="course-header mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="text-purple">{{ $course->title }}</h3>
                            @php
                            $endDate = \Carbon\Carbon::parse($course->end_date);
                            $isActive = $endDate->isFuture(); // true لو التاريخ بعد اليوم
                        @endphp
                               <span class="badge bg-{{ $isActive ? 'success' : 'secondary' }}">
                                {{ $isActive ? 'نشطة' : 'منتهية' }}
                            </span>
                        </div>

                        <div class="progress mb-3" style="height: 8px;">
                            @php
                                $progress = $course->progress();
                            @endphp
                            <div class="progress-bar bg-purple" role="progressbar" style="width: {{ $progress }}%"
                                 aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <small class="text-muted d-flex justify-content-between">
                            <span>تقدم الدورة</span>
                            <span>{{ $progress }}% مكتمل</span>
                        </small>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="info-card p-3 rounded bg-light mb-3">
                                <h6 class="text-muted mb-2">
                                    <i class="fas fa-chalkboard-teacher me-2 text-purple"></i> المدرب
                                </h6>
                                <h5 class="mb-0">{{ $course->instructor }}</h5>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-card p-3 rounded bg-light mb-3">
                                <h6 class="text-muted mb-2">
                                    <i class="fas fa-users me-2 text-purple"></i> عدد المشاركين
                                </h6>
                                <h5 class="mb-0">{{ $course->participants }}</h5>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="info-card p-3 rounded bg-light mb-3">
                                <h6 class="text-muted mb-2">
                                    <i class="fas fa-calendar-alt me-2 text-purple"></i> تاريخ البدء
                                </h6>
                                <h5 class="mb-0">{{ $course->start_date }}</h5>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-card p-3 rounded bg-light mb-3">
                                <h6 class="text-muted mb-2">
                                    <i class="fas fa-calendar-check me-2 text-purple"></i> تاريخ الانتهاء
                                </h6>
                                <h5 class="mb-0">{{ $course->end_date }}</h5>
                            </div>
                        </div>
                    </div>

                    @if($course->description)
                    <div class="info-card p-3 rounded bg-light mb-4">
                        <h6 class="text-muted mb-2">
                            <i class="fas fa-align-left me-2 text-purple"></i> وصف الدورة
                        </h6>
                        <p class="mb-0">{{ $course->description }}</p>
                    </div>
                    @endif

                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i> رجوع للقائمة
                        </a>
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
        border-left: 3px solid #6f42c1;
    }

    .info-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }

    .course-header {
        border-bottom: 1px solid rgba(111, 66, 193, 0.1);
        padding-bottom: 1rem;
    }
</style>
@endpush
