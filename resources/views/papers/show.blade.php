@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-primary">
            <i class="fas fa-file-alt me-2"></i> تفاصيل الورقة
        </h1>
        <a href="{{ route('papers.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> رجوع للقائمة
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <i class="fas fa-info-circle me-2"></i> معلومات الورقة
            </h5>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-2 font-weight-bold text-muted">
                    <i class="fas fa-heading me-2"></i> العنوان:
                </div>
                <div class="col-md-10">
                    <h5 class="mb-0">{{ $paper->title }}</h5>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-2 font-weight-bold text-muted">
                    <i class="fas fa-file me-2"></i> الملف:
                </div>
                <div class="col-md-10">
                    @php
                        $extension = pathinfo($paper->file, PATHINFO_EXTENSION);
                        $fileUrl = asset('storage/' . $paper->file);
                        $fileSize = Storage::disk('public')->size($paper->file);
                        $formattedSize = round($fileSize / (1024 * 1024), 2) . ' MB';
                    @endphp

                    <div class="file-info-card mb-4 p-3 bg-light rounded">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-file-{{ $extension === 'pdf' ? 'pdf' : ($extension === 'doc' || $extension === 'docx' ? 'word' : 'alt') }} text-primary fa-2x me-3"></i>
                                <span class="font-weight-bold">{{ strtoupper($extension) }} ملف</span>
                                <span class="text-muted mx-2">|</span>
                                <span class="text-muted">{{ $formattedSize }}</span>
                            </div>
                            <a href="{{ asset('storage/' . $paper->file) }}" download class="btn btn-success">
                                <i class="fas fa-download me-1"></i> تنزيل الملف
                            </a>
                        </div>
                    </div>

                    {{-- <div class="file-preview-container border rounded p-3">
                        <h6 class="text-center mb-3 text-muted">
                            <i class="fas fa-eye me-2"></i> معاينة الملف
                        </h6>

                        @if(in_array($extension, ['pdf']))
                        <div class="ratio ratio-16x9">
                            <iframe src="{{ $fileUrl }}#toolbar=0&navpanes=0" class="border-0" allowfullscreen></iframe>
                        </div>
                        @elseif(in_array($extension, ['doc', 'docx']))
                        <div class="ratio ratio-16x9">
                            <iframe src="https://view.officeapps.live.com/op/embed.aspx?src={{ urlencode($fileUrl) }}" class="border-0" frameborder="0"></iframe>
                        </div>
                        @elseif(in_array($extension, ['xls', 'xlsx']))
                        <div class="ratio ratio-16x9">
                            <iframe src="https://view.officeapps.live.com/op/embed.aspx?src={{ urlencode($fileUrl) }}" class="border-0" frameborder="0"></iframe>
                        </div>
                        @elseif(in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                        <div class="text-center">
                            <img src="{{ $fileUrl }}" class="img-fluid rounded border" alt="معاينة الصورة">
                        </div>
                        @else
                        <div class="alert alert-warning text-center py-4">
                            <i class="fas fa-exclamation-triangle fa-2x mb-3"></i>
                            <h5>نوع الملف غير مدعوم للعرض المباشر</h5>
                            <p class="mb-0">يمكنك تنزيل الملف لعرضه على جهازك</p>
                        </div>
                        @endif
                    </div> --}}
                </div>
            </div>

            <div class="d-flex justify-content-center mt-5">
                <a href="{{ route('papers.edit', $paper->id) }}" class="btn btn-warning mx-2 px-4">
                    <i class="fas fa-edit me-1"></i> تعديل
                </a>
                <form action="{{ route('papers.destroy', $paper->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger mx-2 px-4" onclick="return confirm('هل أنت متأكد من حذف هذه الورقة؟')">
                        <i class="fas fa-trash-alt me-1"></i> حذف
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .file-info-card {
        transition: all 0.3s ease;
    }
    .file-info-card:hover {
        background-color: #f8f9fa !important;
        transform: translateY(-2px);
    }
    .file-preview-container {
        min-height: 500px;
        background-color: #f9f9f9;
    }
</style>
@endsection
