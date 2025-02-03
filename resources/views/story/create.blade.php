@extends( 'layouts.website')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center text-primary mt-8"> Share Your Stories</h1>
            <form action="{{ route('stories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="title" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="category" class="form-label">Category</label>
                    <input type="text" name="category" id="category" class="form-control" required>
                </div>
                    <label for="content" class="form-label">Content</label>
                    <input type="hidden" name="author_id" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="published_at" value="{{ now() }}">
                    {{-- <input type="hidden" name="category" value="default"> --}}
                    <textarea name="content" id="content" class="form-control" rows="5" required></textarea>
                </div>
                <div class="form-group">
                    <label for="image_url" class="form-label">Image URL</label>
                    <input type="url" name="image_url" id="image_url" class="form-control">
                </div>
                <div class="form-group text-center mt-4">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        
        </div>
    </div></div>
    @endsection