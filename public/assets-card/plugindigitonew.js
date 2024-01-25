var wd=window;
            if ("serviceWorker" in navigator) {
                console.log("Will the service worker register?");
                navigator.serviceWorker.register("service-worker.js")
                .then(function(reg){
                    console.log("Yes, it did.");
                    window.addEventListener("beforeinstallprompt", function(e) {
            // beforeinstallprompt Event fired

            // e.userChoice will return a Promise. 
            // For more details read: https://developers.google.com/web/fundamentals/getting-started/primers/promises
            e.userChoice.then(function(choiceResult) {

                console.log(choiceResult.outcome);

                if(choiceResult.outcome == "dismissed") {
                console.log("User cancelled home screen install");
                }
                else {
                console.log("User added to home screen");
                }
            });
            });
                }).catch(function(err) {
                    console.log("No it didnt. This happened:", err)
                });
            }

        jQuery( document ).ready(function() {
            var cadena_boton_qr='<a href="#" id="btn_qr"><img src="https://ricopanbakehouse.mybcard.net/wp-content/uploads/2020/08/codigo_qr.png" style="width:40px;display: inherit;margin-right: 0px;padding-right: 0px;margin-left: 3px; margin-bottom: -13px;"></a>';
            jQuery("#wpusb-container-fixed .wpusb-buttons").prepend(cadena_boton_qr);
        });
	


        
        var url_tarjeta_principal="";
        var url_tarjeta_principal_uri="";       

        

        jQuery(function(){

            var btn_share_flotant=`<a href="#" id="btn_boton_share" class="compartir__share_flotante"><span class="fa fa-share-alt"></span></a>`;
            jQuery("body").append(btn_share_flotant);

            jQuery("#btn_boton_share").click(function(e){
                e.preventDefault();
                inicial();
                
                jQuery("#modal_share").modal("show");

            });            
        });
        

        var listado_paises=[
            {nombre:'Afghanistan',codigo:93},
            {nombre:'Albania',codigo:355},
            {nombre:'Alemania',codigo:49},
            {nombre:'Algeria',codigo:213},
            {nombre:'Andorra',codigo:376},
            {nombre:'Angola',codigo:244},
            {nombre:'Anguilla',codigo:1000},
            {nombre:'Antárctica',codigo:672},
            {nombre:'Antigua',codigo:1001},
            {nombre:'Antillas Francesas',codigo:596},
            {nombre:'Antillas Holandesas',codigo:599},
            {nombre:'Arabia Saudita',codigo:966},
            {nombre:'Argentina',codigo:54},
            {nombre:'Armenia',codigo: 374},
            {nombre:'Aruba',codigo: 297},
            {nombre:'Australia',codigo: 61},
            {nombre:'Austria',codigo: 43},
            {nombre:'Azerbaiján',codigo:994},
            {nombre:'Bahamas',codigo:1002},
            {nombre:'Bahía de Guantanamo',codigo:539},
            {nombre:'Bahrain',codigo:973},
            {nombre:'Bangladesh',codigo:880},
            {nombre:'Barbados',codigo:1003},
            {nombre:'Belgica',codigo:32},
            {nombre:'Belice',codigo:501},
            {nombre:'Benin',codigo:229},
            {nombre:'Bermuda',codigo:1004},
            {nombre:'Bhutan',codigo:975},
            {nombre:'Bolivia',codigo:591},
            {nombre:'Bosnia y Herzegovina',codigo:387},
            {nombre:'Botswana',codigo:267},
            {nombre:'Brasil',codigo:55},
            {nombre:'Brunei',codigo:673},
            {nombre:'Bulgaria',codigo:359},
            {nombre:'Burkina Faso',codigo:226},
            {nombre:'Burma',codigo:95},
            {nombre:'Burundi',codigo:257},
            {nombre:'Cambodia',codigo:855},
            {nombre:'Camerún',codigo:237},
            {nombre:'Canada',codigo:1},
            {nombre:'Colombia',codigo:57},
            {nombre:'Comoros',codigo:269},
            {nombre:'Congo',codigo:242},
            {nombre:'Corea',codigo:82},
            {nombre:'Corea del Norte',codigo:850},
            {nombre:'Costa de Marfil',codigo:225},
            {nombre:'Costa Rica',codigo:506},
            {nombre:'Croacia',codigo:385},
            {nombre:'Cuba',codigo:53},
            {nombre:'Chad',codigo:235},
            {nombre:'Chile',codigo:56},
            {nombre:'China',codigo:86},
            {nombre:'Chipre',codigo:357},
            {nombre:'Diego Garcia',codigo:246},
            {nombre:'Dinamarca',codigo:45},
            {nombre:'Djibouti',codigo:253},
            {nombre:'Dominica',codigo:1007},
            {nombre:'Ecuador',codigo:593},
            {nombre:'Egipto',codigo:20},
            {nombre:'El Salvador',codigo:503},
            {nombre:'Emiratos Arabes Unidos',codigo:971},
            {nombre:'Eritea',codigo:291},
            {nombre:'Eslovaquia',codigo:421},
            {nombre:'España',codigo:34},
            {nombre:'Estados Unidos',codigo:1},
            {nombre:'Estonia',codigo:372},
            {nombre:'Etiopía',codigo:251},
            {nombre:'Filipinas',codigo:63},
            {nombre:'Finlandia',codigo:358},
            {nombre:'Francia',codigo:33},
            {nombre:'Gambia',codigo:220},
            {nombre:'Georgia',codigo:995},
            {nombre:'Ghana',codigo:233},
            {nombre:'Gibraltar',codigo:350},
            {nombre:'Granada',codigo:1009},
            {nombre:'Grecia',codigo:30},
            {nombre:'Groelandia',codigo:299},
            {nombre:'Guadalupe',codigo:590},
            {nombre:'Guam',codigo:1671},
            {nombre:'Guatemala',codigo:502},
            {nombre:'Guinea',codigo:224},
            {nombre:'Guinea-Bissau',codigo:245},
            {nombre:'Guinea Ecuatorial',codigo:240},
            {nombre:'Guyana',codigo:592},
            {nombre:'Guyana Francesa',codigo:594},
            {nombre:'Haití',codigo:509},
            {nombre:'Honduras',codigo:504},
            {nombre:'Hong Kong',codigo:852},
            {nombre:'Holanda',codigo:31},
            {nombre:'Hungría',codigo:36},
            {nombre:'India',codigo:91},
            {nombre:'Indonesia',codigo:62},
            {nombre:'Inglaterra / Reino Unido',codigo:44},
            {nombre:'Irán',codigo:98},
            {nombre:'Iraq',codigo:964},
            {nombre:'Irlanda',codigo:353},
            {nombre:'Isla Cabo Verde',codigo:238},
            {nombre:'Isla Navidad',codigo:6724},
            {nombre:'Isla Norforlk',codigo:6723},
            {nombre:'Isla Reunión',codigo:262},
            {nombre:'Islandía',codigo:354},
            {nombre:'Islas Ascención',codigo: 247},
            {nombre:'Islas Caimán',codigo:1006},
            {nombre:'Islas Cook',codigo:682},
            {nombre:'Islas Faroe',codigo:298},
            {nombre:'Islas Fiji',codigo:679},
            {nombre:'Islas Maldivas',codigo:960},
            {nombre:'Islas Malvinas',codigo:500},
            {nombre:'Islas Marshall',codigo:692},
            {nombre:'Islas Mauricio',codigo:230},
            {nombre:'Isla Mayotte',codigo:2696},
            {nombre:'Islas Salomón',codigo:677},
            {nombre:'Isla Seychelles',codigo:248},
            {nombre:'Islas Tonga',codigo:676},
            {nombre:'Islas Vírgenes Americanas',codigo:340},
            {nombre:'Islas Vírgenes Británicas',codigo:284},
            {nombre:'Israel',codigo:972},
            {nombre:'Italia',codigo:39},
            {nombre:'Jamaica',codigo:1010},
            {nombre:'Japón',codigo:81},
            {nombre:'Jordania',codigo:962},
            {nombre:'Kazakhstán',codigo:731},
            {nombre:'Kenia',codigo:254},
            {nombre:'Kiribati',codigo:686},
            {nombre:'Kuwait',codigo:965},
            {nombre:'Kyrgyzstán',codigo:733},
            {nombre:'Laos',codigo:856},
            {nombre:'Latvia',codigo:371},
            {nombre:'Lesoto',codigo:266},
            {nombre:'Líbano',codigo:961},
            {nombre:'Liberia',codigo:231},
            {nombre:'Libia',codigo:218},
            {nombre:'Liechtenstein',codigo:417},
            {nombre:'Lituania',codigo:370},
            {nombre:'Luxemburgo',codigo:352},
            {nombre:'Macao',codigo:853},
            {nombre:'Macedonia',codigo:389},
            {nombre:'Madagascar',codigo:261},
            {nombre:'Malasia',codigo:60},
            {nombre:'Malawi',codigo:265},
            {nombre:'Malta',codigo:356},
            {nombre:'Marruecos',codigo:212},
            {nombre:'Mauritania',codigo:222},
            {nombre:'México',codigo:52},
            {nombre:'Micronesia',codigo:691},
            {nombre:'Moldova',codigo:373},
            {nombre:'Mónaco',codigo:377},
            {nombre:'Mongolia',codigo:976},
            {nombre:'Montserrat',codigo:1011},
            {nombre:'Mozambique',codigo:258},
            {nombre:'Myanmar',codigo:95},
            {nombre:'Namibia',codigo:264},
            {nombre:'Nauru',codigo:674},
            {nombre:'Nepal',codigo:977},
            {nombre:'Nevis',codigo:1012},
            {nombre:'Nicaragua',codigo:505},
            {nombre:'Niger',codigo:227},
            {nombre:'Nigeria',codigo:234},
            {nombre:'Niue',codigo:683},
            {nombre:'Noruega',codigo:47},
            {nombre:'Nueva Caledonia',codigo:687},
            {nombre:'Nueva Zelanda',codigo:64},
            {nombre:'Oceano Atlántico Este',codigo: 871},
            {nombre:'Oceano Atlántico Oeste',codigo: 874},
            {nombre:'Oceano Indico',codigo:873},
            {nombre:'Oceano Pacífico',codigo:872},
            {nombre:'Omán',codigo:968},
            {nombre:'Pakistan',codigo:92},
            {nombre:'Palau',codigo:680},
            {nombre:'Panamá',codigo:507},
            {nombre:'Papua Nueva Guinea',codigo:675},
            {nombre:'Paraguay',codigo:595},
            {nombre:'Perú',codigo:51},
            {nombre:'Polonia',codigo:48},
            {nombre:'Portugal',codigo:351},
            {nombre:'Puerto Rico',codigo:1787},
            {nombre:'Qatar',codigo:974},
            {nombre:'República Central Africana',codigo:236},
            {nombre:'República Checa',codigo:42},
            {nombre:'República Dominicana',codigo:1008},
            {nombre:'República Gabona',codigo:241},
            {nombre:'República de Mali',codigo:223},
            {nombre:'República de Senegal',codigo:221},
            {nombre:'República de Vanuatú',codigo:7377},
            {nombre:'Rumanía',codigo:40},
            {nombre:'Russia',codigo:7},
            {nombre:'Rwanda',codigo:250},
            {nombre:'Saipán',codigo:1670},
            {nombre:'Samoa Americana',codigo:684},
            {nombre:'Samoa Oeste',codigo:685},
            {nombre:'San Croix',codigo:340},
            {nombre:'San John',codigo:340},
            {nombre:'San Kitts',codigo:1013},
            {nombre:'San Marino',codigo:378},
            {nombre:'San Thomas',codigo:340},
            {nombre:'San Vicente',codigo:1015},
            {nombre:'Santa Elena',codigo:290},
            {nombre:'Santa Lucia',codigo:1014},
            {nombre:'Santa Piera y Miquelón',codigo:508},
            {nombre:'Sao Tome',codigo:239},
            {nombre:'Sierra Leona',codigo:232},
            {nombre:'Singapur',codigo:65},
            {nombre:'Siria',codigo:963},
            {nombre:'Slovakia',codigo:421},
            {nombre:'Slovenia',codigo:386},
            {nombre:'Somalía',codigo:252},
            {nombre:'Sri Lanka',codigo:94},
            {nombre:'Sudáfrica',codigo:27},
            {nombre:'Sudán',codigo:249},
            {nombre:'Suecia',codigo:46},
            {nombre:'Suiza',codigo:41},
            {nombre:'Surinam',codigo:597},
            {nombre:'Swazilandia',codigo:268},
            {nombre:'Tahití / Polinesia Francesa',codigo:689},
            {nombre:'Tailandía',codigo:66},
            {nombre:'Taiwan',codigo:886},
            {nombre:'Tajikstan',codigo:73},
            {nombre:'Tanzania',codigo:255},
            {nombre:'Togo',codigo:228},
            {nombre:'Trinidad y Tobago',codigo:1016},
            {nombre:'Tunisia',codigo:216},
            {nombre:'Turquía',codigo:90},
            {nombre:'Turkmenistán',codigo:993},
            {nombre:'Tuvalú',codigo:688},
            {nombre:'Uganda',codigo:256},
            {nombre:'Ukrania',codigo:380},
            {nombre:'Uruguay',codigo:598},
            {nombre:'Uzbekistán',codigo:737},
            {nombre:'Vaticano',codigo:396},
            {nombre:'Venezuela',codigo:58},
            {nombre:'Vietnam',codigo:84},
            {nombre:'Wallis y Futuna',codigo:681},
            {nombre:'Yemen',codigo:967},
            {nombre:'Yugoslavia',codigo:381},
            {nombre:'Zaire',codigo:243},
            {nombre:'Zambia',codigo:260},
            {nombre:'Zimbabwe',codigo:263},

        ];

    

    function inicial(){
        url_tarjeta_principal=window.location.href;
        url_tarjeta_principal_uri=encodeURIComponent(url_tarjeta_principal);
        jQuery("#texto_copiar").val(url_tarjeta_principal);
        new Clipboard('.compartir__copiar');        

        var cadena_indicadores='';
        var select_indicadores='';
        for(var i=0;i<listado_paises.length;i++){
            select_indicadores='';
            if(listado_paises[i].codigo==pais_por_defecto){
                select_indicadores='selected';
            }
            cadena_indicadores+=`<option ${select_indicadores} value="${listado_paises[i].codigo}">(+${listado_paises[i].codigo}) ${listado_paises[i].nombre}</option>`;
        }
        jQuery("#indicador").html(cadena_indicadores);


        jQuery("#btn_share_whatsapp").click(function(e){
            e.preventDefault();
            send_whatsapp_sms(1);
        });

        jQuery("#btn_share_sms").click(function(e){
            e.preventDefault();
            send_whatsapp_sms(2);
        });

        //ENVIAR ENLACE FACEBOOK
        jQuery(".compartir__facebook").click(function(e){        
            e.preventDefault();
            var url_share=`http://www.facebook.com/sharer/sharer.php?u=${url_tarjeta_principal_uri}&p[title]=${titulo_compartir}&p[summary]=${descripcion_compartir}&p[images][0]=${imagen_compartir}`;
            window.open(url_share,"_blank");
        });

        //ENVIAR ENLACE TWITTER
        jQuery(".compartir__twitter").click(function(e){        
            e.preventDefault();
            var titulo_compartir_twitter=titulo_compartir.replace(" ","+");
            var url_share=`http://twitter.com/home?status=${titulo_compartir_twitter}...++${url_tarjeta_principal_uri}+`;
            window.open(url_share,"_blank");
        });

        //ENVIAR ENLACE PINTEREST
        jQuery(".compartir__pinterest").click(function(e){        
            e.preventDefault();
            var url_share=`http://pinterest.com/pin/create/button/?url=${url_tarjeta_principal}&media=${imagen_compartir}&description=${titulo_compartir}`;
            window.open(url_share,"_blank");
        });

        //ENVIAR ENLACE LINKEDIN
        jQuery(".compartir__linkedin").click(function(e){        
            e.preventDefault();
            var url_share=`https://www.linkedin.com/shareArticle?mini=true&url=${url_tarjeta_principal}&title=${titulo_compartir}&summary=${descripcion_compartir}&source=`;
            window.open(url_share,"_blank");
        });

        //ENVIAR ENLACE EMAIL
        jQuery(".compartir__mensaje").click(function(e){        
            e.preventDefault();
            var url_share=`mailto:?subject=${titulo_compartir}&body=${descripcion_compartir} ${url_tarjeta_principal}`;
            window.open(url_share,"_blank");
        });

        //ENVIAR ENLACE TELEGRAM
        jQuery(".compartir__telegram").click(function(e){        
            e.preventDefault();
            var url_share=`tg://msg?text=${titulo_compartir}&body=${descripcion_compartir} ${url_tarjeta_principal}`;
            window.open(url_share,"_blank");
        });


       

    }


     //MÁS OPCIONES PARA COMPARTIR - SHARE NATIVO
     ( () => {
            'use strict';
            // check if share API is supported or not
            if (navigator.share !== undefined) {
            document.addEventListener('DOMContentLoaded', () => {
                // select the html element with the class "share"
                var shareBtn = document.querySelector('.compartir__opciones');
                // add share button event listener
                shareBtn.addEventListener('click', (event) => {
                // web share API
                navigator.share({
                // pick the default title of your page in the title tag
                    title: titulo_compartir,
                // change the text of your share as you may like; to e.g desc of your pwa
                    text: descripcion_compartir,
                    url: window.location.href
                })
                .then(() => {
                    console.info('PWA shared successfully!');
                })
                .catch((error) => {
                    console.error('Whoa! failed to share : ', error);
                })
                });
            });
            }
        })();
    

    //ENVIAR POR NÚMERO WHATSAPP O SMS
    function send_whatsapp_sms(tipo){
        var url_share="";
        var iOS = !!navigator.platform && /iPad|iPhone|iPod/.test(navigator.platform);
        var numero_celular_share=""+jQuery("#fi_share_celular").val();
        numero_celular_share=numero_celular_share.trim();
        numero_celular_share=numero_celular_share.replace(/ /g,"");
        if(tipo=="1"){
            url_share="";            			
			if(numero_celular_share!=""){
                numero_celular_share=jQuery("#indicador").val()+""+numero_celular_share;
				url_share=`https://api.whatsapp.com/send?phone=${numero_celular_share}&text=${titulo_compartir} - ${url_tarjeta_principal}`;
			}else{
				url_share=`https://api.whatsapp.com/send?text=${titulo_compartir} - ${url_tarjeta_principal}`;
			}
        }else{
            url_share="";
            if(iOS){
                url_share="sms:"+numero_celular_share+"&body="+titulo_compartir+" - "+url_tarjeta_principal;
            }else{
                url_share="sms://"+numero_celular_share+"?body="+titulo_compartir+" - "+url_tarjeta_principal;
            }
        }
        window.open(url_share,"_self");
    }
   
    




