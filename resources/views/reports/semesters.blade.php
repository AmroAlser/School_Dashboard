@extends('layouts.app')

@section('title', 'تقرير الفصول الدراسية')
@section('page-title', 'تقرير الفصول الدراسية')
@section('title-icon', 'fas fa-calendar-alt')

@section('content')
<div class="container-fluid">
    <!-- Welcome Card -->
    <div class="welcome-card mb-4">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #17a2b8, #138496);">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="text-white mb-3">
                            <i class="fas fa-calendar-alt me-2"></i> تقرير الفصول الدراسية
                        </h4>
                        <p class="mb-0 text-white-50">
                            نظرة عامة على جميع الفصول الدراسية وأدائها
                        </p>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <div class="bg-white bg-opacity-25 p-3 rounded d-inline-block">
                            <i class="fas fa-chalkboard-teacher text-white fa-3x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Report Card -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-teal text-white d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0">
                <i class="fas fa-calendar-alt me-2"></i> الفصول الدراسية
            </h5>
            <div class="d-flex gap-2">
                <button class="btn btn-light" onclick="window.print()">
                    <i class="fas fa-print me-1"></i> طباعة
                </button>
                <a href="{{ route('export.semesters', ['semester_filter' => request('semester_filter')]) }}"
                   class="btn btn-light">
                    <i class="fas fa-file-excel me-1"></i> تصدير
                </a>
            </div>
        </div>

        <div class="card-body">
            @if($semesters->isEmpty())
            <div class="text-center py-5 text-muted">
                <i class="fas fa-calendar-times fa-3x mb-3"></i>
                <h5 class="mb-0">لا توجد فصول دراسية</h5>
            </div>
            @else
            <div class="row">
                @foreach($semesters as $semester)
                <div class="col-md-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm semester-card">
                        <div class="card-header bg-white d-flex justify-content-between align-items-center">
                            <h6 class="mb-0 text-teal">
                                <i class="fas fa-calendar me-2"></i>{{ $semester->name }}
                            </h6>
                            <span class="fas fa text-black">{{ $semester->students_count }} طالب</span>
                        </div>

                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <div class="text-center">
                                    <small class="text-muted">تاريخ البدء</small>
                                    <p class="mb-0 fw-bold">{{ $semester->start_date->format('Y/m/d') }}</p>
                                </div>
                                <div class="text-center">
                                    <small class="text-muted">تاريخ الانتهاء</small>
                                    <p class="mb-0 fw-bold">{{ $semester->end_date->format('Y/m/d') }}</p>
                                </div>
                                <div class="text-center">
                                    <small class="text-muted">السنة</small>
                                    <p class="mb-0 fw-bold">{{ $semester->year }}</p>
                                </div>
                            </div>

                            @php
                                $progress = $semester->progress(); // نسبة التقدم
                                $isActive = $semester->isActive(); // الحالة
                                $color = $progress >= 80 ? 'bg-success' : ($progress >= 50 ? 'bg-info' : 'bg-warning');
                            @endphp

                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <small>نسبة التقدم: {{ $progress }}%</small>
                                    @if($isActive)
                                        <small class="text-success fw-bold"><i class="fas fa-check-circle me-1"></i> نشط</small>
                                    @else
                                        <small class="text-muted"><i class="fas fa-clock me-1"></i> غير نشط</small>
                                    @endif
                                </div>

                                <div class="progress" style="height: 10px;">
                                    <div class="progress-bar {{ $color }} progress-bar-striped progress-bar-animated"
                                         role="progressbar"
                                         style="width: {{ $progress }}%"
                                         aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <small class="text-muted">{{ $progress }}% مكتمل</small>
                                <small class="text-muted">{{ $semester->getRemainingDays() }} أيام متبقية</small>
                            </div>
                        </div>

                        <div class="card-footer bg-white text-center">
                            <a href="{{ route('semesters.show', $semester->id) }}" class="btn btn-sm btn-outline-teal">
                                <i class="fas fa-eye me-1"></i> عرض التفاصيل
                            </a>
                        </div>
                    </div>
                </div>

                @endforeach
            </div>
            @endif

            @if($semesters->hasPages())
            <div class="d-flex justify-content-center mt-3">
                {{ $semesters->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .bg-teal {
        background-color: #20c997 !important;
    }

    .semester-card {
        transition: all 0.3s ease;
    }

    .semester-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }

    .progress {
        border-radius: 5px;
    }

    @media print {
        .welcome-card, .card-header {
            display: none !important;
        }

        body {
            background: white !important;
        }

        .card {
            border: none !important;
            box-shadow: none !important;
        }
    }
</style>
@endpush
