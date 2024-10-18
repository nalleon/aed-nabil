<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Nabil L. A.">
    
    <script src="https://cdn.tiny.cloud/1/qdvdd8tyz5esi9gx8vpwswskcac495havta2lzpyaiwyhvp6/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: [
            'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
            ],
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
                tinycomments_mode: 'embedded',
                tinycomments_author: 'Author name',
                mergetags_list: [
                    { value: 'First.Name', title: 'First Name' },
                    { value: 'Email', title: 'Email' },
                ],
                ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
        });
    </script>

    <title>Files in Directory: {{ $directory }}</title>
    <link rel="stylesheet" href="{{ asset('style/directory-files.css') }}">
</head>
<body>
    @php
        $user = session('user');
        if(!$user){
            return redirect()->route('login');
        }

        $username = $user->getUsername();
    @endphp
    
    <div name="main-container">
        <div class="file-versions">

            <h2>Files in: {{ $directory }}</h2>
            <h3>Versions:</h3>
            @if(count($files) > 0)
                <ul>
                    @foreach ($files as $file)
                        <li>
                            <form action="{{ url('/edit-file') }}" method="POST">
                                @csrf
                                <input type="hidden" name="filename" value="{{ $file }}">
                                <input type="hidden" name="username" value="{{ $username }}">
                                <input type="submit" value="{{ basename($file) }}">
                            </form>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>No files found in this directory.</p>
            @endif

        </div>

        <div class="file-editor">
            
            <h3>Editing last file: {{basename($recentFile)}}</h3>
            <form action="{{ url('/edit-file/edit') }}" method="POST">
                @csrf
                <textarea id="editor" name="content" rows="20" cols="80" placeholder="Write here">
                    {{$content}}
                </textarea>
                <input type="submit" value="Update">
            </form>
            </div>

        <div class="back">
            <form action="{{ url('/text-editor') }}" method="GET">
                <input type="submit" value="Back to main page">
            </form>

        </div>
    </div>
    <br>
    <script>
        document.querySelector('form').addEventListener('submit', function(event) {
            event.preventDefault();
            document.getElementById('editor').value = tinymce.activeEditor.getContent();
            console.log("dice: "+tinymce.activeEditor.getContent());
            this.submit();
        });
    </script>
</body>
</html>