let btn_review_flotant=``;
if(enabledReview){
    btn_review_flotant+=`
        <a href="#" id="btn_boton_reviews" class="compartir__review_flotante"><span class="fa fa-star"></span>        
            <div class="label_reviews">Reviews</div>
        </a>
        `;
}
if(enabledNotification){
    btn_review_flotant+=`
        <a href="#" id="btn_boton_notifications" class="compartir__notification_flotante">
            <span class="fa fa-bell"></span>
            <div class="label_notification"></div>
        </a>
        `;
}
jQuery("body").append(btn_review_flotant);




if(enabledNotification){
    get_notificaciones_app(1);
}
    


let band_enabled=0;
jQuery("#btn_boton_reviews").click(function(e){
    e.preventDefault();
    //PUM.open(id_popup_review);
    let cadenaEstrellas=`
    <a href="#"  id="btn_estrella_curso_1" ><i class="fa fa-star-o"></i></a>
    <a href="#"  id="btn_estrella_curso_2" ><i class="fa fa-star-o"></i></a>
    <a href="#"  id="btn_estrella_curso_3" ><i class="fa fa-star-o"></i></a>
    <a href="#"  id="btn_estrella_curso_4" ><i class="fa fa-star-o"></i></a>
    <a href="#"  id="btn_estrella_curso_5" ><i class="fa fa-star-o"></i></a>
    `;
    jQuery(".contenedor_estrellas").html(cadenaEstrellas);


    jQuery("#CnvReviews1").show();
    jQuery("#CnvReviews2").hide();
    jQuery("#CnvReviews3").hide();

    jQuery("#fi_email_review").val("");
    jQuery("#fi_comment_review").val("");

    jQuery("#btn_estrella_curso_1").mouseover(function(e){
        set_estrella(1);        
    });

    jQuery("#btn_estrella_curso_2").mouseover(function(e){
        set_estrella(2);        
    });

    jQuery("#btn_estrella_curso_3").mouseover(function(e){
        set_estrella(3);        
    });

    jQuery("#btn_estrella_curso_4").mouseover(function(e){
        set_estrella(4);        
    });

    jQuery("#btn_estrella_curso_5").mouseover(function(e){
        set_estrella(5);        
    });


    jQuery("#contenedor_estrellas").mouseout(function(e){
        limpiar_estrellas();
    });

    
    jQuery("#btn_estrella_curso_1").click(function(e){
        e.preventDefault();
        calificacion_estrella=1;
    });

    jQuery("#btn_estrella_curso_2").click(function(e){
        e.preventDefault();
        calificacion_estrella=2;
    });

    jQuery("#btn_estrella_curso_3").click(function(e){
        e.preventDefault();
        calificacion_estrella=3;
    });

    jQuery("#btn_estrella_curso_4").click(function(e){
        e.preventDefault();
        calificacion_estrella=4;
    });

    jQuery("#btn_estrella_curso_5").click(function(e){
        e.preventDefault();
        calificacion_estrella=5;
    });

    if(!band_enabled){
        band_enabled=1; 
        

        
        

        jQuery("#btnReview").click(function(e){
            e.preventDefault();
            enviarReview();
        });

        jQuery("#btnSendReview").click(function(e){
            e.preventDefault();
            send_review_app(2);
        });

    }


});


