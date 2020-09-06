  $(document).ready(function() { 

    loadFilms("name","asc");

    $('#addFilmDiv').hide();


    $("#addBtn").click(function() { 

      if ($('#addFilmDiv').is(':visible')) {


       $('#addFilmDiv').hide();
       $('#name, #year').val('');

     } else {
       $('#addFilmDiv').show();
     }
   }); 


    $("#setFilm").click(function() { 
     var year2 = $('#year').val();
     var nameReal = $('#name').val();
     var name2 = nameReal.toLowerCase();
     var nameForSearch = name2.split(" ").join("+"); 
     nameForSearch = nameForSearch+year2+"+imdb";

     $.ajax({
      type: "POST",
      url: "Controllers/googleSearch.php",
      data: { str:nameForSearch },
      success: function(linkImdb){

       $.ajax({
        type: "POST",
        url: "Controllers/queryImdb.php",
        data: { linkImdb: linkImdb },
        success: function(noteImdb){

          if(name2 != "" && year2 !=""){

           $.ajax({
            type: "POST",
            url: "Controllers/getFilmsController.php",
            data: { name: name2, year: year2, note:noteImdb, link:linkImdb, addFilm:"true" },
            success: function(data3){
              console.log(data3);
              loadFilms("name","asc");
              $('#name, #year').val('');
              
              getAllInfo(linkImdb, nameReal, year2);
            }
          });
         }
       }
     });
     }
   });



   }); 

    $("#btnAsc").click(function() { 
     loadFilms("year","asc");

   }); 
    $("#btnDes").click(function() { 
     loadFilms("year","desc");

   }); 
    

    $( "#searchFilm" ).keyup(function() {
     var searchFilm = $('#searchFilm').val();
     searchFilm = searchFilm.toLowerCase();
     $.ajax({
      type: "POST",
      url: "Controllers/getFilmsController.php",
      data: { name: searchFilm, searchFilm:"true" },
      success: function(data){

        $("#result").html(data);

      }
    });


   });


  }); 
  function getAllInfo(linkI,nameFilm, yearFilm){
    var linkImage="";
    description="";
    director="";
    duration="";
    genre="";
    stars="";
    
    $.ajax({
      type: "POST",
      url: "Controllers/getAllInfo.php",
      data: { linkImdb: linkI, getImg:"true" },
      success: function(data){
        linkImage=data;
        
        $.ajax({
          type: "POST",
          url: "Controllers/getAllInfo.php",
          data: { linkImdb: linkI, getDesc:"true" },
          success: function(data){

            description=data;
            
            $.ajax({
              type: "POST",
              url: "Controllers/getAllInfo.php",
              data: { linkImdb: linkI, getDirect:"true" },
              success: function(data){

                director=data;
                
                
                console.log("director: "+director+"  descripcion: "+description+"link img: "+linkImage);
                $.ajax({
                  type: "POST",
                  url: "Controllers/getAllInfo.php",
                  data: { linkImdb: linkI, getDuration:"true" },
                  success: function(data){

                    alert(data);
                    duration=data;

                    $.ajax({
                     type: "POST",
                     url: "Controllers/getAllInfo.php",
                     data: { linkImdb: linkI, getGenre:"true" },
                     success: function(data){
                      genre=data;
                      alert(genre);
                      $.ajax({

                       type: "POST",
                       url: "Controllers/getAllInfo.php",
                       data: { linkImdb: linkI, getStars:"true" },
                       success: function(data){
                        stars=data;
                        alert(stars);
                        $.ajax({
                          type: "POST",
                          url: "Controllers/getFilmsController.php",
                          data: { name: nameFilm, year: yearFilm, linkImg:linkImage, infoDescription:description,
                           infoDirector:director, infoDuration:duration, infoGenre:genre, infoStars:stars, updateFilm:"true" },
                           success: function(data){
                            console.log(data);


                          }
                        });
                      }
                    });
                    }
                  });


                  }
                });


              }
            });

          }
        });

      }
    });
    
    
  }

  $(document).on('click', '.film', function () {
   var idFilm= $(this).attr("id");

   idFilm=idFilm.substr(4);
   idFilmNum=parseInt(idFilm);
   $('body').append('<div id="newDiv"></div>');
   searchFilmById(idFilm);
 });
  $(document).on('click', '#closeImg', function () {
    $('div').remove('#newDiv');
  });

  function searchFilmById(idFilmNum){

    $.ajax({
      type: "POST",
      url: "Controllers/getFilmsController.php",
      data: { id: idFilmNum, searchFilmById:"true" },
      success: function(data){

        $("#newDiv").html(data);

      }
    });
  }

  function loadFilms(column,order){

    $.ajax({
      type: "POST",
      url: "Controllers/getFilmsController.php",
      data: { orderBy: column, order: order, getFilms:"true" },
      success: function(data){

        $("#result").html(data);

      }
    });
  };

