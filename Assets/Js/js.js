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
    url: "controllers/ajaxController.php",
    data: { name: searchFilm, searchFilm:"true" },
    success: function(data){

      $("#result").html(data);

    }
  });
 });

  $("#setFilm").click(function() { 
   var year2 = $('#year').val();
   var nameReal = $('#name').val();
   var name2 = nameReal.toLowerCase();
   var nameForSearch = name2.split(" ").join("+"); 
   nameForSearch = nameForSearch+"+"+year2+"+imdb";

   $.ajax({
    type: "POST",
    url: "controllers/ajaxController.php",
    data: { findFilm:nameForSearch },
    success: function(linkImdb){

     $.ajax({
      type: "POST",
      url: "controllers/ajaxController.php",
      data: { linkImdb: linkImdb },
      success: function(noteImdb){

        if(name2 != "" && year2 !=""){

         $.ajax({
          type: "POST",
          url: "controllers/ajaxController.php",
          data: { name: name2, year: year2, note:noteImdb, link:linkImdb, addFilm:"true" },
          success: function(data3){
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
    url: "controllers/ajaxController.php",
    data: { link: linkI, getImg:"true" },
    success: function(data){
      linkImage=data;
      
      $.ajax({
        type: "POST",
        url: "controllers/ajaxController.php",
        data: { linkDes: linkI, getDesc:"true" },
        success: function(data){

          description=data;
          
          $.ajax({
            type: "POST",
            url: "controllers/ajaxController.php",
            data: { linkDirec: linkI, getDirect:"true" },
            success: function(data){

              director=data;
              
              $.ajax({
                type: "POST",
                url: "controllers/ajaxController.php",
                data: { linkDura: linkI, getDuration:"true" },
                success: function(data){

                  duration=data;
                  $.ajax({
                   type: "POST",
                   url: "controllers/ajaxController.php",
                   data: { linkgenr: linkI, getGenre:"true" },
                   success: function(data){
                    genre=data;
                    
                    $.ajax({

                     type: "POST",
                     url: "controllers/ajaxController.php",
                     data: { linkStars: linkI, getStars:"true" },
                     success: function(data){
                      stars=data;

                      $.ajax({
                        type: "POST",
                        url: "controllers/ajaxController.php",
                        data: { name: nameFilm, linkImg:linkImage, infoDescription:description,
                         infoDirector:director, infoDuration:duration, infoGenre:genre, infoStars:stars, updateFilm:"true" },
                         success: function(data){
                          


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

$(document).on('click', '#closeNew', function () {
  $('div').remove('#newDiv');
});
$(document).on('click', '#closeThanks', function () {
  $('div').remove('#thanksDiv');
});


$(document).on('click', '#btnScore', function () {
 var score=$('.inputScore').val();
 var fScore=parseFloat(score);
 var idFilm= $('.inputScore').attr("id");
 idFilm=idFilm.substr(5);
 idFilmNum=parseInt(idFilm);
 toVote(idFilmNum,fScore);
});

function toVote(idFilm, score){
  
  $.ajax({
    type: "POST",
    url: "controllers/ajaxController.php",
    data: { id: idFilm, scoreFilm:score, voteFilm:"true" },
    success: function(data){

      
     $('#newDiv').append('<div id="thanksDiv"></div>');
     $('#thanksDiv').append("<img id='closeThanks' class='closeImg' src='Assets/Img/cancel-icon.png' alt=''>");
     $('#thanksDiv').append('<h3>¡Muchas gracias!</h3><p>Tu voto ha sido registrado correctamente</p>');
     

   }
 });
}

function searchFilmById(idFilmNum){

  $.ajax({
    type: "POST",
    url: "controllers/ajaxController.php",
    data: { id: idFilmNum, searchFilmById:"true" },
    success: function(data){

      $("#newDiv").html(data);

    }
  });
}


function loadFilms(column,order){

  $.ajax({
    type: "POST",
    url: "controllers/ajaxController.php",
    data: { orderBy: column, order: order, getFilms:"true" },
    success: function(data){

      $("#result").html(data);

    }
  });
};

