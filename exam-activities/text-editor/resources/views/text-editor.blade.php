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

    </head>

    <body class="antialiased">
        @php
            $user = session('user');
            if(!$user){
                return redirect('login');
            }

            $username = $user->getUsername();
        @endphp



        <div class="main-container">
            <div class="logout">
                <form action="logout" method="POST">
                    @csrf
                    <input type="submit" value="Logout">
                </form>
            </br>
                <span>Welcome, {{ $username }}</span>
            </div>

            <div class="files">
                <h2>Files</h2>
                <ul>
                    @foreach (Storage::directories('/'.$username) as $directory)
                        <li> <a href="{{ url('file-content/'.$directory) }}">{{ $directory }}</a></li>
                    @endforeach
                </ul>

            </div>

            <div class="action-container">
                <h2>Text editor</h2>
                <form action="{{ url('write-text') }}" method="POST">
                    @csrf
                    <input type="hidden" id="username" name="username" value="{{ $username }}"></input>
                    <input type="text" id="filename" name="filename" placeholder="File's name"></input>
                    </br>


                    <textarea id="editor" name="content" rows="20" cols="80" placeholder="Write here">
                    </textarea>
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


        </div>


        <script>
            document.querySelector('form').addEventListener('submit', function(event) {
                event.preventDefault();
                document.getElementById('contenido').value = tinymce.activeEditor.getContent();
                console.log("dice: "+tinymce.activeEditor.getContent());
                this.submit();
            });
        </script>
    </body>
</html>
