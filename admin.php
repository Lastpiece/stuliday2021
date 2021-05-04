<?php require "inc/header.php"; ?>
<?php 

    if(!empty($_SESSION)){
        $admin_id = $_SESSION['id'];
        $sqlAdmin = "SELECT * FROM users WHERE id = '{$admin_id}' && role ='ROLE_ADMIN'";
        $resultAdmin = $connect->query($sqlAdmin);

        if($admin = $resultAdmin->fetch(PDO::FETCH_ASSOC)){
            $sqlUsers = "SELECT * FROM users WHERE id != '{$admin_id}'";
            $users = $connect->query($sqlUsers)->fetchAll(PDO::FETCH_ASSOC);
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
                        <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user) { ?>
                            <tr>
                                <th><?php echo $user['id'] ?></th>
                                <td><?php echo $user['username'] ?></td>
                                <td><?php echo $user['email'] ?></td>
                                <td><?php echo $user['role'] ?></td>
                                <td>Modifier</td>
                                <td>Supprimer</td>
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