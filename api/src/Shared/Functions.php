<?php
    namespace Src\Shared;

    class Functions{

        //darle una vuelta para que no salte excepcion y funcione
        public static function search_in_array_return_index($array, $key, $key_value){
            $encontrado = FALSE;



            $i=0;
            foreach ($array as $arr) {
                # code...
                if (  is_array($arr[$key])) {
                    $encontrado = self::search_in_array_return_index($v, $key, $key_value);
                    if (is_array($encontrado)) {
                        break;
                    }

                } else {
                    if ( $arr[$key] == $key_value ) {
                        $encontrado = $i;
                        return $encontrado;
                    }
                }

                $i++;
            }

        }


        public static function reorganise_duplicate_categories_array($array){
            $arrTmp=[];
            foreach ($array as $arr) {
                $id_buscado=$arr['id'];

                $existe=self::search_in_array_return_index($arrTmp,'id',$id_buscado);
                
                if ( $existe == '') {
                    $tmpData=array(
                        "id"=>$id_buscado,
                        "user_id"=>$arr['user_id'],
                        "name"=>$arr['name'],
                        "description"=>$arr['description'],
                        "status"=>$arr['status']
                    );

                    if ($arr['category'] !== null) {
                        $tmpData['categories'][0]=array('id'=>$arr['category_id'],'name'=>$arr['category']);
                    }

                    array_push($arrTmp,$tmpData);
                    
                }else{
                    $category_data=array('id'=>$arr['category_id'],'name'=>$arr['category']);
                    array_push($arrTmp[$existe]['categories'],$category_data);
                }

            }
            
            rsort($arrTmp);
            $array=$arrTmp;
            return $array;
        }

    }
    



?>