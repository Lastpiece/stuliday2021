<?php require "inc/header.php"; ?>
<?php 

    if(!empty($_SESSION)){
        $admin_id = $_SESSION['id'];
        $sqlAdmin = "SELECT * FROM users WHERE id = '{$admin_id}' && role ='ROLE_ADMIN'";
        $resultAdmin = $connect->query($sqlAdmin);

        if($admin = $resultAdmin->fetch(PDO::FETCH_ASSOC)){
            $sqlUsers = "SELECT * FROM users WHERE id != '{$admin_id}'";
            $users = $connect->query($sqlUsers)->fetchAll(PDO::FETCH_ASSOC);

            $sqlProducts = "SELECT p.*, u.username, c.categories_name FROM products AS p LEFT JOIN users AS u ON p.author = u.id LEFT JOIN categories AS c ON p.category = c.categories_id";
            $products = $connect->query($sqlProducts)->fetchAll(PDO::FETCH_ASSOC);

            ?>
            <!-- <div class="box is-large"> -->
                <table class="table is-hoverable is-fullwidth is-bordered">
                    <thead>
                        <tr class="is-selected">
                        <th># id</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Edit</th>
                        <!-- <th>Delete</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user) { ?>
                            <tr>
                                <th><?php echo $user['id'] ?></th>
                                <td><?php echo $user['username'] ?></td>
                                <td><?php echo $user['email'] ?></td>
                                <td><?php echo $user['role'] ?></td>
                                <td><a href="edituser.php?id=<?php echo $user['id']; ?>">Modifier</a></td>
                                <td>
                                    <form action="" method="POST">
                                    Supprimer
                                        <input type="hidden" name="csrf_token" value="">
                                        <input type="hidden" name="id" value="">
                                        <input type="submit" name="submit_delete" value="delete">
                                        
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <!-- </div> -->
            <!-- <div class="box is-large"> -->
                <table class="table is-hoverable is-fullwidth is-bordered">
                    <thead>
                        <tr class="is-selected">
                        <th># id</th>
                        <th>name</th>
                        <th>description</th>
                        <th>price</th>
                        <th>category</th>
                        <th>author</th>
                        <th>created at</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product) { ?>
                            <tr>
                                <th><?php echo $product['products_id'] ?></th>
                                <td><?php echo $product['products_name'] ?></td>
                                <td><?php echo $product['products_description'] ?></td>
                                <td><?php echo $product['products_price'] ?></td>
                                <td><?php echo $product['categories_name'] ?></td>
                                <td><?php echo $product['username'] ?></td>
                                <td><?php echo $product['created_at'] ?></td>
                                <td><a href="editproduct.php?id=<?php echo $product['products_id']; ?>">Modifier</a></td>
                                <td><a href="deleteconfirm.php?id=<?php echo $product['products_id'];?>">Supprimer</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <!-- </div> -->
            <?php 
        } else {
            echo "Cette page n'existe pas";
            echo "<a class='button is-block is-info is-large' href='index.php'>Retourner à la page d'acceuil</a>";
        }
    } else {
        echo "Cette page n'existe pas";
        echo "<a class='button is-block is-info is-large' href='index.php'>Retourner à la page d'acceuil</a>";
    }
?>

<?php require "inc/footer.php"; ?>