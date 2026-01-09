  {{-- 
      This is a Comment}}
        <!-- This is and HTML commment 
        <h1> About Us </h1>
        <h2>Name :{{ $name }}</h2>
        <h2>Id :{{ $id }}</h2>
        -->
         {{-- @for($i=0;$i<10;$i++)
            <p>{{ $i }}</p>

            @if($i==5)
                <h1>Hi this is {{ $i }}</h1>
            @endif
        @endfor 
        @include('SubViews.Input',[
            'myName'=> $name,
        ])
 </body>
</html>--}}
@extends('layouts.app')


@section('scripts')
    <script>
       alert('hi');
    </script>
@endsection

@section('styles')
<style>
body{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, Helvetica, sans-serif;
}

/* Header */
header{
    background: #0a57a5;
    padding: 15px 0;
    text-align: center;
}

.menu{
    list-style: none;
}

.menu li{
    display: inline-block;
    margin: 0 30px;
}

.menu a{
    color: white;
    text-decoration: none;
    font-size: 16px;
}

.menu a:hover{
    text-decoration: underline;
}

/* Layout */
.container{
    display: flex;
    min-height: 70vh;
}

/* Sidebar */
.sidebar{
    width: 25%;
    background: #f3f3f8;
    padding: 30px;
}

.sidebar h2{
    margin-bottom: 10px;
}

.sidebar ul{
    margin-top: 10px;
}

.sidebar a{
    text-decoration: none;
    color: #0000ee;
}

/* Content */
.content{
    width: 75%;
    padding: 30px;
}

.content h2{
    margin-bottom: 10px;
}

/* Footer */
footer{
    background: #0a57a5;
    color: white;
    text-align: center;
    padding: 10px;
}
</style>
@endsection

@section('content')
<section class="content">
        <h2>About Us</h2>
        <p>This is a simple HTML and CSS template to start your project.</p>
    </section>
@endsection