jQuery("#btn_boton_notifications").click(function(e){
    get_notificaciones_app(2);
});




function set_estrella(id_estrella){
    //.attr("star")   
    calificacion_estrella=id_estrella;
    for(var i=1;i<=5;i++){
        if(i<=id_estrella){
            jQuery("#btn_estrella_curso_"+i+" > i ").removeClass("fa-star-o");
            jQuery("#btn_estrella_curso_"+i+" > i ").addClass("fa-star");
        }else{          
            jQuery("#btn_estrella_curso_"+i+" > i ").removeClass("fa-star-o");
            jQuery("#btn_estrella_curso_"+i+" > i ").addClass("fa-star-o");          
        }
    }

}

function limpiar_estrellas(){
    for(var i=1;i<=5;i++){     
        if(calificacion_estrella=="" || calificacion_estrella<i ){
            jQuery("#btn_estrella_curso_"+i+" > i ").addClass("fa-star-o");
            jQuery("#btn_estrella_curso_"+i+" > i ").removeClass("fa-star");  
        }
    }
}




function enviarReview(){
    if(calificacion_estrella<=3){
        jQuery("#CnvReviews1").hide();
        jQuery("#CnvReviews2").show();
        jQuery("#CnvReviews3").hide();
    }else{
        jQuery("#CnvReviews1").hide();
        jQuery("#CnvReviews2").hide();
        jQuery("#CnvReviews3").show();
        send_review_app(1);
    }
}
//Fin reviews wordpress + popup generator
// diseñado y desarrollador por: Angel Lizcano

