<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Quotation;
use Exception;

class BlogController extends Controller
{
    //
    public function vista_blog($url_post=null){        
        if($url_post){
            $article=DB::table('blog_articulo')->where('SlugArticulo',$url_post)->limit(1)->get();

            $sql="SELECT (SELECT SlugArticulo FROM blog_articulo e1 WHERE e1.IdArticulo < e.IdArticulo and e.IdEstado=1 ORDER BY IdArticulo DESC LIMIT 1 OFFSET 0) as prev_value,
                        (SELECT SlugArticulo FROM blog_articulo e2 WHERE e2.IdArticulo > e.IdArticulo  and e.IdEstado=1 ORDER BY IdArticulo ASC LIMIT 1 OFFSET 0) as next_value
                FROM blog_articulo e
                WHERE IdArticulo={$article[0]->IdArticulo};";
            $navegacion=DB::select($sql);


            return view('marketing.single-post',[
                        "id_pagina"=>"blog",
                        'article' => $article,
                        "navegacion"=>$navegacion,            
                        "tituloPagina"=>$article[0]->TituloArticulo,
                        "descripcionPagina"=>$article[0]->TituloArticulo,
                        "imagenPagina"=>$article[0]->URLImagenArticulo,
                    ]);
        }else{
            $articulos=DB::table('blog_articulo')->where('IdEstado',1)->paginate(10);
            return view('marketing.blog',["id_pagina"=>"blog",'articulos' => $articulos]);
        }
        
    }

    
    
}
