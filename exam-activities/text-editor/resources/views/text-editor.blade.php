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

        <title>Text-Editor</title>
        <link rel="stylesheet" href="{{ asset('style/text-editor.css') }}">
    </head>

    <body class="antialiased">
        <div class="outer-container">
            <div class="logout">
                <form action="{{url('/logout')}}" method="POST">
                    @csrf
                    <input type="submit" value="Logout">
                </form>
            </div>

            </br>
            <div class="main-container">

                <h1>Welcome, {{ $username }}!</h1>


                <div class="files">
                    <div class="private-files">
                        <h2>Your files:</h2>
                        <ul>
                            @foreach ($directories as $directory)
                                <li>
                                    <a href="{{ url('directory-files/' . $username . '/' . basename($directory)) }}">
                                        {{ basename($directory) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    </br>
                    <div class="public-files">
                        <h2>Public files:</h2>
                        <ul>
                            @foreach ($publicDirectories as $directory)
                                <li>
                                    <a href="{{ url('directory-files/public/' . basename($directory)) }}">
                                        {{ basename($directory) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>                
                    </br>
                </div>
                </br>
                <div class="action-container">
                <form action="{{ url('write-text') }}" method="POST" id="">
                        @csrf
                        <input type="hidden" id="username" name="username" value="{{ $username }}"></input>

                        @if (session('message'))
                            <h4>{{ session('message') }}</h4>
                        @endif
                    
                        <input type="text" id="filename" name="filename" placeholder="File's name"></input>
                        </br>
                        </br>
                        <textarea id="editor" name="content" rows="20" cols="80" placeholder="Write here">

                        </textarea>
                        </br>
                        <div class="radio-container">
                            <label for="fileaccess">File access:</label>
                                <input type="radio" id="fileaccess" name="fileaccess" value="public">
                                    Public
                                </input>

                                <input type="radio" id="fileaccess" name="fileaccess" value="private" checked>
                                    Private
                                </input>
                            </label>
                        </div>
                        </br>
                        <input type="submit" id="submit" value="Send">
                    </form>
                </div>
                <br>

            </div>
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
