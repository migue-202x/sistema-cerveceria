
<?php

//session_start(); 
  
?>





<table class="table table-condensed table-bordered" id="tablaCocciones">
                        
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>NOMBRE</td>
<!--                                <td>ABREVIACIÓN</td>
                                <td>LIBRO IVA</td>-->
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php
                            
                            $conn = new PDO('mysql:host=localhost; dbname=cerveceria', 'root', '');
                            
                            $query = "SELECT cocciones.* FROM cocciones";
                            
                            $stament = $conn->prepare($query);
                            $stament->execute();
                                    

                                    
                                 

                                foreach ($stament as $array) {
     
                                            ?>

                                                <tr class="trColor" id="trTipoCocciones">
                                                    <td data-id="<?php echo $array['id']; ?>"><?php echo $array['id']; ?></td>
                                                    <td data-id="<?php echo $array['id']; ?>"><?php echo $array['nombre']; ?></td>
         
                                                </tr>
                                            <?php
                                   }
                                   //FIN DEL FOR
                                    
                                ?>
                        </tbody>
                        
                        
                        
                  
                    </table>



                    <script type="text/javascript">
             
                    $(document).ready(function(){
                        $('#deployCocciones').modal({
                            keyboard: true,
                            backdrop: "static",
                            show: false,

                            }).on('show', function () {

                            });

                        });
                        
//                        --------------------------------------------------

                        var start = document.getElementById('trTipoCocciones');
                        console.log(start);
                        start.focus();
                        start.style.backgroundColor = 'green';
                        start.style.color = 'white';
                        function dotheneedful(sibling) {
                            if (sibling != null) {
                                start.focus();
                                start.style.backgroundColor = '';
                                start.style.color = '';
                                start.setAttribute("isselect", "false");
                                sibling.focus();
                                sibling.style.backgroundColor = 'green';
                                sibling.style.color = 'white';
                                sibling.setAttribute("isselect", "true");
                                start = sibling;
                            }
                        }
                        document.onkeydown = checkKey;
                        function checkKey(e) {
                        e = e || window.event;
                        if (e.keyCode == '13') {
                            dotheneedful(start);
                            var codeee = 'code=' + $("#tablaCocciones").find('tr[isselect="true"]').find('td:eq(0)').data('id');
                            setCodeCocciones(codeee);
//                            return false; 
                            

                            $('#deployCocciones').modal('hide');
                            if ($('.modal-backdrop').is(':visible')) {
                              $('body').removeClass('modal-open'); 
                              $('.modal-backdrop').remove(); 
                            };

//                            focusFormaPago();
//                            console.log($("#tablaTipoCompDos").find('tr[isselect="true"]'),codeee);
                        }
                        if (e.keyCode == '37') {
                        //up arrow
                        var idx = start.cellIndex;
                        var nextrow = start.parentElement.previousElementSibling;
                        if (nextrow != null) {
                        var sibling = nextrow.cells[idx];
                        dotheneedful(sibling);
                        }
                        } else if (e.keyCode == '39') {
                        //down arrow
                        var idx = start.cellIndex;
                        var nextrow = start.parentElement.nextElementSibling;
                        if (nextrow != null) {
                        var sibling = nextrow.cells[idx];
                        dotheneedful(sibling);
                        }
                        } else if (e.keyCode == '38') { 
                        //HACIA ARRIBA
                        var sibling = start.previousElementSibling;
                        dotheneedful(sibling);
                        } else if (e.keyCode == '40') {
                        //HACIA ABAJO
                        var sibling = start.nextElementSibling;
                        dotheneedful(sibling);
                        }
            //             }else if (e.keyCode == '13') {
            //               console.log(ElementSibling);
            //               return false; 
            //             }
                        }

         </script>
