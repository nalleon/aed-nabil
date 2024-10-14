<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Nabil L. A.">
        <title>Text-Editor</title>

    <!-- Place the first <script> tag in your HTML's <head> -->
    <script src="https://cdn.tiny.cloud/1/qdvdd8tyz5esi9gx8vpwswskcac495havta2lzpyaiwyhvp6/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

    <!-- Place the following <script> and <textarea> tags your HTML's <body> -->
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: [
            // Core editing features
            'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
            // Your account includes a free trial of TinyMCE premium features
            // Try the most popular premium features until Oct 28, 2024:
            'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown',
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
            <div class="action-container">
                <h2>Text editor</h2>
                <form action="{{ url('write-text') }}" method="POST">
                    @csrf
                    <input type="hidden" id="username" name="username" value="{{ $username }}"></input>
                    <input type="text" id="filename" name="filename" placeholder="File's name"></input>
                    </br>
                    <textarea id="editor" name="content" rows="20" cols="80"></textarea>
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


    </body>
</html>
