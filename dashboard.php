<?php
    include_once("templates/header.php");
    include_once("process/orders.php");
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
                                <?php foreach($acais as $acai): ?>
                                    <tr>
                                        <td><?=$acai["id_acai"] ?></td>
                                        <td><?=$acai["creme"] ?></td>
                                        <td><?=$acai["sabor"] ?></td>
                                        <td><?=$acai["tamanho"] ?></td>
                                        <td>
                                            <ul>
                                                <?php foreach($acai["frutas"] as $fruta): ?>
                                                    <li><?= $fruta; ?> </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </td>
                                        <td>
                                            <ul>
                                                <?php foreach($acai["complementos"] as $complemento): ?>
                                                    <li><?= $complemento; ?> </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </td>
                                        <td>
                                            <form action="process/orders.php" method="POST" class="form-group update-form">
                                                <input type="hidden" name="type" value="update">
                                                <input type="hidden" name="id" value="<?= $acai["id_acai"] ?>">
                                                <select name="status" class="form-control status-input">
                                                    <?php foreach($status as $s): ?>
                                                        <option value="<?= $s["id_status"] ?>" 
                                                        <?php echo ($s["id_status"] == $acai["status"]) ? "selected" : ""; ?> > 
                                                        <?= $s["tipo"] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <button type="submit" class="update-btn">
                                                    <i class="fas fa-sync-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="process/orders.php" method="POST">
                                                <input type="hidden" name="type" value="delete">
                                                <input type="hidden" name="id" value="<?= $acai["id_acai"] ?>">
                                                <button type="submit" class="delete-btn">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
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