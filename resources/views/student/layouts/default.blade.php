<!DOCTYPE html>
<html lang="en">
    <head>
        @include('student.includes.head')
    </head>
    <body>
        <!-- Responsive navbar-->
       @include('student.includes.nav')
        @yield('abcd')
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{asset('student/js/scripts.js')}}"></script>
     
    </body>
</html>