<?php
/**
 *
 * @author Rodri
 */
interface IDAO {
    
    function crear(ObjetoComun $param);
    function eliminar( ObjetoComun $param);
    function actualizar(ObjetoComun $param);
    function consultar($param);
    function consultarTodos();
}
