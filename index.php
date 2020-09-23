@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Users
        </h1>
    </section>
    <div class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Users</h3>
            </div>
            @if(session()->has('message'))
                <div class="box-body">
                    <div class="success">
                        {{ session()->get('message') }}
                    </div>
                </div>
            @endif
            <div class="box-body">
{{--                <h2>Laravel 6 Upload Image Using Dropzone Tutorial</h2><br/>--}}
{{--                <form method="post" action="{{url('dropzone/store')}}" enctype="multipart/form-data"--}}
{{--                      class="dropzone" id="dropzone">--}}
{{--                    @csrf--}}
{{--                </form>--}}

                <form action="{{url('dropzone/store')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Name/Description fields, irrelevant for this article --}}

                    <div class="form-group">
                        <label for="document">Documents</label>
                        <div class="needsclick dropzone" id="document-dropzone">

                        </div>
                    </div>
                    <div>
                        <input class="btn btn-danger" type="submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts-plugin')
    <script type="text/javascript">
        var uploadedDocumentMap = {};
        Dropzone.options.documentDropzone = {
            url: '{{ url('/dropzone/store_media') }}',
            maxFilesize: 2, // MB
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function (file, response) {
                $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">')
                uploadedDocumentMap[file.name] = response.name
            },
            removedfile: function (file) {
                file.previewElement.remove()
                var name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedDocumentMap[file.name]
                }
                $('form').find('input[name="document[]"][value="' + name + '"]').remove()
            },
            init: function () {
                var file_tet =
                    {!! json_encode($image_r) !!}
                    for(var img of file_tet) {
                        var mockFile = { name: "myimage.jpg", size: 12345, type: 'image/jpeg' };
                        this.options.addedfile.call(this, mockFile);
                        this.options.thumbnail.call(this, mockFile, img);
                        mockFile.previewElement.classList.add('dz-success');
                        mockFile.previewElement.classList.add('dz-complete');
                        $('form').append('<input type="hidden" name="document[]" value="' + img + '">')
                    }
                    @if(isset($project) && $project->document)
                var files =
                {!! json_encode($project->document) !!}
                    for (var i in files) {
                    var file = files[i]
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="document[]" value="' + file.file_name + '">')
                }
                @endif
            }
        }
    </script>
@endsection