function get_notificaciones_app(tipo_info){

    var formData = new FormData();        
    formData.append('CodigoProducto', CodigoProducto);

    var request = jQuery.ajax({
        url: url_servidor+"api/get_notificaciones_app",
        type: "POST",
        
        data: formData,
        processData: false,  // tell jQuery not to process the data
        contentType: false  // tell jQuery not to set contentType


    });

    request.done(function(obj) {                  

        if(obj.status=="ok"){                              
            console.log(obj);
            
            let datos_notificacion=obj.datos_notificacion;
            
            if(tipo_info=="2"){
                //PUM.open(id_popup_notificacion);
                let cadena_notificaciones=``;
                for(let i=0;i<datos_notificacion.length;i++){
                    cadena_notificaciones+=`
                        <a href="${datos_notificacion[i].URLNotificacion}" target="_blank" class="item_notificacion">
                            <div class="container_item">
                                <div style="width:45px; display:inline-block; text-align:center;">
                                    <span style="    font-size: 32px; margin-top: 8px; color:#fc0;" class="fa fa-bell"></span>
                                </div>
                                

                                <div style="display:inline-block;">
                                    <h4>${datos_notificacion[i].TituloNotificacion}</h4>
                                    <p>${datos_notificacion[i].DescripcionNotificacion}</p>                            
                                </div>
                                
                            </div>
                        </a>
                    `;
                }
                jQuery("#list_notifications").html(cadena_notificaciones);
            }else{
                if(datos_notificacion.length>0){
                    
                    jQuery("#btn_boton_notifications").show();
                    jQuery(".label_notification").html(datos_notificacion.length);
                }
                
            }

            return;
        }else{                  
            alert("Error!, "+obj.mensaje);
            return;
        }
    });
        //respuesta si falla
    request.fail(function(jqXHR, textStatus) {
        alert( "Error de servidor  " + textStatus );
    });

}


