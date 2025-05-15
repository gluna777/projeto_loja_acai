<?php
    include_once("templates/header.php");
    include_once("process/acai.php");
?>
    <div id="main-banner">
        <h1>Faça seu Pedido</h1>
    </div>
    <div id="main-container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                <h2>Monte seu açaí como desejar:</h2>
                <form action="process/acai.php" method="POST" id="acai-form">
                    <div class="form-group">
                        <label for="sabor">Sabor:</label>
                        <select name="sabor" id="sabor" class="form-control">
                            <option value="">Selecione o sabor</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="creme">Creme:</label>
                        <select name="creme" id="creme" class="form-control">
                            <option value="">Selecione o creme</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="frutas">Frutas: (Máximo 3)</label>
                        <select multiple name="frutas[]" id="frutas" class="form-control">
                            <option value="">Selecione o frutas</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="complementos">Complementos: (Máximo 3)</label>
                        <select multiple name="complementos[]" id="complementos" class="form-control">
                            <option value="">Selecione o complementos</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Fazer Pedido!">
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
<?php
    include_once("templates/footer.php");
?>