<?php
    include_once("templates/header.php");
?>
    <div id="main-container">
        <div class="container">
            <div class="row">
                <div class="cold-md-12">
                    <h2>Gerenciar pedidos:</h2>
                <div>
                    <div class="col-md-12 table-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"> <span>Pedido</span>#</th>
                                    <th scope="col">Creme</th>
                                    <th scope="col">Sabor</th>
                                    <th scope="col">Tamanho</th>
                                    <th scope="col">Frutas</th>
                                    <th scope="col">Complementos</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#1</td>
                                    <td>Cupuaçu</td>
                                    <td>Açaí</td>
                                    <td>400ml</td>
                                    <td>Morango</td>
                                    <td>Leite Condensado</td>
                                    <td>
                                        <form action="" class="form-group update-form">
                                            <input type="hidden" name="type" value="update">
                                            <input type="hidden" name="id" id="1">
                                            <select name="status" class="form-control status-input">
                                                <option value="">Entrega</option>
                                            </select>
                                            <button type="submit" class="update-btn">
                                                <i class="fas fa-sync-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="process/orders.php" method="POST">
                                            <input type="hidden" name="type" value="delete">
                                            <input type="hidden" name="id" id="1">
                                            <button type="submit" class="delete-btn">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>  
                </div>
                </div>
            </div>
        </div>
    </div>
<?php
    include_once("templates/footer.php");
?>