<?php
// Show PHP errors
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

require_once 'clases/product.php';
$objProduct = new Product();

// GET
if(isset($_GET['edit_id'])){
    $id = $_GET['edit_id'];
    $stmt = $objProduct->runQuery('SELECT * FROM product WHERE id = :id');
    $stmt->execute(array(":id" => $id));
    $rowProduct = $stmt->fetch(PDO::FETCH_ASSOC);
}else{
    $id = null;
    $rowProduct = null;
}

// POST
if( isset($_POST['btn_save']) ) {
    $name = strip_tags($_POST['product']);
    $price = strip_tags($_POST['price']);
    $attribute = strip_tags($_POST['attribute']);

    try {
        if ($id != null ) {
            if($objProduct->update($name, $price, $attribute) ){
                $objProduct->redirect('index.php?updated');
            }
        }else{
            if( $objProduct->insert($name, $price, $attribute) ){
                $objProduct->redirect('index.php?inserted');
            }else{
                $objProduct->redirect('index.php?error');
            }
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
                <!-- md median -->
                <!-- ml marfgin left, sm small -->
                <!-- px-4 , padding lef right 1.5rem -->
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                  <h1 style="margin-top: 10px">Add / Edit Product</h1>
                  <p>Required fields are in (*)</p>
                  <form  method="post">
                    <div class="form-group">
                        <label for="id">ID</label>
                        <input class="form-control" type="text" name="id" id="id" value="" readonly>
                    </div>
                    <div class="form-group">
                        <label for="product">Producto *</label>
                        <input  class="form-control" type="text" name="product" id="product" placeholder="Ingrese el nuevo producto" value="<?php print($rowProduct['product']); ?>" required maxlength="100">
                    </div>
                    <div class="form-group">
                        <label for="price">Precio $</label>
                        <input  class="form-control" type="text" name="price" id="price" placeholder="1234.56" value="<?php print($rowProduct['price']); ?>" required maxlength="100">
                    </div>
                    <div class="form-group">
                        <label for="attribute">Atributo</label>
                        <input  class="form-control" type="text" name="attribute" id="attribute" placeholder='{"color":"azul","talla":"m","marca":"apple"}' value="<?php print($rowProduct['attribute']); ?>" required maxlength="100">
                    </div>
                    <input class="btn btn-primary mb-2" type="submit" name="btn_save" value="Guardar">                    
                  </form>
                </main>
            </div>
        </div>
        <!-- Footer scripts, and functions -->
        <?php require_once 'includes/footer.php'; ?>
    </body>
</html>