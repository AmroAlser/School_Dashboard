@extends('layouts.app')

@section('title', 'تفاصيل الورقة')
@section('page-title', 'تفاصيل الورقة')
@section('title-icon', 'fas fa-file-alt')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-violet text-white py-3">
                    <h5 class="mb-0">
                        <i class="fas fa-file-alt me-2"></i> تفاصيل الورقة: {{ $paper->title }}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="paper-details">
                        <div class="detail-section mb-4">
                            <div class="section-header bg-violet-light p-3 rounded-top">
                                <h6 class="mb-0 text-violet">
                                    <i class="fas fa-info-circle me-2"></i> المعلومات الأساسية
                                </h6>
                            </div>
                            <div class="section-body p-3 border rounded-bottom">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="detail-item">
                                            <span class="detail-label">عنوان الورقة:</span>
                                            <span class="detail-value">{{ $paper->title }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="detail-item">
                                            <span class="detail-label">نوع الملف:</span>
                                            <span class="badge bg-secondary text-uppercase">
                                                {{ pathinfo($paper->file, PATHINFO_EXTENSION) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="detail-item">
                                            <span class="detail-label">تاريخ الإضافة:</span>
                                            <span class="detail-value">{{ $paper->created_at->format('Y/m/d') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="detail-item">
                                            <span class="detail-label">آخر تحديث:</span>
                                            <span class="detail-value">{{ $paper->updated_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="detail-section">
                            <div class="section-header bg-violet-light p-3 rounded-top">
                                <h6 class="mb-0 text-violet">
                                    <i class="fas fa-file-download me-2"></i> الملف المرفق
                                </h6>
                            </div>
                            <div class="section-body p-3 border rounded-bottom">
                                @php
                                    $extension = pathinfo($paper->file, PATHINFO_EXTENSION);
                                    $fileUrl = asset('storage/' . $paper->file);
                                    $fileSize = Storage::disk('public')->size($paper->file);
                                    $formattedSize = round($fileSize / (1024 * 1024), 2) . ' MB';
                                    $icon = [
                                        'pdf' => 'file-pdf',
                                        'doc' => 'file-word',
                                        'docx' => 'file-word',
                                        'xls' => 'file-excel',
                                        'xlsx' => 'file-excel',
                                        'ppt' => 'file-powerpoint',
                                        'pptx' => 'file-powerpoint'
                                    ][$extension] ?? 'file-alt';
                                @endphp

                                <div class="file-card p-4 mb-4 text-center border rounded">
                                    <div class="file-icon mb-3">
                                        <i class="fas fa-{{ $icon }} fa-4x text-violet"></i>
                                    </div>
                                    <h5 class="mb-2">{{ $paper->title }}</h5>
                                    <div class="file-meta mb-3">
                                        <span class="badge bg-secondary me-2">
                                            .{{ strtoupper($extension) }}
                                        </span>
                                        <span class="text-muted">{{ $formattedSize }}</span>
                                    </div>
                                    <div class="file-actions">
                                        <a href="{{ route('papers.download', $paper->id) }}" class="btn btn-violet me-2">
                                            <i class="fas fa-download me-1"></i> تنزيل الملف
                                        </a>
                                        <a href="{{ route('papers.show', $paper->id) }}" target="_blank" class="btn btn-outline-violet">
                                            <i class="fas fa-eye me-1"></i> معاينة
                                        </a>
                                    </div>
                                </div>
                                @if(in_array($extension, ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'jpg', 'jpeg', 'png', 'gif']))
                                    <div class="preview-section mt-4">
                                        <h6 class="text-center mb-3 text-violet">
                                            <i class="fas fa-eye me-2"></i> معاينة الملف
                                        </h6>
                                        <div class="preview-container border rounded p-2">
                                            @if($extension === 'pdf')
                                                <iframe src="{{ $fileUrl }}#toolbar=0&navpanes=0" class="w-100" style="height: 500px;" frameborder="0"></iframe>
                                            @elseif(in_array($extension, ['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx']))
                                                <iframe src="https://view.officeapps.live.com/op/embed.aspx?src={{ urlencode($fileUrl) }}" class="w-100" style="height: 500px;" frameborder="0"></iframe>
                                            @elseif(in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                                <img src="{{ $fileUrl }}" class="img-fluid rounded" alt="معاينة الصورة">
                                            @else
                                                <div class="alert alert-warning text-center py-4">
                                                    <i class="fas fa-exclamation-triangle fa-2x mb-3"></i>
                                                    <h5>نوع الملف غير مدعوم للعرض المباشر</h5>
                                                    <p class="mb-0">يمكنك تنزيل الملف لعرضه على جهازك</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('papers.edit', $paper->id) }}" class="btn btn-violet">
                            <i class="fas fa-edit me-2"></i> تعديل
                        </a>
                        <a href="{{ route('papers.index') }}" class="btn btn-outline-violet">
                            <i class="fas fa-list me-2"></i> رجوع للقائمة
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
    .detail-section {
        margin-bottom: 1.5rem;
    }

    .section-header {
        border-bottom: 1px solid rgba(106, 17, 203, 0.2);
    }

    .detail-item {
        display: flex;
        justify-content: space-between;
        padding: 0.5rem 0;
    }

    .detail-label {
        font-weight: 600;
        color: #6c757d;
    }

    .detail-value {
        color: #495057;
    }

    .file-card {
        transition: all 0.3s ease;
        background-color: #f9f9f9;
    }

    .file-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .file-icon {
        color: #6a11cb;
    }

    .preview-container {
        min-height: 500px;
    }
</style>
@endpush
