@extends('layouts.app')

@section('title', 'تقرير الفصول الدراسية')
@section('page-title', 'تقرير الفصول الدراسية')
@section('title-icon', 'fas fa-calendar-alt')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-calendar-alt me-2"></i>تقرير الفصول الدراسية
            </h5>
            <div>
                <button class="btn btn-light" onclick="window.print()">
                    <i class="fas fa-print me-1"></i> طباعة
                </button>
                <a href="{{ route('export.semesters', ['semester_filter' => request('semester_filter')]) }}" class="btn btn-primary ms-2">
                    <i class="fas fa-file-excel me-1"></i> تصدير
                </a>

            </div>
        </div>

        <div class="card-body">
            <div class="row">
                @foreach($semesters as $semester)
                <div class="col-md-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-header bg-white d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">
                                <i class="fas fa-calendar me-2 text-info"></i>{{ $semester->name }}
                            </h6>
                            <span class="badge bg-info">{{ $semester->students_count }} طالب</span>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    <small class="text-muted">تاريخ البدء</small>
                                    <p class="mb-0">{{ $semester->start_date }}</p>
                                </div>
                                <div>
                                    <small class="text-muted">تاريخ الانتهاء</small>
                                    <p class="mb-0">{{ $semester->end_date }}</p>
                                </div>
                                <div>
                                    <small class="text-muted">السنة</small>
                                    <p class="mb-0">{{ $semester->year }}</p>
                                </div>
                            </div>

                            <div class="progress mb-3" style="height: 10px;">
                                @php
                                    $progress = $semester->getProgressPercentage();
                                    $color = $progress >= 80 ? 'bg-success' : ($progress >= 50 ? 'bg-info' : 'bg-warning');
                                @endphp
                                <div class="progress-bar {{ $color }} progress-bar-striped progress-bar-animated"
                                     role="progressbar" style="width: {{ $progress }}%"
                                     aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <small class="text-muted">{{ $progress }}% مكتمل</small>
                                <small class="text-muted">{{ $semester->getRemainingDays() }} أيام متبقية</small>
                            </div>
                        </div>
                        <div class="card-footer bg-white">
                            <a href="{{ route('semesters.show', $semester->id) }}" class="btn btn-sm btn-outline-info">
                                <i class="fas fa-eye me-1"></i> عرض التفاصيل
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            @if($semesters->isEmpty())
                <div class="text-center py-5 text-muted">
                    <i class="fas fa-calendar-times fa-3x mb-3"></i>
                    <h5 class="mb-0">لا توجد فصول دراسية</h5>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .progress {
        border-radius: 5px;
    }

    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
</style>
@endpush
