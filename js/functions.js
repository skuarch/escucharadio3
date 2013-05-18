var loader = "<div class='_19'><img = src='images/ajax-loader.gif' alt='' /><br/><br/>cargando</div>";
var limit1 = 0;
var limit2 = 14;
var totalStations = 0;
var stations = new Array();
var ajax;

//==============================================================================
$(document).ready(function() {    

    if (navigator.userAgent.search("mobile") > 0 || navigator.userAgent.search("Mobile") > 0) {
        alert("proximamente tendremos aplicacion para moviles");
    }

    playByGet();

    ajaxStations();

    //stop selection************************************************************
    document.onselectstart = function() {
        return false;
    };
    //no context menu
    $(this).bind("contextmenu", function(e) {
        e.preventDefault();
    });

    ajaxTotalStations();
    ajaxGet("3.php", 45);
    ajaxGet("16.php", 46);
    ajaxGet("15.php", 47);    

});

//==============================================================================
function innerHtml(id, text) {
    $('#' + id).html(text);
} // end change menu

function deleteCookies() {
    document.cookie = "cookieStations = ''|" + ";max-age=1; path=/;";
    document.cookie = "cookieStations = ''|" + ";max-age=0; path=/;";
    ajaxCookieStations();
}

//==============================================================================
function playByGet() {

    var array = new Array();
    var idGet = getUrlVars()["id"];

    if (idGet != undefined) {

        if (isNaN(idGet)) {
            return;
        }

        //con el id obtener los datos necesarios y correr el player
        $.ajax({
            type: 'post',
            url: '4.php',
            data: {
                id: idGet,
                param: Math.random()
            },
            cache: false,
            success: function(data) {
                array = data.split("|");
                player(array[2], "play", array[3]);

                addCookieStation(array[0]);
            },
            error: function() {
                //alert("A ocurrido un error inexperado,\nestamos trabajando en solucionarlo");
            }
        });
    } else {
        player("http://50.117.26.26:3565/Live", "stop", 1);
    }
} // end playByGet

//==============================================================================
function ajaxStations() {

    $('#12').html(loader);

    $.ajax({
        type: 'post',
        url: '1.php',
        data: {
            limit1: limit1,
            limit2: limit2,
            param: Math.random()
        },
        cache: false,
        success: function(data) {
            $("#12").hide();
            $("#12").html(data);
            $("._15").corner("left 5px");
            $("._16").corner("right 5px");
            $("#12").slideDown("slow");
        },
        error: function() {
            //alert("A ocurrido un error inexperado,\nestamos trabajando en solucionarlo");
        }
    });

} // end ajaxStations

//==============================================================================
function ajaxGenre() {

    $('#12').html(loader);

    $.ajax({
        type: 'post',
        url: '17.php',
        data: {
            limit1: limit1,
            limit2: limit2,
            param: Math.random()
        },
        cache: false,
        success: function(data) {
            $("#12").hide();
            $("#12").html(data);
            $("._38").corner("left 5px");
            $("._39").corner("right 5px");
            $("#12").slideDown("slow");
        },
        error: function() {
            //alert("A ocurrido un error inexperado,\nestamos trabajando en solucionarlo");
        }
    });

} // end ajaxgenre

//==============================================================================
function ajaxFirtsStations() {
    limit1 = 0;
    limit2 = 14;
    ajaxStations();
}

//==============================================================================
function player(stationUrl, status, playerType) {

    if (stationUrl == "" || status == "") {
        return;
    }

    if (playerType == 1) {

        //shoutchast

        stationUrl += "/;stream/1";

        $("#jquery_jplayer_1").jPlayer({
            ready: function() {
                $(this).jPlayer("setMedia", {
                    mp3: stationUrl

                }).jPlayer(status);
            },
            //repeatOff: '.jp-repeat-off',
            //warningAlerts: true,
            //preload: 'metadata',
            errorAlerts: false,
            swfPath: "js/",
            supplied: "mp3,m4a,aacp,oga",
            volume: 0.4,
            solution: "flash,html",
            wmode: "window"

        });

    } else {

        //Icecast

        $("#jquery_jplayer_1").jPlayer({
            ready: function() {
                $(this).jPlayer("setMedia", {
                    //mp3:stationUrl
                    oga: stationUrl

                }).jPlayer(status);
            },
            //repeatOff: '.jp-repeat-off',
            //warningAlerts: true,
            //preload: 'metadata',
            errorAlerts: false,
            swfPath: "js/",
            //supplied: "mp3,m4a,aacp,oga",
            supplied: "oga",
            volume: 0.4,
            solution: "flash,html",
            wmode: "window"

        });

    }

} // end player

