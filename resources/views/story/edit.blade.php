@extends( 'layouts.admin')

@section('content')
<div class="bg-gray-100">
    <div class="row">
        <div class="col-md-8 offset-md-2 ">
            <h1 class="text-center text-black mt-8">Edit Story</h1>
            <form action="{{ route('stories.update', $story->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="title" class="text-white">Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $story->title }}" required>
                </div>

                <div class="form-group">
                    <label for="content" class="text-white">Content</label>
                    <textarea name="content" class="form-control  w-full" rows="16" required>{{ $story->content }}</textarea>
                </div>

                <div class="form-group">
                    <label for="image_url" class="text-white">Image URL</label>
                    <input type="url" name="image_url" class="form-control" value="{{ $story->image_url }}">
                </div>

                <div class="form-group">
                    <label for="category" class="text-white">Category</label>
                    <input type="text" name="category" class="form-control" value="{{ $story->category }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Update Story</button>
            </form>

         </div>

 
    </div>
@endsection