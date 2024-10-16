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

        <title>Text-Editor - Edit</title>
        <link rel="stylesheet" href="{{ asset('style/text-editor.css') }}">
    </head>

    <body class="antialiased">
        <div class="logout">
            <form action="{{url('/logout')}}" method="POST">
                @csrf
                <input type="submit" value="Logout">
            </form>
        </div>

        </br>
        <div class="main-container">
            <br>
            <div class="action-container">
                <form action="{{ url('/edit-file/edit') }}" method="POST">
                    @csrf
                    <input type="text" id="filename" name="filename" value="{{$file}}"></input>
                    </br>
                    </br>
                    <textarea id="editor" name="content" rows="20" cols="80" placeholder="Write here">
                        {{$content}}
                    </textarea>
                    </br>
                    </br>
                    <input type="submit" id="submit" value="Updated">
                </form>
            </div>
            <br>

        </div>

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