//==============================================================================
function getUrlVars() {

    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m, key, value) {
        vars[key] = value;
    });
    return vars;

} // end getUrlVars

//==============================================================================
function ajaxTotalStations() {

    $.ajax({
        type: 'post',
        url: '5.php',
        cache: 'false',
        success: function(data) {
            totalStations = data;
        },
        error: function(error) {
            //alert("error pidiendo estaciones");
        }
    });

} // end ajaxLimitMax

//==============================================================================
function pagerBefore() {

    if (limit1 <= 0) {
        limit1 = 0;
    } else {
        limit1 = limit1 - 13;
        ajaxStations();
    }
} // end pagerBefore

//==============================================================================
function pagerAfter() {

    if (limit1 + 13 >= totalStations) {
        return;
    }

    limit1 = limit1 + 13;
    ajaxStations();
} // end pagerAfter

//==============================================================================
function setStationName(stationName) {
    
    alertify.success("reproduciendo <b>" + stationName + "</b>");
    $(".jp-title").html(stationName);

} // end setStationName

//==============================================================================
function recordClick(stationId) {

    //primero buscar en la cookie si ya le dio click,
    //si ya le dio click no se registra

    var cookieStations = getCookie('cookieStations');
    var arrayStations = new Array();

    //the stations exists
    if (cookieStations != null) {

        //find station in a cookie
        arrayStations = cookieStations.split("|");
        for (var i = 0; i < arrayStations.length; i++) {
            if (arrayStations[i] == stationId) {
                return;
            }
        }
    }

    $.ajax({
        type: 'post',
        url: '7.php',
        data: {
            stationId: stationId,
            random: Math.random()
        },
        cache: 'false',
        success: function(data) {
            //alert(data);
        },
        error: function(error) {
            //alert("error guardando la estacion");
        }
    });

}// end recordClick

//==============================================================================
function addCookieStation(idStation) {

    var cookieStations = getCookie('cookieStations');
    var arrayStations = new Array();

    //the stations exists
    if (cookieStations != null) {

        //find station in a cookie
        arrayStations = cookieStations.split("|");
        for (var i = 0; i < arrayStations.length; i++) {
            if (arrayStations[i] == idStation) {
                return;
            }
        }

        //add new station
        cookieStations += idStation + "|";
        //document.cookie = "cookieStations = " + cookieStations + ";max-age=2592000; path=/;";
        //setCookie('cookieStations', cookieStations, 2592000);
        document.cookie = "cookieStations = "+cookieStations+"; path=/; expires=" + new Date( new Date().getTime()+86400000*30 ).toGMTString();

    } else {

        //maybe is the firts time here, create a cookie
        //document.cookie = "cookieStations = " + idStation + "|" + ";max-age=2592000; path=/;";
        document.cookie = "cookieStations = "+idStation+ "|"+"; path=/; expires=" + new Date( new Date().getTime()+86400000*30 ).toGMTString();

    }
        
} // end addCookieStation

