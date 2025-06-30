<!doctype html>
<html lang="en">

<head>
    @include('includes.___head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body >
    @include('static.__header')

    @include('components._hero')

        {{-- @include('components._service') --}}

    @include('components.about')

     @include('components.filiere')
 
     @include('components._temoignage')
        @include('components.blog')


  @include('static.__footer')


    <div id="overlayer"></div>
    <div class="loader">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    @include('includes.___script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>