function send_review_app(tipo_review){
    let formData = new FormData();    

    let EmailReview="";
    let ComentarioReview="";

    if(tipo_review=="1"){
        EmailReview="";
        ComentarioReview="";
    }else{
        EmailReview=""+jQuery("#fi_email_review").val();
        ComentarioReview=""+jQuery("#fi_comment_review").val();
    }

    formData.append('CodigoProducto', CodigoProducto);
    formData.append('CalificacionProducto', calificacion_estrella);    
    formData.append('EmailReview', EmailReview);
    formData.append('ComentarioReview', ComentarioReview);

    
    

    var request = jQuery.ajax({
        url: url_servidor+"api/set_reviews_app",
        type: "POST",
        
        data: formData,
        processData: false,  // tell jQuery not to process the data
        contentType: false  // tell jQuery not to set contentType
    });

    request.done(function(obj) {                  
        if(obj.status=="ok"){                              
            console.log(obj);
            if(tipo_review=="2"){
                //PUM.open(id_popup_review);
            }
        }else{                  
            alert("Error!, "+obj.mensaje);
            return;
        }
    });

    request.fail(function(jqXHR, textStatus) {
        alert( "Error de servidor  " + textStatus );
    });
}

setTimeout(function(){ 
    jQuery(".label_reviews").show("fast").delay(8000).fadeOut(); 
    //jQuery(".label_reviews")
 }, 4000);
