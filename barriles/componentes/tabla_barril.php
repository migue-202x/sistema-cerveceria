<?php

?>







<html>
    <head>
        <meta charset="UTF-8">
        <title>title</title>
        <link rel="stylesheet" href="../../estilos/estilos.css">
 
        
<!--        <link rel='stylesheet' type='text/css' href='../lib/glyphicon.css'>
         <link rel='stylesheet' type='text/css' href='../librerias/bootstrap/css/bootstrap.css'> -->
    </head>
    <body class="body">
        <div class="containerExt classext">
            <div class="row">
                <div class="col-sm-12">
                    <h2 align="center" class="h2PDC">BARRILES</h2>
                    <!-- <button id="show" type="text">MOSTRAR</button> -->
                    
                    <table>
                        <td>
                            <button id="btnPlus" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modalNuevo"><span class="glyphicon glyphicon-plus"></span></button>
                        </td>
                    
                    </table>
                    <br>
                    <table class="table myhover table-condensed table-bordered" id="tablaDinamicaLoad" style="width:100%">
                        <!-- <caption>
                            <button id="agregaNuevo" class="btn btn-primary" data-toggle="modal" data-target="#modalNuevo">Agregar Nuevo <span class="glyphicon glyphicon-plus"></span></button>
                        
                        </caption> -->
                        
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>CODIGO</td>
                                <td>PROVEEDOR</td>
                                <td>CAPACIDAD</td>
                                <td>ESTADO</td>
                                <td>LLENO</td>
                                <!-- Los 3 td que siguen contienen los iconos de registrar, eliminar y editar-->
                                <td></td>
                                <td></td>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php

                            //PDO o Mysqli son objetos de conexion
                                $conn = new PDO('mysql:host=localhost; dbname=cerveceria', 'root', '');
                                $query = "SELECT barriles.*, proveedores.nombre AS proveedor FROM barriles INNER JOIN proveedores 
                                WHERE barriles.proveedores_id = proveedores.Id"; 
                                $stament = $conn->prepare($query);    
                                $stament->execute();

                               
                                //COMINEZO DEL FOR que vuelca sobre un array los registros
                                foreach ($stament as $array) {
                                    //No se porque el array $datos NO PUEDE SER ENVIADO EN EL PHP DE ARRIBA, DONDE "Agrego nuevo" 

                                                $datos = $array[0] . "||" .
                                                        $array[1] . "||" .
                                                        $array[2] . "||" .
                                                        $array[3] . "||" .
                                                        $array[4] . "||" .
                                                        $array[5];
                                                if( $array[5] == 1){
                                                   $lleno = 'SI'; 
                                                }else{
                                                   $lleno = 'NO'; 
                                                }
                                                
                                                if($array[4] !='Devuelto'){
                                                    $id = $array[4];
                                                    $conn = new PDO('mysql:host=localhost; dbname=cerveceria', 'root', '');
                                                    $stament = $conn->prepare("SELECT cliente.nombre AS nombre FROM cliente WHERE cliente.id =:id"); 
                                                    $stament->bindParam(':id', $id);    
                                                    $stament->execute();
                                                    
                                                    $res = $stament->fetch(); 
   
                                                    $array[4] = $res['nombre']; 

                                                    $stament = null;
                                                } 
                                               
                                            ?>

                           
                                                <tr class="classColor">
                                                    <td id="thisCod"><?php echo $array[0]; ?></td>
                                                    <td><?php echo $array[1]; ?></td>
                                                    <td><?php echo $array['proveedor']; ?></td>
                                                    <td><?php echo $array[3]; ?></td>
                                                    <td><?php echo $array[4]; ?></td>
                                                    <td><?php echo $lleno; ?></td>
                                                    <td>
                                                        <button class="btn btn-warning" data-toggle="modal" data-target="#modalEdicion" onclick="agregaformEdit('<?php echo $datos; ?>')"><span class="glyphicon glyphicon-pencil"></span></button>
                                                    </td>
                                            
                                                    <td>
                                                        <button class="btn btn-danger" onclick="pregutarSiNo('<?php echo $array[0]; ?>')"><span class="glyphicon glyphicon-remove"></span></button>
                                                    </td>
                                                 </tr>
                                            
                                    <!--//FIN DEL FOR-->       
                                <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>
    <!-- <script src="../lib/jquery/jquery-1.9.1.min.js"></script>                              -->
    <script type= "text/javascript">
        $(document).ready(function(){
            $('#btnPlus').focus();
            $('#tablaDinamicaLoad').DataTable({
            language:{
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }
                
                
                
            });

            
        });

           
                
        </script>
        
  
            
    

 

