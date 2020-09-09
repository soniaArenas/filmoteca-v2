<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Filmoteca</title>
  <link href="https://fonts.googleapis.com/css2?family=Merienda&display=swap" rel="stylesheet">
  <link rel="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="Assets/Css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
  <h1 id="title">Películas</h1>
  <div id="content">
    <div id="searchDiv">
      <input type="text" placeholder="Buscar..." id="searchFilm">
      <button class="btn" id="btnAsc">Ordenar por año ascendente</button>
      <button class="btn" id="btnDes">Ordenar por año descendente</button>
      <button class="btn" id="addBtn">Añadir película</button>
    </div>

    <div id="addFilmDiv">
      <input type="text" placeholder="Nombre" id="name">
      <input type="text" placeholder="Año" id="year">
      <button class="btn" id="setFilm">Añadir</button>
    </div>
    
    
<div id="result"></div>
      






 <script src="Assets/Js/js.js"></script> 
 
</body>
</html>