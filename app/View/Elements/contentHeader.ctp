           
                <section   class="content-header <?php if(!empty($sticky)): echo "sticky"; endif; ?>">
                    <h1>
                        <?php if(!empty($title)): echo $title; endif; ?>
                        <small><?php if(!empty($titleSmall)): echo $titleSmall; endif; ?></small>





                            
                    </h1>


    <?php if(!empty($saveBtn)): ?>

    <button class="btn btn-success" id="saveBtn">Save</button>

<?php endif;?>

<?php if(!empty($addBtn)): ?>

    <a href="<?php echo $addBtnTarget; ?>" class="btn btn-primary" id="addBtn" style="position:reletive">Add <i class="fa fa-plus"></i></a>

<?php endif;?>

<?php if(!empty($editBtn)): ?>

    <a href="<?php echo $editBtnTarget; ?>" class="btn btn-primary" id="addBtn" style="float:right">Edit <i class="fa fa-pencil"></i></a>

<?php endif;?>


                </section>
            