//==============================================================================
function deleteFavoritesStation(idStation) {

    if (isNaN(idStation)) {
        return;
    }

    var cookieStations = getCookie('cookieStations');
    var arrayStations = new Array();
    var tmp = new Array();

    //the stations exists
    if (cookieStations != null) {

        //find station in a cookie
        arrayStations = cookieStations.split("|");
        for (var i = 0; i < arrayStations.length; i++) {

            if (arrayStations[i] == ',' || arrayStations[i] == '') {
                continue;
            }

            if (arrayStations[i] == idStation) {
                continue;
            } else {
                arrayStations[i].replace(',', '');
                tmp.push(arrayStations[i] + "|");
            }
        }

        //document.cookie = "cookieStations = " + tmp + ";max-age=2592000; path=/;";
        document.cookie = "cookieStations = "+tmp+"; path=/; expires=" + new Date( new Date().getTime()+86400000*30 ).toGMTString();
    }

    ajaxCookieStations();

} // end deleteFavoritesStation


//==============================================================================//==============================================================================
function getCookie(c_name) {
    var r, i, x, y, ARRcookies = document.cookie.split(";");
    for (i = 0; i < ARRcookies.length; i++)
    {
        x = ARRcookies[i].substr(0, ARRcookies[i].indexOf("="));
        y = ARRcookies[i].substr(ARRcookies[i].indexOf("=") + 1);
        x = x.replace(/^\s+|\s+$/g, "");
        if (x == c_name)
        {
            r = unescape(y);
            r = r.replace(/\,/g, ' ');
            return r;
        }
    }

    return null;
}// end getCookie

//==============================================================================
function addRowTable(idTable, content) {

    $('#' + idTable + ' tr:last').before('<tr><td>' + content + '</td></tr>');

} // end addRowTable

//==============================================================================
function ajaxCookieStations() {

    $("#12").html(loader);

    var cData = getCookie('cookieStations');

    if (cData == null) {
        $("#12").html("aun no cuentas con estaciones favoritas, reproduce cualquier estacion y esta aparecera aqui");
        return;
    }

    $.ajax({
        type: 'post',
        url: '8.php',
        data: {
            cookieStations: getCookie('cookieStations')
        },
        cache: 'false',
        success: function(data) {
            $('#12').hide();
            $('#12').html(data);
            $("._35").corner("left 5px");
            $("._33").corner("right 5px");
            $('#12').slideDown();
        },
        error: function(error) {
            alert("error leyendo las estaciones");
        }
    });

} // end ajaxCookieStations

//==============================================================================
function launcher(stationId, stationUrl, stationName, playerType) {

    var link = "<a href=\"javascript:launcher('" + stationId + "','" + stationUrl + "','" + stationName + "', " + playerType + ")\"> " + stationName + " </a>";
    var found = false;

    for (i = 0; i < stations.length; i++) {

        if (stations[i] == stationName) {
            found = true;
            break;
        }

    }

    if (found == false) {
        stations.push(stationName);
        addRowTable('playerList', link);
    }

    $('#jquery_jplayer_1').jPlayer('stop');
    $('#jquery_jplayer_1').jPlayer('destroy');
    player(stationUrl, 'play', playerType);
    setStationName(stationName);

    //save click
    recordClick(stationId);

    //save stationId in a cookie
    addCookieStation(stationId);

} // end launcher

//==============================================================================
function ajaxCountries() {

    $("#12").html(loader);

    $.ajax({
        type: 'post',
        url: '10.php',
        cache: 'false',
        success: function(data) {
            $('#12').hide();
            $('#12').html(data);
            $("._38").corner("left 5px");
            $("._39").corner("right 5px");
            $('#12').slideDown();
        },
        error: function(error) {
            //alert("error obteniendo estaciones");
        }
    });

}

//==============================================================================
function stationCountriesShow(id) {

    $('#12').html(loader);

    $.ajax({
        type: 'post',
        url: '9.php',
        data: {
            id: id,
            param: Math.random()
        },
        cache: 'false',
        success: function(data) {

            $("#12").hide();
            $("#12").html(data);
            $("#12").slideDown();
            $("._38").corner("left 5px");
            $("._39").corner("right 5px");

        },
        error: function(error) {
            $('#12').html('a surgido un error por favor intente despues');
        }
    });

}

