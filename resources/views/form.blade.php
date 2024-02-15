<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <form action="{{url('/form-store')}}" method="post">
    @csrf
<label>name</label>
<input type="text" name="fname">

<button type="submit">Submit</button>


   </form> 

  
        @foreach($formData as $formDatas)
            {{ $formDatas->fname }}<br>
        @endforeach
  

</body>
</html>