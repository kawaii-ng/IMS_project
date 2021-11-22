
<div class='remove-modal-container modal-container'>
    
    <div class='modal remove-modal'>
        <div class='modal-header'>
            <h3>Warning</h3>
        </div>
        <div class='modal-content'>
            <p>Are you confirm to remove this item?</p>
            <div class='btn-group'>
                <button class='btn edit-btn' id='cancel-btn'>Cancel</button>
                <?php echo"<input type='button' value='Remove' class='btn del-btn' id='confirm-btn-".$_SESSION['cartID']."' />"; ?>
            </div>
        </div>
    </div>

</div>

