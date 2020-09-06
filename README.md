# filmoteca-v2


Se trata de una ampliación del proyecto: [https://github.com/soniaArenas/filmoteca](https://github.com/soniaArenas/filmoteca)

He incluido ciertas apliaciones y mejoras de las cuales ya hablé en el archivo readme.md del proyecto. 

Se puede visitar la web ya implementada en: 
[http://soniapuente.com/nuevaFilmoteca/](http://soniapuente.com/nuevaFilmoteca/)



# Mejoras

En cuanto a los controladores que manejaban la información que se debía de obtener o insertar en la base de datos, los he colocado en un mismo archivo, a la consulta de Ajax le paso otro parámetro para que el controlador sepa la acción que tiene que ejecutar y a que modelo llamar.
En cuanto a funcionalidad:
Cuando se inserta una película, automáticamente la web busca en google el link de Imdb de la película insertada. 
Accede al link y obtiene los datos que le hemos solicitado para guardarlos en la base de datos.
Al clickar en una de las películas que aparecen en la lista, se abre un div creado dinámicamente, con toda la información que deseamos mostrar y que hemos obtenido mediante web scraping.
