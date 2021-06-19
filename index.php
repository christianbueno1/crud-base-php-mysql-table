<?php
// Show PHP errors
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

require_once 'clases/product.php';

$objProduct = new Product();

// GET
if( isset($_GET['delete_id']) ){
    $id = $_GET['delete_id'];
    try {
        if ($id != null) {
            if($objProduct->delete($id) ){
                $objProduct->redirect('index.php?deleted');
            }
        } else {
            var_dump($id);
        }
        
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

}

?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Head metas, css, and title -->
        <?php require_once 'includes/head.php'; ?>
    </head>
    <body>
        <!-- Header banner -->
        <?php require_once 'includes/header.php'; ?>
        <div class="container-fluid">
            <div class="row">
                <!-- Sidebar menu -->
                <?php require_once 'includes/sidebar.php'; ?>
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                    <h1 style="margin-top: 10px">DataTable - Productos</h1>
                    <?php


                    ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>Atributos</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <?php
                                $query = "SELECT * FROM product";
                                $stmt = $objProduct->runQuery($query);
                                $stmt->execute();
                            ?>
                            <tbody>
                                <?php if($stmt->rowCount() > 0 ){ 
                                    while($rowProduct = $stmt->fetch(PDO::FETCH_ASSOC) ){
                                ?>
                                <tr>
                                    <td><?php print($rowProduct['id']); ?></td>
                                    <td>
                                        <a href="form.php?edit_id=<?php print($rowProduct['id']); ?>" >
                                        <?php print($rowProduct['product']); ?>
                                        </a>
                                    </td>
                                    <td><?php print($rowProduct['price']); ?></td>
                                    <td><?php print($rowProduct['attribute']); ?></td>
                                    <td>
                                        <a href="index.php?delete_id=<?php print($rowProduct['id']); ?>" class="confirmation">
                                        <span data-feather="trash"></span>
                                        </a>
                                    </td>
                                </tr>

                                <?php } }?>
                            </tbody>
                        </table>
                    </div>

                </main>
            </div>
        </div>
        <!-- Footer scripts, and functions -->
        <?php require_once 'includes/footer.php'; ?>

        <!-- Custom scripts -->
        <script>
            // JQuery confirmation
            $('.confirmation').on('click', function () {
                return confirm('Seguro que desea borrar eliminar este PRODUCTO?');
            });
        </script>
    </body>
</html>