//==============================================================================
function ajaxSearch() {

    $('#12').html(loader);

    $.ajax({
        url: "11.php",
        type: "POST",
        success: function(data) {
            $("#12").hide();
            $("#12").html(data);
            $("._41").corner("right 5px");
            $("#12").slideDown();
        },
        error: function(error) {
            //alert("en este momento no se pueden realizar busquedas\npor favor intentelo en otro momento");
        }
    });
}

//==============================================================================
function search(string) {

    if (string == "" || string.length < 1) {
        return;
    }

    $.ajax().abort();

    $("#12").html(loader);

    $.ajax({
        data: "string=" + string,
        url: "12.php",
        type: "POST",
        success: function(data) {
            $("#12").hide();
            $("#12").html(data);
            $("._38").corner("left 5px");
            $("._39").corner("right 5px");
            $("#12").slideDown();
        },
        error: function(error) {
            //alert("en este momento no se pueden realizar busquedas\npor favor intentelo en otro momento\n"+error);
        }
    });
}

//==============================================================================
function ajaxGet(url, identifier) {

    $("#" + identifier).html("<div class='_45'><img = src='images/ajax-loader.gif' alt='' /><br/><br/>cargando</div>");

    $.ajax({
        url: url,
        type: "POST",
        success: function(data) {
            $("#" + identifier).hide();
            $("#" + identifier).html(data);
            $("#" + identifier).slideDown();
        },
        error: function(error) {
            //alert("en este momento no se pueden realizar busquedas\npor favor intentelo en otro momento\n"+error);
        }
    });
}

//==============================================================================
function addStation() {

    var error = "";
    var nombreEstacion = document.form1.nombreEstacion.value;
    var urlStreaming = document.form1.urlStreaming.value;
    var genero = document.form1.genero.value;
    var frecuencia = document.form1.frecuencia.value;
    var descripcion = document.form1.descripcion.value;
    var estado = document.form1.estado.value;
    var pais = document.form1.pais.value;
    var lenguaje = document.form1.lenguaje.value;
    var tipo = document.form1.tipo.value;
    var sitioWeb = document.form1.sitioWeb.value;

    if (nombreEstacion == "" || nombreEstacion == undefined) {
        error += "-Falta el nombre de la estacion\n";
        $("#errorNombreEstacion").html("-Falta el nombre de la estacion\n");
    }

    if (urlStreaming == "" || urlStreaming == undefined) {
        error += "-Falta la url de streaming";
        $("#errorUrlStreaming").html("-Falta la url de streaming");
    }

    if (error.length > 0) {
        alert("Error: \n\n" + error);
    } else {
        $.ajax({
            type: 'post',
            url: '19.php',
            data: {
                nombreEstacion: nombreEstacion,
                urlStreaming: urlStreaming,
                genero: genero,
                frecuencia: frecuencia,
                descripcion: descripcion,
                estado: estado,
                pais: pais,
                lenguaje: lenguaje,
                tipo: tipo,
                sitioWeb: sitioWeb
            },
            cache: 'false',
            success: function(data) {
                alert(data);
                //alert("la estacion se guardo correctamente \n\nGRACIAS");
            },
            error: function(error) {
                alert("error " + error);
            }
        });
    }

} // end addStation


//==========================================================================
function selectGenre(genreId) {

    $('#12').html(loader);

    $.ajax({
        type: 'post',
        url: '21.php',
        data: {
            genreId: genreId,
            param: Math.random()
        },
        cache: false,
        success: function(data) {
            $("#12").hide();
            $("#12").html(data);
            $("._38").corner("left 5px");
            $("._39").corner("right 5px");
            $("#12").slideDown("slow");
        },
        error: function() {
            //alert("A ocurrido un error inexperado,\nestamos trabajando en solucionarlo");
        }
    });

} // end selectGenre

function saveUserNavigator(){    

    $.ajax({

        url:"22.php",
        type: "POST",
        data:{
            appVersion:navigator.appVersion,
            userAgent:navigator.userAgent,
            appName:navigator.appName
        },
        success:function(){            
        },error:function(){
         //alert("A ocurrido un error inexperado,\nestamos trabajando en solucionarlo");   
        }

    });
}